<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserAssessment;
use App\Models\AssessmentAnswer;
use App\Services\PsychologicalAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Exception;

class AssessmentController extends Controller
{
    /**
     * Menampilkan daftar user yang telah menyelesaikan asesmen.
     *
     * @return \Inertia\Response
     */
    public function results()
    {
        $users = UserAssessment::orderBy('created_at', 'desc')->get();

        return Inertia::render('Results', [
            'users' => $users,
        ]);
    }

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
    public function generateReport($id, PsychologicalAIService $aiService)
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

        // Tentukan level per driver (1 - 5)
        $driverLevels = [];
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
        }

        // -------------------------------------------------------------------------
        // AMBIL NARASI DARI DATABASE JIKA SUDAH ADA, ATAU GENERATE SEKALI LALU SIMPAN
        // -------------------------------------------------------------------------
        if (!empty($data->ai_narasi) && is_array($data->ai_narasi) && !empty($data->ai_narasi['archetype_box_desc'])) {
            $ai_narasi = $data->ai_narasi;
        } else {
            $ai_narasi = $aiService->generateReportNarration(
                $scores,
                $primaryDriver,
                $secondaryDriver,
                $archetypeName,
                $archetypeData,
                $knowledgeDrivers,
                $driverLevels,
                $data->name ?? 'Peserta'
            );

            // Simpan hasil ke database agar tidak boros token/panggilan berulang
            $data->update(['ai_narasi' => $ai_narasi]);
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
