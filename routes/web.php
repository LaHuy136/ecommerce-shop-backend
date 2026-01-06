<?php

use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Member\BlogController as MemberBlogController;
use App\Http\Controllers\Member\CommentController;
use App\Http\Controllers\Member\ProductController;
use App\Http\Controllers\Member\RateController;
use App\Http\Controllers\Member\RegisterMemberController;
use App\Http\Controllers\Member\SessionController;
use Illuminate\Support\Facades\Route;

// Admin
Route::prefix('admin')
    ->middleware(['auth', 'level:1'])
    ->group(function () {

        // Basic
        Route::get('/form-basic', function () {
            return view('admin.form-basic');
        });

        Route::get('/table-basic', function () {
            return view('admin.table-basic');
        });

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Profile
        Route::get('/profile', [UserController::class, 'index']);
        Route::patch('/profile/{id}', [UserController::class, 'update']);

        // Country
        Route::get('/country', [CountryController::class, 'index'])->name('admin.countries.index');
        Route::get('/country/create', [CountryController::class, 'create']);
        Route::post('/country', [CountryController::class, 'store']);
        Route::get('/country/{country}/edit', [CountryController::class, 'edit']);
        Route::patch('/country/{country}', [CountryController::class, 'update']);
        Route::delete('/country/{country}', [CountryController::class, 'destroy']);

        // Blog
        Route::get('/blog', [AdminBlogController::class, 'index'])->name('admin.blogs.index');
        Route::get('/blog/create', [AdminBlogController::class, 'create']);
        Route::post('/blog', [AdminBlogController::class, 'store']);
        Route::get('/blog/{blog}/edit', [AdminBlogController::class, 'edit']);
        Route::patch('/blog/{blog}', [AdminBlogController::class, 'update']);
        Route::delete('/blog/{blog}', [AdminBlogController::class, 'destroy']);
    });

// User
Route::middleware(['auth', 'level: 0'])
    ->group(function () {
        Route::get("/", [SessionController::class, 'index'])
            ->name('member.dashboard');

        // Account
        Route::get("/account", [SessionController::class, 'edit'])
            ->name('members.account');
        Route::patch("/account/{id}", [SessionController::class, 'update']);

        // Rating blog
        Route::post('/rate', [RateController::class, 'store'])
            ->name('rate.store');

        // Comment blog
        Route::post('/comments', [CommentController::class, 'store'])
            ->name('comments.store');

        // Cart
        Route::get("/cart", function () {
            return view('frontend.carts.cart');
        });
        Route::get("/checkout", function () {
            return view('frontend.carts.checkout');
        });

        // Contact
        Route::get("/contact-us", function () {
            return view('frontend.contacts.contact-us');
        });

        // Shop
        Route::get("/shop", function () {
            return view('frontend.products.shop');
        });

        // Product
        Route::get("/product", [ProductController::class, 'index'])
            ->name('products.index');
        Route::get("/product/create", [ProductController::class, 'create']);
        Route::post("/product", [ProductController::class, 'store']);
        Route::get("/product/{product}", [ProductController::class, 'show']);

        // Error
        Route::get("/404", function () {
            return view('frontend.errors.404');
        });
    });

Route::middleware('guest')
    ->group(function () {
        Route::get('/login', [SessionController::class, 'create'])
            ->name('login');
        Route::post('/login', [SessionController::class, 'login']);

        Route::get('/register', [RegisterMemberController::class, 'create']);
        Route::post('/register', [RegisterMemberController::class, 'register']);
    });

// Blog
Route::get("/blog", [MemberBlogController::class, 'index']);
Route::get('/blog/{blog}/comments', [CommentController::class, 'index']);
Route::get("/blog/{blog:slug}", [MemberBlogController::class, 'show'])
    ->name('blogs.show');

Route::post('/logout', [SessionController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// Auth
// Auth::routes();
// Route::get('/', [HomeController::class, 'index'])->name('home');
