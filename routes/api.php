<?php
use App\Http\Controllers\findtStudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ResultController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Route::prefix('api/results')->group(function () {


//     Route::get('download-certificate/{roll}/{regId}', [findtStudentController::class, 'downloadCertificate']);
// });


Route::get('/find-result/studentResultFind', [findtStudentController::class, 'marhalaFind']);


Route::get('studentResultFind', [findtStudentController::class, 'search']);

// Route::prefix('api/find_result')->middleware('api')->group(function () {

// });
Route::post('/results/upload', [ResultController::class, 'store'])->middleware(['auth']);
