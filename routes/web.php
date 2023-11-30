<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\ProfileController as FrontendProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Frontend\DashboardController;
use Illuminate\Support\Facades\Route;

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

/* Auth Route*/
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'guest'], function (){
    Route::get('login', [AdminAuthController::class , 'index'])->name('login');
});

Route::group(['middleware' => 'auth'], function (){
   Route::get('dashboard',[DashboardController::class, 'index'])->name('dahboard');
   Route::put('profile', [FrontendProfileController::class, 'updateProfile'])->name('profile.update');
   Route::put('profile/password', [FrontendProfileController::class, 'updatePassword'])->name('profile.password.update');
   Route::post('profile/avatar', [FrontendProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
});

Route::get('/', [FrontendController::class, 'index'])->name('home');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
