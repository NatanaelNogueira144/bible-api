<?php

use App\Http\Controllers\VerseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/passage/{version}/{abbrev}/{passages}', [VerseController::class, 'index']);

Route::fallback(function() {
    return response()->json(['message' => 'Nada foi encontrado!'], 404);
});