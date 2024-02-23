<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Events\BaptismController;
use App\Http\Controllers\API\Events\BlessingController;
use App\Http\Controllers\API\Events\MatrimonyController;
use App\Http\Controllers\API\Events\FuneralController;
use App\Http\Controllers\API\Events\CommunionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::middleware(['auth'])->group(function () {
    Route::prefix('events')->group(function () {
        // Route::post('/baptisms', function() {
        //     dd(auth()->id());
        // });

        Route::post('/baptisms', [BaptismController::class,'store']);
        Route::post('/blessings', [BlessingController::class,'store']);
        Route::post('/weddings', [MatrimonyController::class,'store']);
        Route::post('/funerals', [FuneralController::class,'store']);
        Route::get('/communions/{communion}', [CommunionController::class,'show']);
        Route::post('/communions', [CommunionController::class,'store']);
    });
    
});

// Route::prefix('events')->group(function () {
    
// });

