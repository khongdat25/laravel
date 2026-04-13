<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\users\HomeController;
use App\Http\Controllers\users\CartController;
use App\Http\Controllers\users\CheckoutController;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Trang chủ (user)
Route::get('/', [HomeController::class, 'index']);

// Route dành cho user đã đăng nhập
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/order-success/{id}', [CheckoutController::class, 'success'])->name('order.success');
});

// Route dành cho admin (phải đăng nhập + phải là admin)
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard/index', fn() => view('admin.dashboard.index'))->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});

Route::get('/san-pham', function () {
    $brands = Brand::all();
    return view('user.category', compact('brands'));
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class,'destroy'])->name('cart.destroy');
Route::patch('/cart/update/{id}  ', [CartController::class,'update'])->name('cart.update');
Route::get('/san-pham/{id}', [HomeController::class, 'detail']);
Route::get('/search' , [HomeController::class,'search'])->name('search');
require __DIR__.'/auth.php';
