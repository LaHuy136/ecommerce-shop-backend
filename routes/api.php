<?php

use App\Http\Controllers\Api\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Api\Admin\CountryController;
use App\Http\Controllers\Api\Admin\HistoryController;
use App\Http\Controllers\Api\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Api\Admin\ProfileController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CountryController as ApiCountryController;
use App\Http\Controllers\Api\Member\BlogController as MemberBlogController;
use App\Http\Controllers\Api\Member\CommentController;
use App\Http\Controllers\Api\Member\ProductController as MemberProductController;
use App\Http\Controllers\Api\Member\RatePostController;
use App\Http\Controllers\Api\SessionController;
use Illuminate\Support\Facades\Route;

// Admin
// Route::middleware(['auth:sanctum', 'apiLevel:1'])
//     ->group(function () {
//         Route::get('/histories', [HistoryController::class, 'index']);

//         Route::prefix('profiles')->group(function () {
//             Route::get('/', [ProfileController::class, 'index']);
//             Route::patch('/{id}', [ProfileController::class, 'update']);
//         });

//         // User
//         Route::prefix('users')->group(function () {
//             Route::get('/', [UserController::class, 'index']);
//             Route::get('/{id}', [UserController::class, 'show']);
//             Route::post('/', [UserController::class, 'store']);
//             Route::patch('/{id}', [UserController::class, 'update']);
//             Route::delete('/{user}', [UserController::class, 'destroy']);
//         });

//         // Countries
//         Route::prefix('countries')->group(function () {
//             Route::get('/', [CountryController::class, 'index']);
//             Route::get('/{id}', [CountryController::class, 'show']);
//             Route::post('/', [CountryController::class, 'store']);
//             Route::patch('/{id}', [CountryController::class, 'update']);
//             Route::delete('/{country}', [CountryController::class, 'destroy']);
//         });

//         // Blogs
//         Route::prefix('blogs')->group(function () {
//             Route::get('/', [AdminBlogController::class, 'index']);
//             Route::get('/{id}', [AdminBlogController::class, 'show']);
//             Route::post('/', [AdminBlogController::class, 'store']);
//             Route::patch('/{id}', [AdminBlogController::class, 'update']);
//             Route::delete('/{blog}', [AdminBlogController::class, 'destroy']);
//         });

//         // Products
//         Route::prefix('products')->group(function () {
//             Route::get('/', [AdminProductController::class, 'index']);
//             Route::get('/{id}', [AdminProductController::class, 'show']);
//             Route::post('/', [AdminProductController::class, 'store']);
//             Route::patch('/{id}', [AdminProductController::class, 'update']);
//             Route::delete('/{id}', [AdminProductController::class, 'destroy']);
//         });
//     });

// Member
Route::middleware(['auth:sanctum', 'apiLevel:0'])
    ->prefix('user')
    ->group(function () {
        // Account
        Route::get('/', [SessionController::class, 'index']);
        Route::patch('/update/{id}', [SessionController::class, 'update']);

        Route::prefix('product')->group(function () {
            Route::get("/list", [MemberProductController::class, 'index']);
            Route::get("/{id}/edit", [MemberProductController::class, 'edit']);
            Route::delete("/wishlist", [MemberProductController::class, 'wishlist']);
            Route::post("/add", [MemberProductController::class, 'store']);
            Route::patch("/update/{id}", [MemberProductController::class, 'update']);
            Route::delete("/delete/{id}", [MemberProductController::class, 'destroy']);
        });

        // Comment Blog
        Route::post('/blog/comment', [CommentController::class, 'store']);

        // Rating Blog
        Route::post('/blog/rate', [RatePostController::class, 'store']);
    });

// Blogs
Route::prefix('blog')->group(function () {
    Route::get("/", [MemberBlogController::class, 'index']);
    Route::get('/{blog}/comments', [CommentController::class, 'index']);
    Route::get('/rate', [RatePostController::class, 'index']);
    Route::get("/detail/{id}", [MemberBlogController::class, 'show']);
});

//Countries
Route::get("/countries", [ApiCountryController::class, 'index']);
Route::get("/categories", [CategoryController::class, 'index']);
Route::get("/brands", [BrandController::class, 'index']);

// Products
Route::get("/product", [MemberProductController::class, 'home']);
Route::get("/product/list", [MemberProductController::class, 'shop']);
Route::get("/product/detail/{id}", [MemberProductController::class, 'show']);
Route::post("/products", [MemberProductController::class, 'getProducts']);

// Register & Login
Route::post('/login', [SessionController::class, 'login']);
Route::post('/register', [SessionController::class, 'register']);

// Forgot & Reset Password
Route::post('/forgot-password', [SessionController::class, 'forgotPassword']);
Route::post('/reset-password', [SessionController::class, 'resetPassword']);
