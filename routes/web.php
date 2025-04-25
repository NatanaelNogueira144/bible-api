<?php

use Illuminate\Support\Facades\Route;

Route::get('/diary', 'App\Http\Controllers\HomeController@diary');
Route::get('/weekly', 'App\Http\Controllers\HomeController@weekly');