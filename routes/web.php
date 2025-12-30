<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Admin
Route::middleware('auth')->group(function () {
    // Basic
    Route::get('/admin/form-basic', function () {
        return view('admin.form-basic');
    });

    Route::get('/admin/table-basic', function () {
        return view('admin.table-basic');
    });

    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);

    // Profile
    Route::get('/admin/profile', [UserController::class, 'index']);
    Route::patch('/admin/profile/{id}', [UserController::class, 'update']);

    // Country
    Route::get('/admin/country', [CountryController::class, 'index'])->name('admin.country.index');
    Route::get('/admin/country/create', [CountryController::class, 'create']);
    Route::post('/admin/country', [CountryController::class, 'store']);
    Route::get('/admin/country/{country}/edit', [CountryController::class, 'edit']);
    Route::patch('/admin/country/{country}', [CountryController::class, 'update']);
    Route::delete('/admin/country/{country}', [CountryController::class, 'destroy']);

    // Blog
    Route::get('/admin/blog', [BlogController::class, 'index'])->name('admin.blog.index');
    Route::get('/admin/blog/create', [BlogController::class, 'create']);
    Route::post('/admin/blog', [BlogController::class, 'store']);
    Route::get('/admin/blog/{blog}/edit', [BlogController::class, 'edit']);
    Route::patch('/admin/blog/{blog}', [BlogController::class, 'update']);
    Route::delete('/admin/blog/{blog}', [BlogController::class, 'destroy']);
});

// Auth
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
