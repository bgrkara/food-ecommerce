<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index() : View
    {
        if (!session()->has('delivery_fee') || !session()->has('address')){
            throw ValidationException::withMessages('İşlemi Gerçekleştirirken Birşeyler Yanlış Gitti!');
        }
        $subtotal = CartTotal();
        $delivery = session()->get('delivery_fee') ?? 0;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $grandTotal = grandCartTotal($delivery);
        return view('frontend.pages.payment', compact('subtotal', 'delivery', 'discount', 'grandTotal'));
    }
}
