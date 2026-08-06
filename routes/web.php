<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AssessmentController;

/*
|--------------------------------------------------------------------------
| Web Routes - IMT Discovery
|--------------------------------------------------------------------------
*/

// 1. Landing Page (React + Inertia.js)
Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// 2. Halaman Ujian Asesmen Interaktif (React + Inertia.js)
Route::get('/tes', [AssessmentController::class, 'showTest'])->name('assessment.test');
Route::post('/tes/submit', [AssessmentController::class, 'submitAnswers'])->name('assessment.submit');

// 3. Laporan Hasil Profiling Psikologi IMT Discovery (Gemini AI Powered)
Route::get('/laporan/{id}', [AssessmentController::class, 'generateReport'])->name('assessment.laporan');

// 4. Halaman Hasil Seluruh Peserta
Route::get('/hasil', [AssessmentController::class, 'results'])->name('assessment.results');

// 5. Temporary route for running migrations on Hostinger
Route::get('/run-migrations', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        return 'Migrasi database berhasil dijalankan!';
    } catch (\Exception $e) {
        return 'Error migrasi: ' . $e->getMessage();
    }
});
