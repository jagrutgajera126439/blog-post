<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [BlogController::class, 'dashboard'])
    ->name('dashboard');

Route::resource('blogs', BlogController::class);

Route::resource('categories', CategoryController::class);