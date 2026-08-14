<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserAssessment;
use App\Models\AssessmentAnswer;
use App\Models\Group;
use App\Services\PsychologicalAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Exception;
use Carbon\Carbon;

class AssessmentController extends Controller
{
    /**
     * Validasi kode grup dari frontend sebelum tes dimulai.
     */
    public function validateGroup(Request $request)
    {
        $code = $request->input('code');
        if (!$code) {
            return response()->json(['valid' => false, 'message' => 'Kode grup tidak boleh kosong.']);
        }

        $group = Group::where('code', $code)->first();

        if (!$group) {
            return response()->json(['valid' => false, 'message' => 'Kode grup tidak ditemukan.']);
        }

        if (!$group->is_active) {
            return response()->json(['valid' => false, 'message' => 'Grup ini sedang tidak aktif.']);
        }

        $now = Carbon::now();

        if ($group->start_time && $now->lt($group->start_time)) {
            return response()->json(['valid' => false, 'message' => 'Mohon maaf, waktu pengisian untuk Grup ini belum dimulai.']);
        }

        if ($group->end_time && $now->gt($group->end_time)) {
            return response()->json(['valid' => false, 'message' => 'Mohon maaf, batas waktu pengisian untuk Grup ini telah berakhir.']);
        }

        $currentCount = $group->assessments()->count();
        if ($currentCount >= $group->quota) {
            return response()->json(['valid' => false, 'message' => 'Mohon maaf, kuota peserta untuk Grup ini sudah penuh.']);
        }

        return response()->json([
            'valid' => true,
            'group' => [
                'id' => $group->id,
                'name' => $group->name,
                'code' => $group->code,
            ]
        ]);
    }
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
        // Record start time in session
        session(['assessment_start_time' => now()]);

        $questions = Question::with(['driver', 'subDriver'])
            ->where('is_active', true)
            ->orderBy('order', 'asc')
            ->get()
            ->map(function ($q) {
                return [
                    'id'           => $q->id,
                    'driver'       => $q->driver ? strtolower($q->driver->name) : 'general',
                    'type'         => $q->type,
                    'subComposite' => $q->subDriver ? $q->subDriver->name : null,
                    'pairWith'     => null, // In standard IMT this should map to pair logic if stored, or left as null if not strictly needed in frontend beyond order
                    'text'         => $q->question_text,
                ];
            });

        return view('test', [
            'dbQuestions' => $questions,
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
        $validated = $request->validate([
            'participant_name' => 'required|string|max:100',
            'email'            => 'nullable|email|max:255',
            'dob'              => 'nullable|string|max:20',
            'job'              => 'nullable|string|max:100',
            'gender'           => 'nullable|string|max:20',
            'phone'            => 'nullable|string|max:20',
            'position'         => 'nullable|string|max:100',
            'group_id'         => 'nullable|exists:groups,id',
            'answers'          => 'required|array|min:1',
            'answers.*'        => 'required|integer|min:1|max:7',
        ]);

        $submittedQuestionIds = array_keys($validated['answers']);
        $questions = Question::with('driver')->whereIn('id', $submittedQuestionIds)->get()->keyBy('id');

        $driverStats = [];
        $drivers = ['security', 'significance', 'connection', 'growth', 'contribution'];
        foreach ($drivers as $driver) {
            $driverStats[$driver] = [
                'actual_score_sum' => 0,
                'question_count'   => 0,
            ];
        }

        $subDriverStats = [];

        foreach ($validated['answers'] as $questionId => $rawScore) {
            $question = $questions->get($questionId);
            if (!$question) continue;

            $driverName = strtolower($question->driver->name ?? 'general');

            $calcScore = ($question->type === 'reverse core') ? (8 - $rawScore) : $rawScore;

            if ($subDriverId = $question->sub_driver_id) {
                if (!isset($subDriverStats[$subDriverId])) {
                    $subDriverStats[$subDriverId] = [
                        'actual_score_sum' => 0,
                        'question_count'   => 0,
                        'driver_name'      => $driverName,
                    ];
                }
                $subDriverStats[$subDriverId]['actual_score_sum'] += (int) $calcScore;
                $subDriverStats[$subDriverId]['question_count']   += 1;
            }
        }

        $finalSubScores = [];
        $driverSubScoreSums = [];
        $driverSubScoreCounts = [];

        foreach ($subDriverStats as $subDriverId => $stat) {
            $count = $stat['question_count'];
            $actualSum = $stat['actual_score_sum'];
            if ($count > 0) {
                $minPossible = $count * 1;
                $range = $count * 6;
                $percentage = (($actualSum - $minPossible) / $range) * 100;
                $subScore = round(max(0, min(100, $percentage)));
                $finalSubScores[$subDriverId] = $subScore;

                $dName = $stat['driver_name'];
                if (in_array($dName, $drivers)) {
                    if (!isset($driverSubScoreSums[$dName])) {
                        $driverSubScoreSums[$dName] = 0;
                        $driverSubScoreCounts[$dName] = 0;
                    }
                    $driverSubScoreSums[$dName] += $subScore;
                    $driverSubScoreCounts[$dName] += 1;
                }
            }
        }

        $finalScores = [];
        foreach ($drivers as $driver) {
            if (isset($driverSubScoreSums[$driver]) && $driverSubScoreCounts[$driver] > 0) {
                $finalScores[$driver] = round($driverSubScoreSums[$driver] / $driverSubScoreCounts[$driver], 2);
            } else {
                $finalScores[$driver] = 50.00;
            }
        }

        $durationSeconds = null;
        if (session()->has('assessment_start_time')) {
            $startTime = session('assessment_start_time');
            $durationSeconds = $startTime->diffInSeconds(now());
            session()->forget('assessment_start_time');
        }

        $userAssessment = DB::transaction(function () use ($validated, $finalScores, $finalSubScores, $questions, $durationSeconds) {
            $assessment = UserAssessment::create([
                'name'               => $validated['participant_name'],
                'email'              => $validated['email'] ?? null,
                'dob'                => $validated['dob'] ?? null,
                'job'                => $validated['job'] ?? null,
                'gender'             => $validated['gender'] ?? null,
                'phone'              => $validated['phone'] ?? null,
                'position'           => $validated['position'] ?? null,
                'group_id'           => $validated['group_id'] ?? null,
                'security_score'     => $finalScores['security'],
                'significance_score' => $finalScores['significance'],
                'connection_score'   => $finalScores['connection'],
                'growth_score'       => $finalScores['growth'],
                'contribution_score' => $finalScores['contribution'],
                'duration_seconds'   => $durationSeconds,
            ]);

            $answersData = [];
            $now = now();
            foreach ($validated['answers'] as $questionId => $rawScore) {
                $q = $questions->get($questionId);
                $calcScore = ($q && $q->type === 'reverse core') ? (8 - $rawScore) : $rawScore;

                $answersData[] = [
                    'user_assessment_id' => $assessment->id,
                    'question_id'        => $questionId,
                    'score'              => (int) $rawScore,
                    'calculated_score'   => (int) $calcScore,
                    'created_at'         => $now,
                    'updated_at'         => $now,
                ];
            }
            AssessmentAnswer::insert($answersData);

            $subDriversData = [];
            foreach ($finalSubScores as $subDriverId => $score) {
                $subDriversData[] = [
                    'user_assessment_id' => $assessment->id,
                    'sub_driver_id'      => $subDriverId,
                    'score'              => $score,
                    'created_at'         => $now,
                    'updated_at'         => $now,
                ];
            }
            if (!empty($subDriversData)) {
                DB::table('user_assessment_sub_drivers')->insert($subDriversData);
            }

            return $assessment;
        });

        return response()->json([
            'success' => true,
            'redirect_url' => route('assessment.laporan', ['id' => $userAssessment->id])
        ]);
    }

    /**
     * Alias method untuk kompatibilitas route sebelumnya.
     */
    public function submitTest(Request $request)
    {
        return $this->submitAnswers($request);
    }

    public function generateReport($id, PsychologicalAIService $aiService)
    {
        $data = UserAssessment::with('group')->findOrFail($id);
        $assessment = $data;

        $isAdmin = auth()->check();
        $user = auth()->user();

        // Cek visibilitas laporan grup
        if ($assessment->group) {
            // Cek untuk publik/peserta (belum login)
            if ($assessment->group->report_visibility === 'admin_only' && !$isAdmin) {
                return view('assessment.thankyou', [
                    'assessment' => $assessment,
                    'group' => $assessment->group
                ]);
            }

            // Cek untuk Admin Perusahaan (Client Admin)
            if ($isAdmin && $user->role === 'client_admin') {
                if (!$assessment->group->client_can_view_reports) {
                    abort(403, 'Akses melihat laporan individu belum diberikan oleh Super Admin. Anda tetap bisa melihat laporan keseluruhan Grup.');
                }
            }
        }

        $scores = [
            'security'     => (float) $data->security_score,
            'significance' => (float) $data->significance_score,
            'connection'   => (float) $data->connection_score,
            'growth'       => (float) $data->growth_score,
            'contribution' => (float) $data->contribution_score,
        ];

        // -------------------------------------------------------------------------
        // OPSI 2: AMBIL NARASI SINGKAT DARI AI ATAU DATABASE JIKA SUDAH ADA
        // -------------------------------------------------------------------------
        $ai_summary = "";
        if (!empty($data->ai_narasi)) {
            $ai_summary = is_string($data->ai_narasi) ? $data->ai_narasi : json_encode($data->ai_narasi);
        } else {
            // Generate Executive Summary
            try {
                $prompt = "Peserta ini bernama {$data->name}, pekerjaannya adalah 'TBD', dan skor top drivernya adalah Security ({$scores['security']}) dan Growth ({$scores['growth']}). Buatkan 1 paragraf pesan personal singkat (Executive Summary) yang memotivasi dan memberi arahan praktis khusus untuk pekerjaannya/perannya berdasarkan kombinasi dua kekuatan utamanya.";

                // For demonstration, we simulate the AI service since we are using Gemini directly in production or via API
                // $ai_summary = $aiService->generateText($prompt);
                // Here we will just use a placeholder to save token limits if AI service is not updated yet.
                $ai_summary = "Berdasarkan hasil asesmen, Anda memiliki dorongan kuat untuk mencari rasa aman sekaligus bertumbuh. Kombinasi ini menjadikan Anda sosok yang inovatif namun tetap berpijak pada realitas. Jadikan kekuatan ini sebagai jangkar Anda untuk memimpin dan menciptakan perubahan positif secara terukur, baik untuk diri Anda maupun lingkungan sekitar.";

                $data->update(['ai_narasi' => $ai_summary]);
            } catch (\Exception $e) {
                $ai_summary = "Laporan berhasil diolah.";
            }
        }

        $dbQuestions = Question::with(['driver', 'subDriver'])
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(function ($q) {
                return [
                    'id' => $q->id,
                    'driver' => $q->driver ? strtolower($q->driver->name) : 'general',
                    'type' => $q->type,
                    'subComposite' => $q->subDriver ? $q->subDriver->name : null,
                    'text' => $q->question_text
                ];
            });

        $answers = \App\Models\AssessmentAnswer::where('user_assessment_id', $assessment->id)
            ->pluck('score', 'question_id')
            ->toArray();

        $isAdmin = auth()->check();

        return view('report', compact(
            'assessment',
            'scores',
            'ai_summary',
            'dbQuestions',
            'answers',
            'isAdmin'
        ));
    }
}
