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
        $questions = Question::with('driver')->orderBy('order')->get();
        return view('admin.questions.index', compact('questions'));
    }

    public function questionsEdit($id)
    {
        $question = Question::findOrFail($id);
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

    public function groups()
    {
        $groups = \App\Models\Group::withCount('assessments')->orderBy('created_at', 'desc')->get();
        return view('admin.groups.index', compact('groups'));
    }

    public function groupsStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quota' => 'required|integer|min:1',
            'report_visibility' => 'required|in:admin_only,individual',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        // Generate unique code (e.g. GRUP-XYZ123)
        $code = 'GRUP-' . strtoupper(substr(uniqid(), -6));
        $validated['code'] = $code;
        $validated['is_active'] = true;

        \App\Models\Group::create($validated);

        return redirect()->route('admin.groups')->with('success', 'Grup baru berhasil dibuat dengan kode: ' . $code);
    }

    public function groupsEdit($id)
    {
        $group = \App\Models\Group::findOrFail($id);
        return view('admin.groups.edit', compact('group'));
    }

    public function groupsUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quota' => 'required|integer|min:1',
            'report_visibility' => 'required|in:admin_only,individual',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'is_active' => 'boolean',
        ]);

        $group = \App\Models\Group::findOrFail($id);
        
        // Checkbox values might not be sent if unchecked
        $validated['is_active'] = $request->has('is_active');
        
        $group->update($validated);

        return redirect()->route('admin.groups')->with('success', 'Data grup berhasil diperbarui.');
    }

    public function groupsDestroy($id)
    {
        $group = \App\Models\Group::findOrFail($id);
        $group->delete();
        return redirect()->route('admin.groups')->with('success', 'Grup berhasil dihapus.');
    }

    public function groupsReport($id)
    {
        $group = \App\Models\Group::findOrFail($id);
        
        // Need to calculate average scores for the group
        $assessments = UserAssessment::where('group_id', $group->id)->get();
        
        if ($assessments->count() === 0) {
            return redirect()->route('admin.groups')->with('error', 'Belum ada peserta di grup ini.');
        }

        $scores = [
            'security' => round($assessments->avg('security_score')),
            'significance' => round($assessments->avg('significance_score')),
            'connection' => round($assessments->avg('connection_score')),
            'growth' => round($assessments->avg('growth_score')),
            'contribution' => round($assessments->avg('contribution_score')),
        ];

        // Create a mock assessment object to satisfy the view
        $assessment = new UserAssessment();
        $assessment->name = $group->name;
        
        // Pass ai_summary placeholder (you might want to generate this based on group averages)
        $ai_summary = "Berdasarkan hasil agregat asesmen grup {$group->name}, skor rata-rata menunjukkan dinamika yang berpusat pada stabilitas dan pertumbuhan berkelanjutan. Tim ini cenderung menghargai kejelasan namun tetap berupaya untuk berkembang bersama.";

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

        // Calculate average answers for the group to satisfy sub-driver calculations in JS
        $allAnswers = DB::table('assessment_answers')
            ->join('user_assessments', 'assessment_answers.user_assessment_id', '=', 'user_assessments.id')
            ->where('user_assessments.group_id', $group->id)
            ->select('question_id', DB::raw('AVG(score) as avg_score'))
            ->groupBy('question_id')
            ->pluck('avg_score', 'question_id');

        $answers = $allAnswers->toArray();
        $isGroupReport = true;
        $totalParticipants = $assessments->count();

        return view('report', compact(
            'assessment', 
            'scores',
            'ai_summary',
            'dbQuestions',
            'answers',
            'isGroupReport',
            'totalParticipants'
        ));
    }
}
