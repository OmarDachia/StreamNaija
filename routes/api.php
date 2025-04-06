<?php
use App\Http\Controllers\Api\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('videos')->group(function () {
    Route::get('/', [VideoController::class, 'index']);         // List videos
    Route::get('{id}', [VideoController::class, 'show']);       // Get a single video
    Route::middleware(['auth:sanctum'])->post('/', [VideoController::class, 'store']);        // Create video
    Route::middleware(['auth:sanctum'])->put('{id}', [VideoController::class, 'update']);     // Update video
});
