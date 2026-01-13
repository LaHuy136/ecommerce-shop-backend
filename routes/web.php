<?php

use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Member\BlogController as MemberBlogController;
use App\Http\Controllers\Member\CartController;
use App\Http\Controllers\Member\CheckoutController;
use App\Http\Controllers\Member\CommentController;
use App\Http\Controllers\Member\ForgotPasswordController;
use App\Http\Controllers\Member\ProductController as MemberProductController;
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
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        //  Profile
        Route::get('/profile', [ProfileController::class, 'index'])
            ->name('admin.profiles');
        Route::patch('/profile/{id}', [ProfileController::class, 'update']);

        // Country
        Route::prefix('country')->group(function () {
            Route::get('/', [CountryController::class, 'index'])
                ->name('admin.countries');
            Route::get('/create', [CountryController::class, 'create']);
            Route::post('/', [CountryController::class, 'store']);
            Route::get('/{country}/edit', [CountryController::class, 'edit']);
            Route::patch('/{country}', [CountryController::class, 'update']);
            Route::delete('/{country}', [CountryController::class, 'destroy']);
        });

        // Blog
        Route::prefix('blog')->group(function () {
            Route::get('/', [AdminBlogController::class, 'index'])
                ->name('admin.blogs');
            Route::get('/create', [AdminBlogController::class, 'create']);
            Route::post('/', [AdminBlogController::class, 'store']);
            Route::get('/{blog}/edit', [AdminBlogController::class, 'edit']);
            Route::patch('/{blog}', [AdminBlogController::class, 'update']);
            Route::delete('/{blog}', [AdminBlogController::class, 'destroy']);
        });

        // User
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])
                ->name('admin.users');
            Route::get('/create', [UserController::class, 'create']);
            Route::get('/{user}', [UserController::class, 'show']);
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{user}/edit', [UserController::class, 'edit']);
            Route::patch('/{user}', [UserController::class, 'update']);
            Route::delete('/{user}', [UserController::class, 'destroy']);
        });

        // Product
        Route::prefix('product')->group(function () {
            Route::get('/', [AdminProductController::class, 'index'])
                ->name('admin.products');
            Route::get('/search', [SearchController::class, 'searchByMemberName']);
            Route::get('/create', [AdminProductController::class, 'create']);
            Route::get('/{product}', [AdminProductController::class, 'show']);
            Route::post('/', [AdminProductController::class, 'store']);
            Route::get('/{product}/edit', [AdminProductController::class, 'edit']);
            Route::patch('/{product}', [AdminProductController::class, 'update']);
            Route::delete('/{product}', [AdminProductController::class, 'destroy']);
        });
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
        Route::get("/product", [MemberProductController::class, 'index'])
            ->name('products.index');
        Route::get("/product/create", [MemberProductController::class, 'create']);
        Route::post("/product", [MemberProductController::class, 'store']);

        Route::get("/product/{product}/edit", [MemberProductController::class, 'edit']);
        Route::patch("/product/{product}", [MemberProductController::class, 'update']);
        Route::delete("/product/{product}", [MemberProductController::class, 'destroy']);

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
Route::get("/blog", [MemberBlogController::class, 'index'])
    ->name('blog.index');
Route::get('/blog/{blog}/comments', [CommentController::class, 'index']);
Route::get("/blog/{blog:slug}", [MemberBlogController::class, 'show'])
    ->name('blogs.show');

// Product
Route::get('/product/search', [SearchController::class, 'searchByProductName'])
    ->name('products.search');
Route::post('/product/search', [SearchController::class, 'search'])
    ->name('products.search.advanced');
Route::post('/products/filter-price', [MemberProductController::class, 'filterPrice'])
    ->name('products.filter.price');
Route::get("/product/home", [MemberProductController::class, 'home'])
    ->name('products.home');
Route::get("/product/{product}", [MemberProductController::class, 'show']);

// Cart
Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');
Route::post("/cart", [CartController::class, 'store'])
    ->name('cart.store');
Route::post("/cart/{cart}", [CartController::class, 'update']);

// Checkout
Route::get("/checkout", [CheckoutController::class, 'index'])
    ->name('checkout.index');
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
