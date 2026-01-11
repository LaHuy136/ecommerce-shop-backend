<?php

use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Member\BlogController as MemberBlogController;
use App\Http\Controllers\Member\CartController;
use App\Http\Controllers\Member\CheckoutController;
use App\Http\Controllers\Member\CommentController;
use App\Http\Controllers\Member\ForgotPasswordController;
use App\Http\Controllers\Member\ProductController;
use App\Http\Controllers\Member\RateController;
use App\Http\Controllers\Member\RegisterMemberController;
use App\Http\Controllers\Member\ResetPasswordController;
use App\Http\Controllers\Member\SessionController;
use App\Http\Controllers\SearchController;
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

        // Product
        Route::get("/product", [ProductController::class, 'index'])
            ->name('products.index');
        Route::get("/product/create", [ProductController::class, 'create']);
        Route::post("/product", [ProductController::class, 'store']);

        Route::get("/product/{product}/edit", [ProductController::class, 'edit']);
        Route::patch("/product/{product}", [ProductController::class, 'update']);
        Route::delete("/product/{product}", [ProductController::class, 'destroy']);

        // Error
        Route::get("/404", function () {
            return view('frontend.errors.404');
        });
    });

Route::middleware('guest')
    ->group(function () {
        // Login
        Route::get('/login', [SessionController::class, 'create'])
            ->name('login');
        Route::post('/login', [SessionController::class, 'login']);

        // Register
        Route::get('/register', [RegisterMemberController::class, 'create']);
        Route::post('/register', [RegisterMemberController::class, 'register']);

        // Forgot & Reset Password
        Route::get('/forgot-password', [ForgotPasswordController::class, 'index']);
        Route::post('/forgot-password', [ForgotPasswordController::class, 'create'])
            ->name('password.forgot');

        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'show'])
            ->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'store'])
            ->name('password.update');
    });

Route::get("/", [SessionController::class, 'index'])
    ->name('member.dashboard');

// Blog
Route::get("/blog", [MemberBlogController::class, 'index']);
Route::get('/blog/{blog}/comments', [CommentController::class, 'index']);
Route::get("/blog/{blog:slug}", [MemberBlogController::class, 'show'])
    ->name('blogs.show');

// Product
Route::get('/product/search', [SearchController::class, 'index'])
    ->name('products.search');
Route::post('/product/search', [SearchController::class, 'search'])
    ->name('products.search.advanced');
Route::post('/products/filter-price', [ProductController::class, 'filterPrice'])
    ->name('products.filter.price');
Route::get("/product/home", [ProductController::class, 'home'])
    ->name('products.home');
Route::get("/product/{product}", [ProductController::class, 'show']);

// Cart
Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');
Route::post("/cart", [CartController::class, 'store'])
    ->name('cart.store');
Route::post("/cart/{cart}", [CartController::class, 'update']);

// Checkout
Route::get("/checkout", [CheckoutController::class, 'index']);
Route::post('/checkout/sendmail', [CheckoutController::class, 'store']);

// Contact
Route::get("/contact-us", function () {
    return view('frontend.contacts.contact-us');
});

Route::post('/logout', [SessionController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Auth
// Auth::routes();
// Route::get('/', [HomeController::class, 'index'])->name('home');
