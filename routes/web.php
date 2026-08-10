<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AssessmentController;

/*
|--------------------------------------------------------------------------
| Web Routes - IMT Discovery
|--------------------------------------------------------------------------
*/

// 1. Landing Page
Route::get('/', function () {
    return view('landing');
})->name('home');

// 2. Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// 3. Halaman Ujian
Route::get('/tes', [AssessmentController::class, 'showTest'])->name('assessment.test');
Route::post('/tes/submit', [AssessmentController::class, 'submitAnswers'])->name('assessment.submit');

// 4. Laporan Hasil Profiling
Route::get('/laporan/{id}', [AssessmentController::class, 'generateReport'])->name('assessment.laporan');

// 5. Halaman Hasil Seluruh Peserta
Route::get('/hasil', [AssessmentController::class, 'results'])->name('assessment.results');

// 6. Admin Dashboard
use App\Http\Controllers\AdminController;

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/questions', [AdminController::class, 'questions'])->name('admin.questions');
    Route::get('/questions/{id}/edit', [AdminController::class, 'questionsEdit'])->name('admin.questions.edit');
    Route::put('/questions/{id}', [AdminController::class, 'questionsUpdate'])->name('admin.questions.update');
    
    Route::get('/assessments', [AdminController::class, 'assessments'])->name('admin.assessments');
    Route::get('/payments', [AdminController::class, 'payments'])->name('admin.payments');
});
