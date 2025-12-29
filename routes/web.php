<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Admin
Route::get('/admin/dashboard', [DashboardController::class, 'index']);
Route::get('/admin/profile', [UserController::class, 'index']);
