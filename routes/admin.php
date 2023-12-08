<?php

use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/


/*
|--------------------------------------------------------------------------
| Middleware İşlemi
|--------------------------------------------------------------------------
|
| RouteServiceProvider içerisine ('auth', 'role:admin') middleware eklendi o yüzden route içerisinde kullanmaya gerek yoktur
| Burada Tüm admin işlemleri auth ve admin ara katmanından geçmek zorunda olduğu için providers içerisinde kullanılabilir.
|
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function (){

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // admin/dashboard                                                      // admin.dashboard

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    //Slider Routes
    Route::resource('slider', SliderController::class);

    // Product Category Routes
    Route::resource('category', CategoryController::class);

    // Product Routes
    Route::resource('product', ProductController::class);

    // Product Gallery Routes
    Route::get('product-gallery/{product}', [ProductGalleryController::class, 'index'])->name('product-gallery.show-index');
    Route::resource('product-gallery', ProductGalleryController::class);

});
