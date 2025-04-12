<?php
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    return $user->createToken('api-token')->plainTextToken;
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('videos')->group(function () {
    // return Inertia::render('Videos', [
    //     'videoUrl' => Storage::url('videos/01JRE4Q4J8N7JRRKZ80V3GZ211.mp4'),
    // ]);
    Route::get('/', [VideoController::class, 'index']);         // List videos
    Route::get('{id}', [VideoController::class, 'show']);       // Get a single video
    Route::middleware(['auth:sanctum'])->post('/', [VideoController::class, 'store']);        // Create video
    Route::middleware(['auth:sanctum'])->put('{id}', [VideoController::class, 'update']);     // Update video
});



Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);         // List categories
    Route::get('{id}', [CategoryController::class, 'show']);       // Get a single category
    Route::middleware(['auth:sanctum'])->post('/', [CategoryController::class, 'store']);        // Create category
    Route::middleware(['auth:sanctum'])->put('{id}', [CategoryController::class, 'update']);     // Update category
});
