<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PsychologicalAIService
{
    /**
     * Generate narrative for assessment report.
     *
     * @param array $scores
     * @param string $primaryDriver
     * @param string $secondaryDriver
     * @param string $archetypeName
     * @param array $archetypeData
     * @param array $knowledgeDrivers
     * @param array $driverLevels
     * @param string $participantName
     * @return array
     */
    public function generateReportNarration(
        array $scores,
        string $primaryDriver,
        string $secondaryDriver,
        string $archetypeName,
        array $archetypeData,
        array $knowledgeDrivers,
        array $driverLevels,
        string $participantName
    ): array {
        // Build fallback data first from knowledge base
        $fallback = $this->buildFallbackNarrative(
            $scores,
            $primaryDriver,
            $secondaryDriver,
            $archetypeName,
            $archetypeData,
            $knowledgeDrivers,
            $driverLevels
        );

        $provider = env('AI_PROVIDER', 'gemini'); // gemini, ollama, or fallback

        if ($provider === 'fallback' || $provider === 'none') {
            return $fallback;
        }

        try {
            $prompt = $this->buildPrompt(
                $scores,
                $primaryDriver,
                $secondaryDriver,
                $archetypeName,
                $archetypeData,
                $knowledgeDrivers,
                $driverLevels,
                $participantName
            );

            if ($provider === 'ollama') {
                $responseJson = $this->callOllama($prompt);
            } else {
                // Default to Gemini
                $responseJson = $this->callGemini($prompt);
            }

            if (!empty($responseJson) && is_array($responseJson)) {
                return $this->mergeWithFallback($responseJson, $fallback);
            }
        } catch (Exception $e) {
            Log::error("PsychologicalAIService error ({$provider}): " . $e->getMessage());
        }

        return $fallback;
    }

    /**
     * Build knowledge base prompt.
     */
    protected function buildPrompt(
        array $scores,
        string $primaryDriver,
        string $secondaryDriver,
        string $archetypeName,
        array $archetypeData,
        array $knowledgeDrivers,
        array $driverLevels,
        string $participantName
    ): string {
        $knowledgeContext = "";
        foreach ($knowledgeDrivers as $k => $dInfo) {
            $lvlNum = $driverLevels[$k]['level_number'] ?? 3;
            $lvlData = $dInfo['levels'][$lvlNum] ?? [];
            $driverScore = round($scores[ucfirst($k)] ?? 50);
            $knowledgeContext .= "- " . strtoupper($dInfo['name'] ?? $k) . " (Skor Klien: {$driverScore}%, Level {$lvlNum}: " . ($lvlData['name'] ?? '-') . "):\n";
            $knowledgeContext .= "  * Definisi Teori: " . ($dInfo['description'] ?? '') . "\n";
            $knowledgeContext .= "  * Core Need: " . ($dInfo['core_need'] ?? '') . " | Core Fear: " . ($dInfo['core_fear'] ?? '') . "\n";
            $knowledgeContext .= "  * Deskripsi Level {$lvlNum}: " . ($lvlData['desc'] ?? '-') . "\n";
            $knowledgeContext .= "  * Healthy State: " . ($dInfo['healthy_state']['desc'] ?? '-') . " | Shadow: " . ($dInfo['shadow_state']['desc'] ?? '-') . "\n";
            $knowledgeContext .= "  * Core Challenge: " . ($dInfo['core_challenge'] ?? '') . "\n";
            $knowledgeContext .= "  * Positive Traits: " . implode(', ', $dInfo['positive_traits'] ?? []) . "\n";
            $knowledgeContext .= "  * Blindspot Driver: " . ($dInfo['potential_blindspot'] ?? '') . "\n\n";
        }

        $archetypeStrengthsText = "";
        foreach (($archetypeData['strengths'] ?? []) as $st) {
            $archetypeStrengthsText .= "  * " . ($st['title'] ?? '') . ": " . ($st['desc'] ?? '') . "\n";
        }

        $archetypeBlindspotsText = "";
        foreach (($archetypeData['blindspots'] ?? []) as $bs) {
            $archetypeBlindspotsText .= "  * " . ($bs['title'] ?? '') . ": " . ($bs['desc'] ?? '') . "\n";
        }

        return <<<PROMPT
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
Nama Peserta: {$participantName}
Skor 5 Driver: Security ({$scores['Security']}%), Significance ({$scores['Significance']}%), Connection ({$scores['Connection']}%), Growth ({$scores['Growth']}%), Contribution ({$scores['Contribution']}%)

INSTRUKSI KHUSUS PERUMUSAN TEKS (WAJIB 100% BERBASIS KNOWLEDGE BASE DI ATAS):
1. 'archetype_box_desc': Buat 2 paragraf narasi arketipe yang mendalam, kaya, dan memikat tentang esensi manifestasi arketipe {$archetypeName} klien. Paragraf 1 menjelaskan perpaduan kedua driver dan pola pertimbangan klien, Paragraf 2 menjelaskan manifestasi peran kepemimpinan/profesionalnya secara nyata (WAJIB MENGACU PADA DATA SINERGI RESMI DI ATAS, pisahkan kedua paragraf dengan baris baru \n\n).
2. 'apa_artinya': Buat satu paragraf narasi personal yang menguraikan makna perpaduan skor 5 driver dan dinamika arketipe {$archetypeName} klien secara elegan, mendalam, dan memberdayakan.
3. 'wawasan_utama': Buat satu paragraf refleksi strategis mengenai titik pertumbuhan (Growth Path) dan pengingat praktis bagi klien.
4. 'drivers_explanation': Buat penjelasan personal 1-2 kalimat untuk masing-masing dari 5 Driver (security, significance, connection, growth, contribution) yang menjelaskan bagaimana driver tersebut (dengan level dan skor riilnya) bekerja pada diri klien sehari-hari.
5. 'strengths_in_action': Rangkum 3-4 poin kekuatan nyata klien dalam tindakan yang dirumuskan dari knowledge base sinergi & driver. (Format: array of object { "title": "Nama Kekuatan™", "desc": "Penjelasan singkat bagaimana kekuatan ini terwujud secara nyata." })
6. 'growth_opportunities': Rangkum 3-4 poin peluang bertumbuh (blind spots) klien yang dirumuskan secara konstruktif dan solutif dari knowledge base. (Format: array of object { "title": "Nama Blindspot™", "desc": "Penjelasan singkat dan panduan praktis untuk mengatasinya." })
7. 'dynamix_reflection': Buat 2 kalimat refleksi personal yang menjelaskan dinamika Healthy State vs Shadow State klien, bagaimana tanda-tanda ketika klien sedang dalam kondisi optimal vs saat mulai tertekan/terjebak dalam shadow state.

Kembalikan HANYA format JSON valid tanpa teks lain:
{
  "archetype_box_desc": "Paragraf 1...\\n\\nParagraf 2...",
  "apa_artinya": "Paragraf...",
  "wawasan_utama": "Paragraf...",
  "drivers_explanation": {
    "security": "Penjelasan...",
    "significance": "Penjelasan...",
    "connection": "Penjelasan...",
    "growth": "Penjelasan...",
    "contribution": "Penjelasan..."
  },
  "strengths_in_action": [
    { "title": "Nama Kekuatan™", "desc": "Deskripsi..." }
  ],
  "growth_opportunities": [
    { "title": "Nama Peluang™", "desc": "Deskripsi..." }
  ],
  "dynamix_reflection": "Refleksi..."
}
PROMPT;
    }

    /**
     * Call Google Gemini API.
     */
    protected function callGemini(string $prompt): ?array
    {
        $apiKey = env('GEMINI_API_KEY', config('services.gemini.api_key'));
        if (empty($apiKey)) {
            return null;
        }

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
            return $this->parseJson($rawText);
        }

        return null;
    }

    /**
     * Call Local Ollama API (Llama 3, Gemma 2, Mistral, etc.)
     */
    protected function callOllama(string $prompt): ?array
    {
        $host = env('OLLAMA_HOST', 'http://127.0.0.1:11434');
        $model = env('OLLAMA_MODEL', 'llama3:latest');

        $response = Http::timeout(60)->post("{$host}/api/generate", [
            'model'  => $model,
            'prompt' => $prompt,
            'stream' => false,
            'format' => 'json',
            'options' => [
                'temperature' => 0.6,
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $rawText = $data['response'] ?? '';
            return $this->parseJson($rawText);
        }

        return null;
    }

    /**
     * Clean and parse JSON from LLM output.
     */
    protected function parseJson(string $text): ?array
    {
        $cleanJson = trim($text);
        if (str_starts_with($cleanJson, '```json')) {
            $cleanJson = substr($cleanJson, 7);
        } elseif (str_starts_with($cleanJson, '```')) {
            $cleanJson = substr($cleanJson, 3);
        }
        if (str_ends_with($cleanJson, '```')) {
            $cleanJson = substr($cleanJson, 0, -3);
        }
        $cleanJson = trim($cleanJson);

        $decoded = json_decode($cleanJson, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }

        return null;
    }

    /**
     * Build standard fallback narrative straight from Knowledge Base.
     */
    protected function buildFallbackNarrative(
        array $scores,
        string $primaryDriver,
        string $secondaryDriver,
        string $archetypeName,
        array $archetypeData,
        array $knowledgeDrivers,
        array $driverLevels
    ): array {
        $defaultDriversExplanation = [];
        foreach ($scores as $driverName => $sc) {
            $dk = strtolower($driverName);
            $lvl = $driverLevels[$dk]['level_number'] ?? 3;
            $lvlInfo = $knowledgeDrivers[$dk]['levels'][$lvl] ?? null;
            $defaultDriversExplanation[$dk] = $lvlInfo['desc'] ?? ($knowledgeDrivers[$dk]['description'] ?? '');
        }

        return [
            'archetype_box_desc'    => $archetypeData['description'] ?? "Anda menyukai perkembangan dan perubahan, namun tetap memastikan setiap langkah yang diambil memiliki fondasi yang kuat, rencana yang jelas, dan risiko yang dapat dikelola.\n\nAnda sering ditemukan sebagai pemimpin perubahan yang realistis, inovator yang bertumbuh secara berkelanjutan, atau profesional yang haus belajar tanpa pernah kehilangan pijakan terhadap realitas dan stabilitas sistem.",
            'apa_artinya'           => "Kelima driver Anda menunjukkan dominasi pada {$primaryDriver} (" . round($scores[$primaryDriver]) . "%) dan {$secondaryDriver} (" . round($scores[$secondaryDriver]) . "%). Ini mencerminkan profil arketipe {$archetypeName}. " . ($archetypeData['description'] ?? ''),
            'wawasan_utama'         => "Wawasan utama Anda berakar pada keseimbangan antara {$primaryDriver} dan {$secondaryDriver}. " . ($archetypeData['growth_path'] ?? 'Pertumbuhan terbesar Anda terjadi saat menyadari bahwa tindakan nyata kecil lebih berarti daripada menunggu kondisi yang benar-benar sempurna.'),
            'drivers_explanation'   => $defaultDriversExplanation,
            'strengths_in_action'   => $archetypeData['strengths'] ?? [],
            'growth_opportunities' => $archetypeData['blindspots'] ?? [],
            'dynamix_reflection'    => "Sebagai {$archetypeName}, kondisi Healthy State™ Anda terwujud saat dorongan {$primaryDriver} dan {$secondaryDriver} bekerja saling melengkapi. Waspadai tanda Shadow State™ saat Anda mulai merasa tertekan atau terburu-buru mengontrol keadaan.",
        ];
    }

    /**
     * Merge AI output with fallback to guarantee all required keys exist.
     */
    protected function mergeWithFallback(array $aiOutput, array $fallback): array
    {
        $result = $fallback;

        if (!empty($aiOutput['archetype_box_desc'])) {
            $result['archetype_box_desc'] = $aiOutput['archetype_box_desc'];
        }
        if (!empty($aiOutput['apa_artinya'])) {
            $result['apa_artinya'] = $aiOutput['apa_artinya'];
        }
        if (!empty($aiOutput['wawasan_utama'])) {
            $result['wawasan_utama'] = $aiOutput['wawasan_utama'];
        }
        if (!empty($aiOutput['dynamix_reflection'])) {
            $result['dynamix_reflection'] = $aiOutput['dynamix_reflection'];
        }
        if (!empty($aiOutput['drivers_explanation']) && is_array($aiOutput['drivers_explanation'])) {
            foreach ($aiOutput['drivers_explanation'] as $k => $exp) {
                if (!empty($exp)) {
                    $result['drivers_explanation'][$k] = $exp;
                }
            }
        }
        if (!empty($aiOutput['strengths_in_action']) && is_array($aiOutput['strengths_in_action'])) {
            $result['strengths_in_action'] = $aiOutput['strengths_in_action'];
        }
        if (!empty($aiOutput['growth_opportunities']) && is_array($aiOutput['growth_opportunities'])) {
            $result['growth_opportunities'] = $aiOutput['growth_opportunities'];
        }

        return $result;
    }
}
