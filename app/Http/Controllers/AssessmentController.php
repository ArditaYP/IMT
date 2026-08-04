<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserAssessment;
use App\Models\AssessmentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Exception;

class AssessmentController extends Controller
{
    /**
     * Menampilkan Halaman Ujian Interaktif IMT Discovery.
     *
     * @return \Inertia\Response
     */
    public function showTest()
    {
        $questions = Question::where('is_active', true)
            ->select('id', 'question_text', 'order')
            ->orderBy('order', 'asc')
            ->get();

        return Inertia::render('Assessment/Test', [
            'questions' => $questions,
        ]);
    }

    /**
     * Memproses jawaban asesmen dari frontend, menghitung skor 5 Human Drivers,
     * menentukan Archetype dominan, dan menyimpan data ke database.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function submitAnswers(Request $request)
    {
        // -------------------------------------------------------------------------
        // LANGKAH 1: Validasi Request dari Frontend
        // -------------------------------------------------------------------------
        $validated = $request->validate([
            'participant_name' => 'required|string|max:100',
            'answers'          => 'required|array|min:1',
            'answers.*'        => 'required|integer|min:1|max:5',
        ], [
            'participant_name.required' => 'Nama peserta wajib diisi.',
            'answers.required'          => 'Jawaban asesmen tidak boleh kosong.',
            'answers.*.min'             => 'Pilihan jawaban minimal adalah 1 (Sangat Tidak Setuju).',
            'answers.*.max'             => 'Pilihan jawaban maksimal adalah 5 (Sangat Setuju).',
        ]);

        // -------------------------------------------------------------------------
        // LANGKAH 2: Ambil Data Pertanyaan dari Database untuk Pencocokan Driver
        // -------------------------------------------------------------------------
        $submittedQuestionIds = array_keys($validated['answers']);
        $questions = Question::whereIn('id', $submittedQuestionIds)->get()->keyBy('id');

        // Inisialisasi akumulator skor per driver
        $drivers = ['security', 'significance', 'connection', 'growth', 'contribution'];
        $driverStats = [];
        foreach ($drivers as $driver) {
            $driverStats[$driver] = [
                'actual_score_sum' => 0,
                'question_count'   => 0,
            ];
        }

        // -------------------------------------------------------------------------
        // LANGKAH 3: Looping Jawaban & Hitung Skor (Termasuk Reverse Scoring)
        // -------------------------------------------------------------------------
        foreach ($validated['answers'] as $questionId => $rawScore) {
            $question = $questions->get($questionId);
            if (!$question) {
                continue;
            }

            $driverKey = strtolower(trim($question->driver));
            if (!array_key_exists($driverKey, $driverStats)) {
                continue;
            }

            /*
             * RUMUS REVERSE SCORING:
             * Jika reverse_scoring = true: Nilai Efektif = (5 + 1) - Skor_User = 6 - Skor_User
             */
            $isReverse = (bool) $question->reverse_scoring;
            $effectiveScore = $isReverse ? (6 - (int) $rawScore) : (int) $rawScore;

            $driverStats[$driverKey]['actual_score_sum'] += $effectiveScore;
            $driverStats[$driverKey]['question_count']   += 1;
        }

        // -------------------------------------------------------------------------
        // LANGKAH 4: Konversi Total Skor Menjadi Skala Standar 0 - 100
        // -------------------------------------------------------------------------
        $finalScores = [];
        foreach ($driverStats as $driver => $stat) {
            $count = $stat['question_count'];
            $actualSum = $stat['actual_score_sum'];

            if ($count > 0) {
                $minPossible = $count * 1;
                $range = $count * 4; // (count * 5) - (count * 1)
                $percentage = (($actualSum - $minPossible) / $range) * 100;
                $finalScores[$driver] = round(max(0, min(100, $percentage)), 2);
            } else {
                $finalScores[$driver] = 50.00;
            }
        }

        // -------------------------------------------------------------------------
        // LANGKAH 5: Tentukan Archetype (2 Driver dengan Skor Tertinggi)
        // -------------------------------------------------------------------------
        $driverScoreMap = [
            'Security'     => $finalScores['security'],
            'Significance' => $finalScores['significance'],
            'Connection'   => $finalScores['connection'],
            'Growth'       => $finalScores['growth'],
            'Contribution' => $finalScores['contribution'],
        ];

        arsort($driverScoreMap);
        $topDrivers = array_slice(array_keys($driverScoreMap), 0, 2);
        $primaryDriver   = $topDrivers[0];
        $secondaryDriver = $topDrivers[1];

        $knowledgeArchetypes = config('imt_knowledge.archetypes', []);
        $comboKey1 = "{$primaryDriver}_{$secondaryDriver}";
        $comboKey2 = "{$secondaryDriver}_{$primaryDriver}";

        $archetypeName = $knowledgeArchetypes[$comboKey1]['name']
            ?? $knowledgeArchetypes[$comboKey2]['name']
            ?? "The {$primaryDriver}-{$secondaryDriver} Explorer™";

        // -------------------------------------------------------------------------
        // LANGKAH 6: Simpan ke Database
        // -------------------------------------------------------------------------
        $userAssessment = DB::transaction(function () use ($validated, $finalScores, $archetypeName) {
            $assessment = UserAssessment::create([
                'name'               => $validated['participant_name'],
                'security_score'     => $finalScores['security'],
                'significance_score' => $finalScores['significance'],
                'connection_score'   => $finalScores['connection'],
                'growth_score'       => $finalScores['growth'],
                'contribution_score' => $finalScores['contribution'],
                'archetype_name'     => $archetypeName,
            ]);

            $answersData = [];
            $now = now();
            foreach ($validated['answers'] as $questionId => $score) {
                $answersData[] = [
                    'user_assessment_id' => $assessment->id,
                    'question_id'        => $questionId,
                    'score'              => (int) $score,
                    'created_at'         => $now,
                    'updated_at'         => $now,
                ];
            }

            AssessmentAnswer::insert($answersData);

            return $assessment;
        });

        // -------------------------------------------------------------------------
        // LANGKAH 7: Return Full-Page Redirect ke Halaman Laporan Blade
        // -------------------------------------------------------------------------
        return Inertia::location(route('assessment.laporan', ['id' => $userAssessment->id]));
    }

    /**
     * Alias method untuk kompatibilitas route sebelumnya.
     */
    public function submitTest(Request $request)
    {
        return $this->submitAnswers($request);
    }

    /**
     * Menghasilkan laporan psikologi lengkap berdasarkan hasil asesmen 5 Human Drivers
     * dirumuskan secara dinamis & personal oleh AI dengan guardrail ketat dari Dokumen Word Knowledge Base.
     *
     * @param int|string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function generateReport($id)
    {
        $data = UserAssessment::findOrFail($id);
        $assessment = $data;

        $knowledgeDrivers    = config('imt_knowledge.drivers', []);
        $knowledgeArchetypes = config('imt_knowledge.archetypes', []);

        $scores = [
            'Security'     => (float) $data->security_score,
            'Significance' => (float) $data->significance_score,
            'Connection'   => (float) $data->connection_score,
            'Growth'       => (float) $data->growth_score,
            'Contribution' => (float) $data->contribution_score,
        ];

        arsort($scores);
        $topDrivers = array_slice(array_keys($scores), 0, 2);
        $primaryDriver   = $topDrivers[0];
        $secondaryDriver = $topDrivers[1];

        $comboKey1 = "{$primaryDriver}_{$secondaryDriver}";
        $comboKey2 = "{$secondaryDriver}_{$primaryDriver}";

        $archetypeData = $knowledgeArchetypes[$comboKey1] 
            ?? $knowledgeArchetypes[$comboKey2] 
            ?? [
                'name'              => "The {$primaryDriver}-{$secondaryDriver} Explorer™",
                'combination'       => "{$primaryDriver} + {$secondaryDriver}",
                'description'       => "Perpaduan sinergis antara dorongan {$primaryDriver} dan {$secondaryDriver}.",
                'core_desire'       => "Membangun kemajuan berkelanjutan yang berakar pada potensi terbaik.",
                'core_fear'         => "Kehilangan arah atau terjebak dalam stagnasi hidup.",
                'strengths'         => [
                    ['title' => 'Continuous Improvement™', 'desc' => 'Selalu mencari cara untuk menjadi lebih baik.'],
                    ['title' => 'Calculated Adaptability™', 'desc' => 'Mampu beradaptasi tanpa kehilangan arah.'],
                ],
                'blindspots'        => [
                    ['title' => 'Analysis Paralysis™', 'desc' => 'Terlalu banyak berpikir sebelum bertindak.'],
                ],
                'what_drives'       => ['Peluang belajar hal baru', 'Melihat progres nyata'],
                'what_drains'       => ['Rutinitas monoton', 'Lingkungan yang resisten terhadap perubahan'],
                'leadership_style'  => ['title' => 'The Progressive Stabilizer™', 'desc' => 'Memimpin dengan visi jelas dan fondasi realistis.'],
                'communication_style'=> ['title' => 'Thoughtful & Structured', 'desc' => 'Terbuka, analitis, dan berbasis fakta.'],
                'growth_path'       => 'Menyadari bahwa tindakan kecil lebih baik daripada menunggu kesempurnaan.',
                'synergy_summary'   => 'Kombinasi seimbang yang menghadirkan inovasi di atas fondasi yang kokoh.',
                'key_question'      => 'Apakah saya sedang bersiap untuk bertumbuh, atau memakai persiapan untuk menunda langkah?',
            ];

        $archetypeName = $archetypeData['name'] ?? $data->archetype_name;

        if (empty($data->archetype_name) || $data->archetype_name !== $archetypeName) {
            $data->update(['archetype_name' => $archetypeName]);
        }

        // Tentukan level per driver (1 - 5) dan susun fallback default penjelasan
        $driverLevels = [];
        $defaultDriversExplanation = [];

        foreach ($scores as $driverName => $sc) {
            $dk = strtolower($driverName);
            $lvl = 3;
            if ($sc <= 25)      $lvl = 1;
            elseif ($sc <= 50) $lvl = 2;
            elseif ($sc <= 75) $lvl = 3;
            elseif ($sc <= 90) $lvl = 4;
            else               $lvl = 5;

            $lvlInfo = $knowledgeDrivers[$dk]['levels'][$lvl] ?? null;
            $driverLevels[$dk] = [
                'level_number' => $lvl,
                'level_info'   => $lvlInfo,
                'driver_info'  => $knowledgeDrivers[$dk] ?? null,
            ];

            $defaultDriversExplanation[$dk] = $lvlInfo['desc'] 
                ?? ($knowledgeDrivers[$dk]['description'] ?? '');
        }

        $primaryInfo   = $knowledgeDrivers[strtolower($primaryDriver)] ?? [];
        $secondaryInfo = $knowledgeDrivers[strtolower($secondaryDriver)] ?? [];

        // Narasi default berbasis Knowledge Base Word
        $ai_narasi = [
            'archetype_box_desc'    => $archetypeData['description'] ?? "Anda menyukai perkembangan dan perubahan, tetapi tidak menyukai perubahan yang sembrono. Anda ingin maju dan mengeksplorasi potensi baru, namun tetap memastikan setiap langkah yang diambil memiliki fondasi yang kuat, rencana yang jelas, dan risiko yang dapat dikelola.\n\nAnda sering ditemukan sebagai pemimpin perubahan yang realistis, inovator yang bertumbuh secara berkelanjutan, atau profesional yang haus belajar tanpa pernah kehilangan pijakan terhadap realitas dan stabilitas sistem.",
            'apa_artinya'           => "Kelima driver Anda menunjukkan dominasi pada {$primaryDriver} (" . round($scores[$primaryDriver]) . ") dan {$secondaryDriver} (" . round($scores[$secondaryDriver]) . "). Ini mencerminkan profil arketipe {$archetypeName}. {$archetypeData['description']}",
            'wawasan_utama'         => "Wawasan utama Anda berakar pada keseimbangan antara {$primaryDriver} dan {$secondaryDriver}. " . ($archetypeData['growth_path'] ?? 'Pertumbuhan terbesar Anda terjadi saat menyadari bahwa tindakan nyata kecil lebih berarti daripada menunggu kondisi yang benar-benar sempurna.'),
            'drivers_explanation'   => $defaultDriversExplanation,
            'strengths_in_action'   => $archetypeData['strengths'] ?? [],
            'growth_opportunities' => $archetypeData['blindspots'] ?? [],
            'dynamix_reflection'    => "Sebagai {$archetypeName}, kondisi Healthy State™ Anda terwujud saat dorongan {$primaryDriver} dan {$secondaryDriver} bekerja saling melengkapi. Waspadai tanda Shadow State™ saat Anda mulai merasa tertekan atau terburu-buru mengontrol keadaan.",
        ];

        // -------------------------------------------------------------------------
        // SINTESIS NARASI PERSONAL MENGGUNAKAN GEMINI AI BERDASARKAN KNOWLEDGE BASE WORD
        // -------------------------------------------------------------------------
        try {
            $apiKey = env('GEMINI_API_KEY', config('services.gemini.api_key'));

            if (!empty($apiKey)) {
                // Knowledge Base Context
                $knowledgeContext = "";
                foreach ($knowledgeDrivers as $k => $dInfo) {
                    $lvlNum = $driverLevels[$k]['level_number'];
                    $lvlData = $dInfo['levels'][$lvlNum] ?? [];
                    $knowledgeContext .= "- " . strtoupper($dInfo['name']) . " (Skor Klien: " . round($scores[ucfirst($k)]) . "%, Level {$lvlNum}: " . ($lvlData['name'] ?? '-') . "):\n";
                    $knowledgeContext .= "  * Definisi Teori: {$dInfo['description']}\n";
                    $knowledgeContext .= "  * Core Need: {$dInfo['core_need']} | Core Fear: {$dInfo['core_fear']}\n";
                    $knowledgeContext .= "  * Deskripsi Level {$lvlNum}: " . ($lvlData['desc'] ?? '-') . "\n";
                    $knowledgeContext .= "  * Healthy State: " . ($dInfo['healthy_state']['desc'] ?? '-') . " | Shadow: " . ($dInfo['shadow_state']['desc'] ?? '-') . "\n";
                    $knowledgeContext .= "  * Core Challenge: {$dInfo['core_challenge']}\n";
                    $knowledgeContext .= "  * Positive Traits: " . implode(', ', $dInfo['positive_traits'] ?? []) . "\n";
                    $knowledgeContext .= "  * Blindspot Driver: {$dInfo['potential_blindspot']}\n\n";
                }

                $archetypeStrengthsText = "";
                foreach (($archetypeData['strengths'] ?? []) as $st) {
                    $archetypeStrengthsText .= "  * " . ($st['title'] ?? '') . ": " . ($st['desc'] ?? '') . "\n";
                }

                $archetypeBlindspotsText = "";
                foreach (($archetypeData['blindspots'] ?? []) as $bs) {
                    $archetypeBlindspotsText .= "  * " . ($bs['title'] ?? '') . ": " . ($bs['desc'] ?? '') . "\n";
                }

                $prompt = <<<PROMPT
Anda adalah psikolog ahli instrumen psikometri IMT Discovery™ (Inner Motivation Transformation).
Tugas Anda adalah merumuskan narasi psikologi personal untuk laporan peserta. Anda HARUS 100% SEJALAN DAN MENGACU PADA KNOWLEDGE BASE RESMI IMT DISCOVERY BERIKUT. JANGAN PERNAH MENGGUNAKAN TEORI LUAR (seperti MBTI/DISC/Enneagram).

=== KNOWLEDGE BASE RESMI DRIVERS & SKOR KLIEN ===
{$knowledgeContext}

PROFIL ARKETIPE SINERGI [{$archetypeName}]:
- Kombinasi: {$archetypeData['combination']}
- Deskripsi: {$archetypeData['description']}
- Core Desire: {$archetypeData['core_desire']}
- Core Fear: {$archetypeData['core_fear']}
- Growth Path: {$archetypeData['growth_path']}
- Natural Strengths Referensi:
{$archetypeStrengthsText}
- Blindspots Referensi:
{$archetypeBlindspotsText}

DATA KLIEN:
Nama Peserta: {$data->name}
Skor 5 Driver: Security ({$data->security_score}%), Significance ({$data->significance_score}%), Connection ({$data->connection_score}%), Growth ({$data->growth_score}%), Contribution ({$data->contribution_score}%)

INSTRUKSI KHUSUS PERUMUSAN TEKS (WAJIB 100% BERBASIS KNOWLEDGE BASE DI ATAS):
1. 'archetype_box_desc': Buat 2 paragraf narasi arketipe yang mendalam, kaya, dan memikat tentang esensi manifestasi arketipe {$archetypeName} klien. Paragraf 1 menjelaskan perpaduan kedua driver dan pola pertimbangan klien, Paragraf 2 menjelaskan manifestasi peran kepemimpinan/profesionalnya secara nyata (WAJIB MENGACU PADA DATA SINERGI RESMI DI ATAS, pisahkan kedua paragraf dengan baris baru \n\n).
2. 'apa_artinya': Buat satu paragraf narasi personal yang menguraikan makna perpaduan skor 5 driver dan dinamika arketipe {$archetypeName} klien secara elegan, mendalam, dan memberdayakan.
3. 'wawasan_utama': Buat satu paragraf refleksi strategis mengenai titik pertumbuhan (Growth Path) dan pengingat praktis bagi klien.
4. 'drivers_explanation': Buat penjelasan personal 1-2 kalimat untuk masing-masing dari 5 Driver (security, significance, connection, growth, contribution) yang menjelaskan bagaimana driver tersebut (dengan level dan skor riilnya) bekerja pada diri klien sehari-hari.
5. 'strengths_in_action': Rangkum 3-4 poin kekuatan nyata klien dalam tindakan yang dirumuskan dari knowledge base sinergi & driver. (Format: array of object { "title": "Nama Kekuatan™", "desc": "Penjelasan singkat bagaimana kekuatan ini terwujud secara nyata." })
6. 'growth_opportunities': Rangkum 3-4 poin peluang bertumbuh (blind spots) klien yang dirumuskan secara konstruktif dan solutif dari knowledge base. (Format: array of object { "title": "Nama Blindspot™", "desc": "Penjelasan singkat dan panduan praktis untuk mengatasinya." })
7. 'dynamix_reflection': Buat 2 kalimat refleksi personal yang menjelaskan dinamika Healthy State vs Shadow State klien, bagaimana tanda-tanda ketika klien sedang dalam kondisi optimal vs saat mulai tertekan/terjebak dalam shadow state.

Kembalikan HANYA format JSON murni:
{
  "archetype_box_desc": "Paragraf 1 narasi arketipe...\\n\\nParagraf 2 manifestasi peran...",
  "apa_artinya": "Paragraf narasi personal apa artinya...",
  "wawasan_utama": "Paragraf narasi wawasan utama...",
  "drivers_explanation": {
    "security": "Penjelasan personal 1-2 kalimat Security...",
    "significance": "Penjelasan personal 1-2 kalimat Significance...",
    "connection": "Penjelasan personal 1-2 kalimat Connection...",
    "growth": "Penjelasan personal 1-2 kalimat Growth...",
    "contribution": "Penjelasan personal 1-2 kalimat Contribution..."
  },
  "strengths_in_action": [
    { "title": "Continuous Improvement™", "desc": "Selalu mencari cara untuk menjadi lebih baik secara berkelanjutan..." },
    { "title": "Calculated Adaptability™", "desc": "Mampu beradaptasi terhadap perubahan tanpa kehilangan arah..." }
  ],
  "growth_opportunities": [
    { "title": "Analysis Paralysis™", "desc": "Waspadai kecenderungan terlalu banyak menganalisis sebelum berani bertindak..." },
    { "title": "Comfort Zone Expansion™", "desc": "Belajar mengambil risiko terukur dalam situasi ketidakpastian..." }
  ],
  "dynamix_reflection": "Refleksi personal dinamika Healthy State vs Shadow State klien..."
}
PROMPT;

                $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}";

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->timeout(25)->post($endpoint, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'responseMimeType' => 'application/json',
                        'temperature'      => 0.6,
                    ]
                ]);

                if ($response->successful()) {
                    $responseData = $response->json();
                    $rawText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? '';
                    $cleanJson = trim(str_replace(['```json', '```'], '', $rawText));
                    $decoded = json_decode($cleanJson, true);

                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        $ai_narasi['archetype_box_desc'] = $decoded['archetype_box_desc'] ?? $ai_narasi['archetype_box_desc'];
                        $ai_narasi['apa_artinya'] = $decoded['apa_artinya'] ?? $ai_narasi['apa_artinya'];
                        $ai_narasi['wawasan_utama'] = $decoded['wawasan_utama'] ?? $ai_narasi['wawasan_utama'];
                        $ai_narasi['dynamix_reflection'] = $decoded['dynamix_reflection'] ?? $ai_narasi['dynamix_reflection'];
                        
                        if (!empty($decoded['drivers_explanation']) && is_array($decoded['drivers_explanation'])) {
                            foreach ($decoded['drivers_explanation'] as $k => $exp) {
                                if (!empty($exp)) {
                                    $ai_narasi['drivers_explanation'][$k] = $exp;
                                }
                            }
                        }

                        if (!empty($decoded['strengths_in_action']) && is_array($decoded['strengths_in_action'])) {
                            $ai_narasi['strengths_in_action'] = $decoded['strengths_in_action'];
                        }

                        if (!empty($decoded['growth_opportunities']) && is_array($decoded['growth_opportunities'])) {
                            $ai_narasi['growth_opportunities'] = $decoded['growth_opportunities'];
                        }
                    }
                }
            }
        } catch (Exception $e) {
            Log::error("Error saat generate report Gemini AI: " . $e->getMessage());
        }

        return view('laporan', compact(
            'assessment', 
            'ai_narasi', 
            'primaryDriver', 
            'secondaryDriver', 
            'archetypeName',
            'archetypeData',
            'knowledgeDrivers',
            'driverLevels'
        ));
    }
}
