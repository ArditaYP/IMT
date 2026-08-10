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
        
        $sopText = <<<'SOP'

---
name: imt-warm-reporting
description: Use whenever writing, narrating, or revising any user-facing text for IMT Discovery — report/interpretation copy, driver descriptions, DQ/Driver Intelligence dimension narratives, archetype text, validity notes, landing page or FAQ copy, or dashboard microcopy. Also trigger whenever the user asks to make IMT Discovery writing "warm", "friendly", "manusiawi", "enak dibaca", "tidak kaku", "tidak seperti robot/AI/mesin", asks for "reporting"/report narration for this project, or asks to make the report feel more "world-class"/"kelas dunia" like Enneagram, CliftonStrengths, Hogan, or 16Personalities. Ensures the tone is warm and clear, weaves the top drivers into one coherent story instead of isolated definitions, grounds traits in concrete everyday scenes, never fabricates statistics, never leaves raw KB quotes in the UI, and follows the current report.html architecture (Synergy Matrix archetype, Sub Composite spotlight, 5-state Driver Dynamics, dual-layer Development Path).
---
# IMT Discovery — Warm, World-Class Reporting Voice &amp; Architecture
This skill defines how to write any user-facing text for IMT Discovery: the personal/team
psychometric report, the landing page, dashboards, and any copy that explains a driver, a DI
dimension, a DQ score, or a validity result to a real person reading about themselves. It also
documents the current report.html architecture so future edits stay consistent with production
instead of re-deriving it from scratch.
It has three layers. Layer 1 is about **voice** (does this sound like a human, not a manual).
Layer 2 is about **structure** (does this report have the depth that makes Enneagram,
CliftonStrengths, Hogan, or 16Personalities reports feel personal instead of generic). Layer 3 is
the **production reference** — the actual sections report.html has today, and the hard rules we
learned the hard way while building them.
## Why this matters
IMT Discovery's source material (the Knowledge Base) is written like a clinical reference
manual: definitional, third-person, formal, and structured one-driver-at-a-time. That's correct
for a reference doc. It is the wrong shape for something a person reads about *themselves*. Even
once the wording is warm, a report that describes five drivers as five separate, isolated
write-ups still reads like a spec sheet, not a story about one specific person.
## Layer 1 — Voice: rewrite, don't reword
**The cardinal rule:** never lift wording directly from the Knowledge Base, and never lightly
reword it either. Read the underlying concept, then write it fresh, as if you're a warm,
perceptive friend explaining what you noticed about someone — not a manual defining a term.
Before finalizing any sentence, ask: *"Could this sentence have been copy-pasted from the KB
with a find-and-replace?"* If yes, throw it out and start from the concept instead of the
wording. This applies even to short first-person "internal voice" lines (e.g. KB Driver Dynamix
state quotes like *"Saya merasa aman dan siap menghadapi kehidupan."*) — swapping one or two
words ("aman dan siap" → "siap menghadapi apa pun") is **still** a raw KB quote, not a rewrite.
The fix that actually worked in production: drop the first-person "Saya..." quote format
entirely and replace it with a plain descriptive sentence about the reader ("Versi Security yang
paling sehat — rasa aman menjadi fondasi Anda melangkah, bukan alasan untuk berhenti.").
**Real before/after from this project:**
| Source concept (KB, clinical) | ❌ Lightly reworded (still robotic) | ✅ Rewritten (warm, human) |
|---|---|---|
| Core Need — Awareness: "kemampuan mengenali Driver yang paling dominan... fondasi dari seluruh Driver Intelligence" | "Kemampuan mengenali Driver yang paling dominan dalam diri Anda — fondasi dari seluruh Driver Intelligence." | "Anda pribadi yang memiliki kesadaran yang kuat — setiap tindakan dan keputusan Anda selalu bersumber pada driver ini." |
| Driver Dynamix Healthy State quote: "Saya merasa aman dan siap menghadapi kehidupan." | "Saya merasa siap menghadapi apa pun yang datang." (still first-person, still a near-verbatim quote) | "Versi Security yang paling sehat — rasa aman menjadi fondasi Anda melangkah, bukan alasan untuk berhenti." (plain descriptive sentence, no quote format at all) |
| Development Path stage quote: "Saya menggunakan Driver sebagai kekuatan hidup." | (kept as literal quote in quotation marks) | Deleted entirely. Replaced by a `meaning` field written fresh in third-person-about-the-reader style: "Driver ini sudah menjadi kekuatan yang Anda pakai secara sadar untuk membangun hidup yang Anda inginkan — bukan lagi sesuatu yang diam-diam mengendalikan Anda." |
| Core Development Challenge Transformation Question: "Apakah saya sedang menciptakan keamanan yang sehat, atau hanya berusaha menghindari ketidakpastian?" | "Apakah saya sedang membangun keamanan yang sehat, atau hanya berusaha menghindari ketidakpastian?" (one word changed — still essentially the KB line) | "Kalau dipikir lagi, rencana cadangan yang sedang Anda susun ini — benar-benar dibutuhkan, atau sekadar supaya Anda merasa lebih tenang?" (different structure, different concrete anchor, same underlying lesson) |
| DI Dimension "signature question" (Bab 5.4): "Apa yang menggerakkan saya?" | (kept as literal quote, shown in orange italics) | Deleted. The personalized interpretation sentence below it already carries the meaning in context; keeping a second, unrewritten KB one-liner next to it was redundant *and* still a raw quote. |
**Voice checklist:**
- Warm and friendly, but not saccharine — confident and direct, like someone who genuinely gets
  it, not a hype-man.
- Second person ("Anda"), about the reader — not third-person definitions of a construct, and
  not first-person "Saya..." pseudo-quotes mimicking the KB's internal-voice style either.
- Plain Indonesian over jargon. If a technical term (Awareness, Regulation, Core Fear) must
  appear, wrap it in a plain-language explanation the first time.
- Internal/clinical labels (Core Fear, Core Need, sub-dimension names, "Transformation
  Question") get translated into plain language before they reach the user, never shown raw —
  and never kept just because the KB structured its document around them. If a KB section
  (e.g. a per-dimension "signature question") turns out to be redundant with something else
  already in the report, the right move can be deleting it, not just rewording it.
## Layer 2 — Structure: what makes a report feel world-class instead of generic
This is what separates "warm but still a template" from a report that makes someone go "wow,
that's so me." Techniques borrowed from how the best commercial assessments (Hogan,
CliftonStrengths, Enneagram Institute, 16Personalities) actually structure their write-ups:
### 1. Weave the top 2 drivers into one story — don't describe five drivers in isolation
The most distinctive, personal-feeling part of a profile is usually the *interaction* between
someone's top two drivers, not either one alone. Two people who are both primarily driven by
Growth read completely differently depending on whether their #2 is Security (a careful,
methodical learner) or Contribution (an explorer who learns in order to help others).
**Pattern:** "[Driver #1] adalah [metaphor] Anda — [what it does] — [modifier clause describing
what Driver #2 adds, in plain language, without just naming it]."
**Example:** "Contribution adalah kompas makna Anda — bagian dari diri Anda yang terus bertanya
apakah ini benar-benar berguna bagi orang lain. Namun dorongan itu jarang terasa selesai sebelum
hasilnya benar-benar diakui sebagai sesuatu yang berarti — bukan sekadar cukup, tapi terasa
membanggakan." (Driver #2 here is Significance — notice the sentence never says "karena
Significance juga kuat dalam diri Anda"; it describes what Significance *means* instead.)
**Naming discipline for driver #2 and #3:** Driver #1 can be named directly (it's the headline
concept, like an archetype name). Driver #2's contribution should be described through what it
*does* to the sentence (a modifier clause), not through "karena [Driver] juga kuat dalam diri
Anda" — that phrasing is a name-drop, not an explanation. Driver #3, mentioned only in passing,
should use a short plain-language *essence* phrase with **no driver name or jargon term at all**
(e.g. "ada juga dorongan untuk terus belajar dan menjadi lebih baik" instead of "warna Growth
ikut menyelinap masuk"). See `IMT_DRIVER_METAPHOR` (driver #1), `IMT_DRIVER_MODIFIER` (driver
#2), and `IMT_DRIVER_ESSENCE` (driver #3, name-free) in `assets/data.js`.
### 2. Ground traits in a scene, not a trait list
Instead of listing adjectives ("empatik, loyal, suportif"), put the reader inside a specific,
ordinary moment and show what they'd instinctively do there.
**Pattern:** pick a familiar, everyday moment (a tense meeting, meeting someone new, a looming
deadline, a disagreement) and narrate the reader's likely instinct inside it, in 1–2 sentences.
Use one scene per top driver rather than reusing the same generic trait-list format for every
section of the report.
### 3. Give scores a sense of scale — without ever inventing statistics
**IMT Discovery does not have a real normative sample yet.** Inventing a percentile or
population comparison is a factual claim about data that doesn't exist — never do this, no
matter how much it would improve the copy. Lean instead into the actual score band and what it
honestly means, since that IS real (derived from the person's actual answers).
### 4. Make growth/action steps specific to the actual combination, not generic advice
Tie suggested actions to the specific driver (ideally the *lowest* driver, since that's the
growth edge) with a concrete, doable action — not a vague instruction to "reflect."
### 5. Don't stack redundant "reflect on yourself" devices
A single report can legitimately have a few distinct reflection-question moments (e.g. the
archetype's closing Key Question, the Development Path's reflection question, the Core
Development Challenge's closing question) — each tied to a different part of the story. But
before adding *another* one (like a per-dimension "signature question" in the DQ section), check
whether it earns its place. If the surrounding descriptive text already conveys the same idea in
personalized language, the extra question is clutter, not depth. When in doubt, cut it rather
than rewrite it — fewer, well-placed reflective moments land harder than many shallow ones.
## Layer 3 — Report Architecture (Production Reference)
This is what `report.html` actually contains today (Aug 2026). Read this before restructuring
any section, so changes build on the current model instead of reinventing it.
**Header area:** profile info (name/DOB/job/date/report ID) + a compact "Tentang IMT Discovery"
navy box, side by side with the archetype box and radar chart.
**Archetype box:** driven by `imtSynergyFor(topDriver, secondDriver)` from
`IMT_SYNERGY_MATRIX` in `assets/data.js` — **not** the old single-driver `IMT_ARCHETYPES` (that
map still exists and is used only for compact badges on dashboard/admin/team pages, not the
report). The archetype is the combination of the top 2 drivers (10 unordered pairs × who's #1 =
20 distinct outputs), so two people who share a dominant driver but differ on #2 get different
archetypes — this is the main anti-duplication mechanism. Fields: `name`, `desire`, `fear`,
`strengths`, `blindSpot`, `keyQuestion`.
**Radar chart + "Apa Artinya":** these two are visually stacked in the same column
(`.right-stack` wrapping `.radar-box` + `.apa-artinya`), not placed as a separate full-width
block below both columns — keeping the interpretation text physically adjacent to the chart it
explains avoids dead white space and reads as one connected unit. "Apa Artinya" text is built
from `imtComboNarrative(top, second)` (see Layer 2 §1) plus one closing sentence naming driver
#3 via `IMT_DRIVER_ESSENCE` (no jargon name).
**DQ / Driver Intelligence box:** subheadline is grounded in the actual DQ theory (mengenali /
memahami / mengelola / mengembangkan / mengarahkan — the 5 DI dimensions), not a catchy but
vague tagline. The 5 dimension cards (`di-grid` + `di-detail`) show only the score and a
personalized interpretation sentence (`imtDiInterpret`) — no separate quoted "signature
question" per dimension (removed, see Layer 1 table).
**Sub Composite spotlight box:** one qualitative insight from `IMT_SUB_COMPOSITE`, chosen via
`imtSubCompositeSpotlight(topDriver, secondDriver)` — deterministic (not random), adds
variation without claiming to measure something the test doesn't actually score. No new test
items, no fabricated numbers.
**Driver Dynamics section:** 5 states per the KB's actual model — Healthy, Activated, Stress,
Shadow, Growth (`IMT_DRIVER_DYNAMICS[driver]`), each with a `desc` (plain descriptive framing,
not a quote) and `points` (concrete behaviors in "Anda..." voice); Activated also has a
`trigger` line. Followed by a **Core Development Challenge** box (`challenge`: `title`,
`lesson`, `points`, `question`) — the single biggest "life lesson" for that driver, styled
distinctly (navy gradient) as the section's takeaway.
**Development Path section:** two layers, both need to stay:
1. *Universal DQ stage* — a continuous gauge (`.stage-bar-track` + pin at the exact DQ score,
   plus 5 milestone points from `IMT_DEV_STAGES`) showing Unaware → Aware → Understanding →
   Managing → Transforming, with a `meaning` sentence for the current stage (no raw quote).
2. *Driver-specific path* — from `IMT_DEV_PATH[topDriver]`: `purpose` (what growing this driver
   is really about), `formula` (3-part growth formula shown as chips), `question` (reflection),
   `challenge` (one concrete weekly action), `signs` (3 observable signs of progress).
**No internal chapter labels in user-facing text.** Section headers describe what the section
*is* ("Dinamika Driver Anda — Driver Dynamics™"), not where it sits in an internal document
("Bab 6"). Chapter/book references are fine in code comments (they help trace content back to
its KB source) but must never render to the user.
## Structural + voice checklist before publishing any IMT copy
- [ ] Does this sentence trace back to a Knowledge Base field (Core Need / Core Fear /
      Description / a state "quote" / a "Transformation Question")? If yes, is it substantially
      reimagined — different structure, not just synonym swaps — or better, is a quote-style
      format even the right call, or should it become a plain descriptive sentence instead?
- [ ] Is it addressed to "Anda" and about the *reader*, not a third-person definition, and not a
      first-person "Saya..." pseudo-quote mimicking the KB's internal-voice style?
- [ ] Would a real person say this out loud to a friend, or does it sound like a manual?
- [ ] If this describes the person's overall profile, does it connect at least their top 2
      drivers into one story — or is it just describing driver #1 in isolation?
- [ ] If a secondary or tertiary driver is mentioned, is its meaning explained (or replaced with
      a name-free essence phrase for driver #3), rather than just name-dropped ("karena X juga
      kuat dalam diri Anda")?
- [ ] Is there at least one concrete, everyday scene the reader can picture themselves in,
      rather than only trait adjectives?
- [ ] Am I about to state or imply a statistic (percentile, "X% of people")? If so — stop. We
      don't have real normative data; don't fabricate it.
- [ ] Is the suggested growth/action step specific enough that it wouldn't make sense for
      someone with a different result?
- [ ] If describing several similar items in a row (5 Drivers, 5 DI dimensions, 5 Dynamics
      states, 4 score bands), does each one feel distinct in rhythm and word choice, not
      templated?
- [ ] Am I adding a new "reflect on this" question? Check whether the report already has one
      nearby doing the same job — cut redundant ones instead of rewording them.
- [ ] Does any visible header or label leak an internal structure reference (e.g. "Bab 6")? If
      so, remove it — internal chapter references belong in code comments only.
- [ ] Does interpretive text sit visually next to the chart/element it explains, or is it
      orphaned as a separate block that leaves dead space?
## Where this applies in IMT Discovery specifically
- **Report interpretation text** — driver descriptions, DI dimension narratives, DQ summary,
  archetype description (Synergy Matrix based), the combined top-2-drivers narrative, scenario
  writing in Driver Dynamics, Sub Composite spotlight, Development Path (both layers),
  strengths/growth/action lists, validity note.
- **Landing page copy** — driver cards, "Keunggulan Kami"/DQ section, how-it-works, FAQ answers.
- **Any new feature copy** added later (dashboard summaries, email notifications, PDF cover
  text) — the same voice and structure should carry through everywhere the user reads about
  themselves.
Do **not** apply the narrative/scenario voice to the actual test *questions* (the 1–7 Likert
statements) — those need to stay neutral, plain, and non-leading so they measure accurately.
This skill is about how results are *explained back* to the person, not how they're measured.

SOP;

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

=== SOP PENULISAN (VOICE & STYLE GUIDELINES) ===
{$sopText}

INSTRUKSI KHUSUS PERUMUSAN TEKS (WAJIB 100% BERBASIS KNOWLEDGE BASE DI ATAS):
1. 'archetype_box_desc': Buat 2 paragraf narasi arketipe yang mendalam, kaya, dan memikat tentang esensi manifestasi arketipe {$archetypeName} klien. Paragraf 1 menjelaskan perpaduan kedua driver dan pola pertimbangan klien, Paragraf 2 menjelaskan manifestasi peran kepemimpinan/profesionalnya secara nyata (WAJIB MENGACU PADA DATA SINERGI RESMI DI ATAS, pisahkan kedua paragraf dengan baris baru \n\n).
2. 'apa_artinya': Buat satu paragraf narasi personal yang menguraikan makna perpaduan skor 5 driver dan dinamika arketipe {$archetypeName} klien secara elegan, mendalam, dan memberdayakan.
3. 'wawasan_utama': Buat satu paragraf refleksi strategis mengenai titik pertumbuhan (Growth Path) dan pengingat praktis bagi klien.
4. 'drivers_explanation': Buat penjelasan personal 1-2 kalimat untuk masing-masing dari 5 Driver (security, significance, connection, growth, contribution) yang menjelaskan bagaimana driver tersebut (dengan level dan skor riilnya) bekerja pada diri klien sehari-hari.
5. 'strengths_in_action': Rangkum 3-4 poin kekuatan nyata klien dalam tindakan yang dirumuskan dari knowledge base sinergi & driver. (Format: array of object { "title": "Nama Kekuatan™", "desc": "Penjelasan singkat bagaimana kekuatan ini terwujud secara nyata." })
6. 'growth_opportunities': Rangkum 3-4 poin peluang bertumbuh (blind spots) klien yang dirumuskan secara konstruktif dan solutif dari knowledge base. (Format: array of object { "title": "Nama Blindspot™", "desc": "Penjelasan singkat dan panduan praktis untuk mengatasinya." })
7. 'dynamix_reflection': Buat 2 kalimat refleksi personal yang menjelaskan dinamika Healthy State vs Shadow State klien, bagaimana tanda-tanda ketika klien sedang dalam kondisi optimal vs saat mulai tertekan/terjebak dalam shadow state.
8. 'dq_interpretations': Buat kalimat interpretasi personal (1-2 kalimat) untuk masing-masing 5 sub-dimensi DQ (Awareness, Insight, Regulation, Development, Transformation), jelaskan bagaimana dimensi ini terwujud secara nyata pada diri klien dengan menyesuaikannya terhadap *dominant driver* mereka.

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
  "dynamix_reflection": "Refleksi...",
  "dq_interpretations": {
    "awareness": "Kalimat...",
    "insight": "Kalimat...",
    "regulation": "Kalimat...",
    "development": "Kalimat...",
    "transformation": "Kalimat..."
  }
}
PROMPT;
    }

    /**
     * Call Google Gemini API.
     */
    protected function callGemini(string $prompt): ?array
    {
        $apiKey = trim(env('GEMINI_API_KEY', config('services.gemini.api_key')));
        if (empty($apiKey)) {
            return null;
        }

        $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
                'x-goog-api-key' => $apiKey,
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
