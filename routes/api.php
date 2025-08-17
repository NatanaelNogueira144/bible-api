<?php

use App\Http\Controllers\{
    ReadingPlanDayController,
    VerseController
};
use Illuminate\Support\Facades\Route;

Route::get('/passage/{version}/{abbrev}/{passages}', [VerseController::class, 'index']);
Route::get('/plan/{planId}/{day}/{version}', [ReadingPlanDayController::class, 'index']);

Route::fallback(function() {
    return response()->json(['message' => 'Nada foi encontrado!'], 404);
});