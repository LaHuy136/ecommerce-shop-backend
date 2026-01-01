<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\HomeController;
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
        Route::get('/blog', [BlogController::class, 'index'])->name('admin.blogs.index');
        Route::get('/blog/create', [BlogController::class, 'create']);
        Route::post('/blog', [BlogController::class, 'store']);
        Route::get('/blog/{blog}/edit', [BlogController::class, 'edit']);
        Route::patch('/blog/{blog}', [BlogController::class, 'update']);
        Route::delete('/blog/{blog}', [BlogController::class, 'destroy']);
    });

// User
Route::middleware(['auth', 'level: 0'])
    ->group(function () {
        Route::get("/", [SessionController::class, 'index'])->name('member.dashboard');

        Route::get("/404", function () {
            return view('frontend.errors.404');
        });
        Route::get("/account", function () {
            return view('frontend.members.account');
        });

        Route::get("/blog", function () {
            return view('frontend.blogs.blog');
        });
        Route::get("/cart", function () {
            return view('frontend.carts.cart');
        });
        Route::get("/checkout", function () {
            return view('frontend.carts.checkout');
        });
        Route::get("/contact-us", function () {
            return view('frontend.contacts.contact-us');
        });
        Route::get("/shop", function () {
            return view('frontend.products.shop');
        });

        Route::get("/my-product", function () {
            return view('frontend.products.my-product');
        });
        Route::get("/add-product", function () {
            return view('frontend.products.add-product');
        });
    });

Route::middleware('guest')
    ->group(function () {
        Route::get('/login', [SessionController::class, 'create'])->name('login');
        Route::post('/login', [SessionController::class, 'login']);

        Route::get('/register', [RegisterMemberController::class, 'create']);
        Route::post('/register', [RegisterMemberController::class, 'register']);
    });

Route::post('/logout', [SessionController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// Auth
// Auth::routes();
// Route::get('/', [HomeController::class, 'index'])->name('home');
