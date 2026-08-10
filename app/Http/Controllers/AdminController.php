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
        
        return view('admin.dashboard', compact('totalAssessments', 'totalQuestions', 'totalPayments'));
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
            'order' => 'required|integer',
            'is_active' => 'required|boolean'
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
}
