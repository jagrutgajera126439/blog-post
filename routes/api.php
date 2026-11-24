<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;

Route::post('/create-admin', [AdminController::class, 'store']);