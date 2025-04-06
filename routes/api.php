use App\Http\Controllers\Api\VideoController;

Route::prefix('videos')->group(function () {
    Route::get('/', [VideoController::class, 'index']);         // List videos (paginated)
    Route::get('{id}', [VideoController::class, 'show']);       // Get single video
    Route::post('/', [VideoController::class, 'store']);        // Create new video
    Route::put('{id}', [VideoController::class, 'update']);     // Update video
});