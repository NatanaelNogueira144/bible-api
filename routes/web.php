<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/diary', [HomeController::class, 'diary']);
Route::get('/weekly', [HomeController::class, 'weekly']);