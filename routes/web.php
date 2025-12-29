<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Admin
Route::middleware('auth')->group(function () {
    Route::get('/admin/form-basic', function () {
        return view('admin.form-basic');
    });

    Route::get('/admin/table-basic', function () {
        return view('admin.table-basic');
    });


    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
    Route::get('/admin/profile', [UserController::class, 'index']);
    Route::patch('/admin/profile/{id}', [UserController::class, 'update']);
});

// Auth
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});



Route::get('/admin/country', function () {
    return view('admin.country.country');
});
