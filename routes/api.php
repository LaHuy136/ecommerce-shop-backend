<?php


use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Admin
Route::middleware(['auth:sanctum', 'apiLevel:1'])->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::get('/histories', [HistoryController::class, 'index']);

    Route::delete('/user/{user}', [SessionController::class, 'destroy']);
});

// Member
Route::middleware(['auth:sanctum', 'apiLevel:0'])->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/blogs', [BlogController::class, 'index']);
});

// Update user
Route::middleware('auth:sanctum')
    ->patch('/user/{id}', [SessionController::class, 'update']);

// Register & Login
Route::post('/login', [SessionController::class, 'login']);
Route::post('/register', [SessionController::class, 'register']);

// Forgot & Reset Password
Route::post('/forgot-password', [SessionController::class, 'forgotPassword']);
Route::post('/reset-password', [SessionController::class, 'resetPassword']);
