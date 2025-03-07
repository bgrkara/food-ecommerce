<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProfileController as FrontendProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\ChatController;
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
   Route::post('address', [DashboardController::class, 'createAddress'])->name('address.store');
   Route::put('address/{id}/edit', [DashboardController::class, 'updateAddress'])->name('address.update');
   Route::delete('address/{id}', [DashboardController::class, 'destroyAddress'])->name('address.destroy');

   // Chat Routes
    Route::post('chat/send-message', [ChatController::class, 'sendMessage'])->name('chat.send-message');
});

// Show HomePage Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');

// Product Detail Page Routes
Route::get('/product/{slug}', [FrontendController::class, 'showProduct'])->name('product.show');

// Product Modal Route
Route::get('/load-product-modal/{productId}', [FrontendController::class, 'loadProductModal'])->name('load-product-modal');

// Add To Cart Route
Route::post('add-to-cart', [CartController::class ,'addToCart'])->name('add-to-cart');
Route::get('get-cart-products', [CartController::class ,'getCartProduct'])->name('get-cart-products');
Route::get('cart-product-remove/{rowId}', [CartController::class ,'cartProductRemove'])->name('cart-product-remove');

// Cart Page Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart-update-qty', [CartController::class, 'cartQtyUpdate'])->name('cart.quantity-update');
Route::get('/cart-destroy', [CartController::class, 'cartDestroy'])->name('cart.destroy');

// Coupon Routes
Route::post('/apply-coupon', [FrontendController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('/destroy-coupon', [FrontendController::class, 'destroyCoupon'])->name('destroy-coupon');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Checkout Routes
Route::middleware('auth')->group([function () {
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('checkout/{id}/delivery-cal', [CheckoutController::class, 'CalculateDeliveryCharge'])->name('checkout.delivery-cal');
    Route::get('checkout-payment', [CheckoutController::class, 'checkoutRedirect'])->name('checkout.redirect');

    /** Payment Routes **/
    Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('make-payment', [PaymentController::class, 'makePayment'])->name('make-payment');

    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('payment-cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');


    /** Paypal Routes **/
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

    /** Stripe Routes **/
    Route::get('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
    Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');

    /** Iyzıco Routes **/
    Route::get('iyzico/payment', [PaymentController::class, 'payWithIyzico'])->name('iyzico.payment');
    Route::get('iyzico/success', [PaymentController::class, 'iyzicoSuccess'])->name('iyzico.success');
    Route::get('iyzico/cancel', [PaymentController::class, 'iyzicoCancel'])->name('iyzico.cancel');

}]);

require __DIR__.'/auth.php';
