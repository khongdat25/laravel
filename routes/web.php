<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\users\HomeController;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route dành cho admin (phải đăng nhập + phải là admin)
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard/index', fn() => view('admin.dashboard.index'))->name('dashboard');
    Route::resource('categories', CategoryController::class);
});

Route::get('/san-pham', function () {
    $brands = Brand::all();
    return view('user.category', compact('brands'));
});

require __DIR__.'/auth.php';
