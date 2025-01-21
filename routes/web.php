<?php

use App\Http\Controllers\findtStudentController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('find_result/studentResultFind', [findtStudentController::class, 'search'])
    ->name('find_result.studentResultFind');

    Route::get('find_result/marhalawariFindResult', [findtStudentController::class, 'marhalaFind'])
    ->name('find_result.marhalawariFindResult');
    // Route::get('/find_result/studentResultFind/{Roll}/{reg_id}', [findtStudentController::class, 'search'])->name('find_result.studentResultFind');




    Route::get('/print-pdf/{Roll}/{reg_id}', [findtStudentController::class, 'generatePdf'])
    ->name('printPdf');






require __DIR__.'/auth.php';
