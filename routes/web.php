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
    ->name('find_result.studentResultFind')
    ->middleware('cache.headers:public;max_age=3600;etag');

Route::get('find_result/marhalawariFindResult', [findtStudentController::class, 'marhalaFind'])
    ->name('find_result.marhalawariFindResult')
    ->middleware('cache.headers:public;max_age=3600;etag');

    // Route::get('/find_result/studentResultFind/{Roll}/{reg_id}', [findtStudentController::class, 'search'])->name('find_result.studentResultFind');


    // Route::get('/find-result/student-result/{Roll}/{reg_id}/pdf', [findtStudentController::class, 'generatePdf'])
    // ->name('find_result.student_result.pdf');

    Route::get('/find-result/student-result/{Roll}/{reg_id}/pdf/{action?}', [findtStudentController::class, 'generatePdf'])
    ->name('find_result.student_result.pdf');


    route::get ('uploadResult/resultUpload', function(){

        return inertia::render('uploadResult/resultUpload');
    });







require __DIR__.'/auth.php';
