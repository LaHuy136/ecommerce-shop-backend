<?php

use App\Http\Controllers\Api\Admin\BlogController;
use App\Http\Controllers\Api\Admin\CountryController;
use App\Http\Controllers\Api\Admin\HistoryController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\ProfileController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\SessionController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Admin
Route::middleware(['auth:sanctum', 'apiLevel:1'])->group(function () {
    Route::get('/histories', [HistoryController::class, 'index']);

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::patch('/{id}', [ProfileController::class, 'update']);
    });

    // User
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'store']);
        Route::patch('/{id}', [UserController::class, 'update']);
        Route::delete('/{user}', [UserController::class, 'destroy']);
    });

    // Countries
    Route::prefix('countries')->group(function () {
        Route::get('/', [CountryController::class, 'index']);
        Route::get('/{id}', [CountryController::class, 'show']);
        Route::post('/', [CountryController::class, 'store']);
        Route::patch('/{id}', [CountryController::class, 'update']);
        Route::delete('/{country}', [CountryController::class, 'destroy']);
    });

    // Blogs
    Route::prefix('blogs')->group(function () {
        Route::get('/', [BlogController::class, 'index']);
        Route::get('/{id}', [BlogController::class, 'show']);
        Route::post('/', [BlogController::class, 'store']);
        Route::patch('/{id}', [BlogController::class, 'update']);
        Route::delete('/{blog}', [BlogController::class, 'destroy']);
    });

    // Products
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::post('/', [ProductController::class, 'store']);
        Route::patch('/{id}', [ProductController::class, 'update']);
        Route::delete('/{product}', [ProductController::class, 'destroy']);
    });
});

// Member
Route::middleware(['auth:sanctum', 'apiLevel:0'])->group(function () {
    // Route::get('/products', [ProductController::class, 'index']);

    Route::get('/account', [SessionController::class, 'index']);
    Route::patch('/account/{id}', [SessionController::class, 'update']);
});

// Register & Login
Route::post('/login', [SessionController::class, 'login']);
Route::post('/register', [SessionController::class, 'register']);

// Forgot & Reset Password
Route::post('/forgot-password', [SessionController::class, 'forgotPassword']);
Route::post('/reset-password', [SessionController::class, 'resetPassword']);
