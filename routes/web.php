<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes - IMT Discovery
|--------------------------------------------------------------------------
*/

// 1. Landing Page (Menggunakan landing bawaan sebelumnya)
Route::get('/', function () {
    return view('landing');
})->name('home');

// 2. Dashboard User (Diarahkan langsung ke admin dashboard)
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

// 3. Halaman Ujian
Route::get('/tes', [AssessmentController::class, 'showTest'])->name('assessment.test');
Route::post('/tes/submit', [AssessmentController::class, 'submitAnswers'])->name('assessment.submit');

// 4. Laporan Hasil Profiling
Route::get('/laporan/{id}', [AssessmentController::class, 'generateReport'])->name('assessment.laporan');

// 5. Halaman Hasil Seluruh Peserta
Route::get('/hasil', [AssessmentController::class, 'results'])->name('assessment.results');

// 6. Admin Dashboard
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/questions', [AdminController::class, 'questions'])->name('admin.questions');
    Route::get('/questions/{id}/edit', [AdminController::class, 'questionsEdit'])->name('admin.questions.edit');
    Route::put('/questions/{id}', [AdminController::class, 'questionsUpdate'])->name('admin.questions.update');
    
    Route::get('/assessments', [AdminController::class, 'assessments'])->name('admin.assessments');
    Route::get('/payments', [AdminController::class, 'payments'])->name('admin.payments');

    Route::get('/groups', [AdminController::class, 'groups'])->name('admin.groups');
    Route::post('/groups', [AdminController::class, 'groupsStore'])->name('admin.groups.store');
    Route::get('/groups/{id}/edit', [AdminController::class, 'groupsEdit'])->name('admin.groups.edit');
    Route::put('/groups/{id}', [AdminController::class, 'groupsUpdate'])->name('admin.groups.update');
    Route::delete('/groups/{id}', [AdminController::class, 'groupsDestroy'])->name('admin.groups.destroy');
    Route::get('/groups/{id}/report', [AdminController::class, 'groupsReport'])->name('admin.groups.report');
});

// API Routes (Frontend Validation)
Route::post('/api/validate-group', [AssessmentController::class, 'validateGroup'])->name('api.validate.group');

// Breeze Auth & Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
