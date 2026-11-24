<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserBlogController;

// Public Login
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// Public Registration
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Normal User Routes
Route::middleware('auth')->group(function () {

    Route::get('/user-dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');

    // User Blog Management
    Route::resource('/my-blogs', UserBlogController::class)
        ->except(['show'])
        ->names('user.blogs');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [BlogController::class, 'dashboard'])
        ->name('dashboard');

    Route::resource('blogs', BlogController::class);

    Route::resource('categories', CategoryController::class);
});
