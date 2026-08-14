<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\UserAssessment;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $totalAssessments = UserAssessment::count();
        $totalQuestions = Question::count();
        $totalPayments = DB::table('payments')->where('status', 'success')->sum('amount');
        $totalGroups = \App\Models\Group::count();
        
        return view('admin.dashboard', compact('totalAssessments', 'totalQuestions', 'totalPayments', 'totalGroups'));
    }

    public function questions()
    {
        $questions = Question::with(['driver', 'subDriver'])->orderBy('order')->get();
        return view('admin.questions.index', compact('questions'));
    }

    public function questionsEdit($id)
    {
        $question = Question::with(['driver', 'subDriver'])->findOrFail($id);
        return view('admin.questions.edit', compact('question'));
    }

    public function questionsUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'type'          => 'required|string',
            'order'         => 'required|integer',
            'is_active'     => 'required|boolean'
        ]);

        $question = Question::findOrFail($id);
        $question->update($validated);

        return redirect()->route('admin.questions')->with('success', 'Soal berhasil diperbarui.');
    }

    public function assessments()
    {
        $assessments = UserAssessment::orderBy('created_at', 'desc')->get();
        return view('admin.assessments.index', compact('assessments'));
    }

    public function assessmentsDestroy($id)
    {
        $assessment = UserAssessment::findOrFail($id);
        $assessment->delete();
        return redirect()->route('admin.assessments')->with('success', 'Jawaban user berhasil dihapus.');
    }

    public function payments()
    {
        $payments = DB::table('payments')
            ->join('user_assessments', 'payments.user_assessment_id', '=', 'user_assessments.id')
            ->select('payments.*', 'user_assessments.name as user_name', 'user_assessments.created_at as assessment_date')
            ->orderBy('payments.created_at', 'desc')
            ->get();
            
        return view('admin.payments.index', compact('payments'));
    }

    // --- MANAJEMEN GRUP ---

    public function groups(Request $request)
    {
        $query = \App\Models\Group::withCount('assessments')->with('user')->orderBy('created_at', 'desc');
        if (!$request->user()->isSuperAdmin()) {
            $query->where('user_id', $request->user()->id);
        }
        $groups = $query->get();
        
        $clients = collect();
        if ($request->user()->isSuperAdmin()) {
            $clients = \App\Models\User::where('role', 'client_admin')->get();
        }

        return view('admin.groups.index', compact('groups', 'clients'));
    }

    public function groupsStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'nullable|string|max:255',
            'quota' => 'required|integer|min:1',
            'report_visibility' => 'required|in:admin_only,individual',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'user_id' => 'nullable|exists:users,id',
            'logo' => 'nullable|image|max:2048',
            'client_can_view_reports' => 'boolean',
        ]);

        // Generate unique code (e.g. XYZ123)
        $code = strtoupper(substr(uniqid(), -6));
        $validated['code'] = $code;
        $validated['is_active'] = true;
        $validated['client_can_view_reports'] = $request->has('client_can_view_reports');

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo_path'] = $path;
        }

        \App\Models\Group::create($validated);

        return redirect()->route('admin.groups')->with('success', 'Grup baru berhasil dibuat dengan kode: ' . $code);
    }

    public function groupsEdit($id)
    {
        $group = \App\Models\Group::findOrFail($id);
        $clients = \App\Models\User::where('role', 'client_admin')->get();
        return view('admin.groups.edit', compact('group', 'clients'));
    }

    public function groupsUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'nullable|string|max:255',
            'quota' => 'required|integer|min:1',
            'report_visibility' => 'required|in:admin_only,individual',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'user_id' => 'nullable|exists:users,id',
            'is_active' => 'boolean',
            'client_can_view_reports' => 'boolean',
            'logo' => 'nullable|image|max:2048',
        ]);

        $group = \App\Models\Group::findOrFail($id);
        
        // Checkbox values might not be sent if unchecked
        $validated['is_active'] = $request->has('is_active');
        $validated['client_can_view_reports'] = $request->has('client_can_view_reports');
        
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($group->logo_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($group->logo_path);
            }
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo_path'] = $path;
        }

        $group->update($validated);

        return redirect()->route('admin.groups')->with('success', 'Data grup berhasil diperbarui.');
    }

    public function groupsDestroy($id)
    {
        $group = \App\Models\Group::findOrFail($id);
        $group->delete();
        return redirect()->route('admin.groups')->with('success', 'Grup berhasil dihapus.');
    }

    public function groupsReport(Request $request, $id)
    {
        $group = \App\Models\Group::findOrFail($id);
        if (!$request->user()->isSuperAdmin() && $group->user_id !== $request->user()->id) abort(403, 'Akses ditolak.');
        
        $assessments = UserAssessment::where('group_id', $group->id)->get();
        
        if ($assessments->count() === 0) {
            return redirect()->route('admin.groups')->with('error', 'Belum ada peserta di grup ini.');
        }

        $totalParticipants = $assessments->count();

        // 1. Average Scores & Min/Max & Composition
        $driverStats = [
            'security' => ['min' => 100, 'max' => 0, 'count' => 0],
            'significance' => ['min' => 100, 'max' => 0, 'count' => 0],
            'connection' => ['min' => 100, 'max' => 0, 'count' => 0],
            'growth' => ['min' => 100, 'max' => 0, 'count' => 0],
            'contribution' => ['min' => 100, 'max' => 0, 'count' => 0],
        ];

        foreach ($assessments as $a) {
            $s = [
                'security' => $a->security_score,
                'significance' => $a->significance_score,
                'connection' => $a->connection_score,
                'growth' => $a->growth_score,
                'contribution' => $a->contribution_score,
            ];
            
            arsort($s);
            $topDriver = array_key_first($s);
            $driverStats[$topDriver]['count']++;
            
            foreach ($s as $driver => $score) {
                if ($score < $driverStats[$driver]['min']) $driverStats[$driver]['min'] = $score;
                if ($score > $driverStats[$driver]['max']) $driverStats[$driver]['max'] = $score;
            }
        }

        foreach ($driverStats as $driver => &$stat) {
            if ($stat['min'] == 100 && $stat['max'] == 0) $stat['min'] = 0;
            $stat['percentage'] = round(($stat['count'] / $totalParticipants) * 100);
        }

        $avgScores = [
            'security' => round($assessments->avg('security_score')),
            'significance' => round($assessments->avg('significance_score')),
            'connection' => round($assessments->avg('connection_score')),
            'growth' => round($assessments->avg('growth_score')),
            'contribution' => round($assessments->avg('contribution_score')),
        ];

        // 2. Determine Archetype
        $sortedAverages = $avgScores;
        arsort($sortedAverages);
        $top1 = array_keys($sortedAverages)[0];
        $top2 = array_keys($sortedAverages)[1];
        
        $fixedOrder = ['security', 'significance', 'connection', 'growth', 'contribution'];
        $idx1 = array_search($top1, $fixedOrder);
        $idx2 = array_search($top2, $fixedOrder);
        $archTop1 = $idx1 < $idx2 ? $top1 : $top2;
        $archTop2 = $idx1 < $idx2 ? $top2 : $top1;
        $archetypeKey = "{$archTop1}_{$archTop2}";
        $archetype = config("imt_team_archetypes.archetypes.$archetypeKey");

        // 3. Team DQ
        $diValues = [
            'awareness' => round(($avgScores[$top1] + $avgScores['growth']) / 2),
            'insight' => round(($avgScores['significance'] + $avgScores['connection']) / 2),
            'regulation' => round(($avgScores['security'] + $avgScores['growth']) / 2),
            'development' => $avgScores['growth'],
            'transformation' => round(array_sum($avgScores) / 5),
        ];
        $avgDq = round(array_sum($diValues) / 5);

        // 4. Sub Composites Top 5 & Bottom 5
        $subDriverStats = \Illuminate\Support\Facades\DB::table('assessment_answers')
            ->join('user_assessments', 'assessment_answers.user_assessment_id', '=', 'user_assessments.id')
            ->join('questions', 'assessment_answers.question_id', '=', 'questions.id')
            ->join('sub_drivers', 'questions.sub_driver_id', '=', 'sub_drivers.id')
            ->join('drivers', 'sub_drivers.driver_id', '=', 'drivers.id')
            ->where('user_assessments.group_id', $group->id)
            ->whereNotNull('questions.sub_driver_id')
            ->select(
                'sub_drivers.id',
                'sub_drivers.name',
                'drivers.name as driver_name',
                \Illuminate\Support\Facades\DB::raw("AVG(CASE WHEN questions.type = 'reverse core' THEN 8 - assessment_answers.score ELSE assessment_answers.score END) as avg_score"),
                \Illuminate\Support\Facades\DB::raw("MIN(CASE WHEN questions.type = 'reverse core' THEN 8 - assessment_answers.score ELSE assessment_answers.score END) as min_score"),
                \Illuminate\Support\Facades\DB::raw("MAX(CASE WHEN questions.type = 'reverse core' THEN 8 - assessment_answers.score ELSE assessment_answers.score END) as max_score")
            )
            ->groupBy('sub_drivers.id', 'sub_drivers.name', 'drivers.name')
            ->get();

        $subComposites = $subDriverStats->map(function($stat) {
            $normalized = (($stat->avg_score - 1) / 6) * 100;
            $minNorm = (($stat->min_score - 1) / 6) * 100;
            $maxNorm = (($stat->max_score - 1) / 6) * 100;
            return [
                'name' => $stat->name,
                'driver' => strtolower($stat->driver_name),
                'score' => round($normalized),
                'min' => round(max(0, $minNorm)),
                'max' => round(min(100, $maxNorm))
            ];
        })->sortByDesc('score')->values();

        $top5SubComposites = $subComposites->take(5);
        $bottom5SubComposites = $subComposites->reverse()->take(5)->values();

        $avgDurationSeconds = $assessments->whereNotNull('duration_seconds')->avg('duration_seconds');
        $avgDurationFormatted = '-';
        if ($avgDurationSeconds) {
            $avgDurationFormatted = floor($avgDurationSeconds / 60) . 'm ' . round($avgDurationSeconds % 60) . 's';
        }

        // 5. Validity Clean Rate
        $flaggedCount = $assessments->where('duration_seconds', '<', 150)->count(); // Proxy < 2.5 mins
        $cleanCount = $totalParticipants - $flaggedCount;
        $cleanPercentage = $totalParticipants > 0 ? round(($cleanCount / $totalParticipants) * 100) : 0;
        $flaggedPercentage = 100 - $cleanPercentage;
        
        $validity = [
            'cleanCount' => $cleanCount,
            'cleanPercentage' => $cleanPercentage,
            'flaggedCount' => $flaggedCount,
            'flaggedPercentage' => $flaggedPercentage,
        ];

        // 6. Training Recommendations
        $lowestDriver = collect($avgScores)->sort()->keys()->first();
        $lowestDriverScore = $avgScores[$lowestDriver];
        $lowestDriverName = ucfirst($lowestDriver);

        $trainingRecommendations = [
            [
                'cat' => 'Assessment & Coaching',
                'title' => 'Uncovering Hidden Barriers: Assessment & Coaching for Team Stability',
                'desc' => 'Menggali lebih dalam akar dari skor ' . $lowestDriverName . ' yang rendah lewat pendampingan personal, sebelum jadi masalah operasional yang lebih besar.',
                'basis' => 'Berdasarkan: ' . $lowestDriverName . ' driver paling rendah di tim (' . $lowestDriverScore . '%)'
            ],
            [
                'cat' => 'NLP Training',
                'title' => 'Managing Mental & Emotion Using NLP and Inner Motivation',
                'desc' => 'Melatih tim mengubah pola pikir saat menghadapi tekanan dan ketidakpastian, supaya lebih konsisten dan tidak reaktif.',
                'basis' => 'Berdasarkan: Area pengembangan dari DQ Tim (Regulation ' . $diValues['regulation'] . '%)'
            ],
            [
                'cat' => 'Leadership Development',
                'title' => 'Leading with Confidence: Strategic Decision-Making Under Pressure',
                'desc' => 'Melatih para pemimpin tim mengambil keputusan dengan lebih percaya diri dan menjaga stabilitas moral.',
                'basis' => 'Berdasarkan: Area perbaikan sub-composite terkait kepemimpinan'
            ],
            [
                'cat' => 'Team Alignment Experience',
                'title' => 'Building Trust That Lasts: Team Alignment & Commitment Experience',
                'desc' => 'Memperkuat rasa saling percaya dan konsistensi antar anggota tim, supaya komitmen yang diucapkan benar-benar dijalankan.',
                'basis' => 'Berdasarkan: Dinamika tim pada aspek Connection (' . $avgScores['connection'] . '%)'
            ],
            [
                'cat' => 'Outbound & Team Building',
                'title' => 'Sustaining Momentum: Outbound & Team Building for Focused Growth',
                'desc' => 'Menjaga kekompakan dan ritme kerja yang ada, sambil melatih eksekusi yang lebih terstruktur.',
                'basis' => 'Berdasarkan: ' . ucfirst($top1) . ' sebagai driver dominan tim (' . $avgScores[$top1] . '%)'
            ]
        ];

        return view('admin.groups.team-report', compact(
            'group', 'totalParticipants', 'avgScores', 'driverStats', 
            'archetype', 'avgDq', 'diValues', 'top5SubComposites', 'bottom5SubComposites', 'top1', 'avgDurationFormatted',
            'validity', 'trainingRecommendations'
        ));
    }

    public function groupsMembers(Request $request, $id)
    {
        $group = \App\Models\Group::findOrFail($id);
        if (!$request->user()->isSuperAdmin() && $group->user_id !== $request->user()->id) abort(403, 'Akses ditolak.');
        $members = UserAssessment::where('group_id', $group->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('admin.groups.members', compact('group', 'members'));
    }
    // --- MANAJEMEN USERS (ROLE AKSES) ---
    public function users()
    {
        $users = \App\Models\User::orderBy('role', 'desc')->orderBy('name')->get();
        return view('admin.users.index', compact('users'));
    }

    public function usersStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        $validated['role'] = 'client_admin';

        \App\Models\User::create($validated);
        return redirect()->route('admin.users')->with('success', 'Akses Client Admin berhasil dibuat.');
    }

    public function usersEdit($id)
    {
        $user = \App\Models\User::findOrFail($id);
        if ($user->role === 'super_admin') abort(403, 'Tidak bisa mengedit Super Admin');
        return view('admin.users.edit', compact('user'));
    }

    public function usersUpdate(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);
        if ($user->role === 'super_admin') abort(403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        return redirect()->route('admin.users')->with('success', 'Akses Client Admin diperbarui.');
    }

    public function usersDestroy($id)
    {
        $user = \App\Models\User::findOrFail($id);
        if ($user->role === 'super_admin') abort(403);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Akses Client Admin dihapus.');
    }
}
