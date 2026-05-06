<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\LocalizationController;

Route::get('/language/{locale}', [LocalizationController::class, 'index'])->name('language.switch')->where('locale', 'en|ru|kk|zh');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [PageController::class, 'home']);
    Route::get('/catalog', [PageController::class, 'catalog']);
    Route::get('/cart', [PageController::class, 'cart']);
    Route::get('/analytics', [PageController::class, 'analytics'])->middleware('role:seller');
    Route::get('/payment', [PageController::class, 'payment']);
    Route::post('/payment', [PageController::class, 'processPayment']);
    Route::get('/profile', [PageController::class, 'profile']);
    Route::get('/upload', [UploadFileController::class, 'index']);
    Route::post('/upload', [UploadFileController::class, 'store']);
    Route::get('/mail', [MailController::class, 'index'])->name('mail.index');
    Route::post('/mail', [MailController::class, 'send'])->name('mail.send');
    Route::get('/products/create', [ProductController::class, 'create'])->middleware('role:seller|admin');
    Route::post('/products', [ProductController::class, 'store'])->middleware('role:seller|admin');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->middleware('role:seller|admin');
    Route::put('/products/{product}', [ProductController::class, 'update'])->middleware('role:seller|admin');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->middleware('role:seller|manager|admin');
    Route::post('/cart/add', [PageController::class, 'addToCart']);
    Route::get('/users', [PageController::class, 'users'])->middleware('role:manager|admin');
    Route::post('/users/{user}/role', [PageController::class, 'updateRole'])->middleware('role:manager|admin')->name('users.role');
});
