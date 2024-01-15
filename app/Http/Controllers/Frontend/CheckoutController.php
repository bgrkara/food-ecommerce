<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index() : View
    {
        $userAddresses = Address::where('user_id', auth()->user()->id)->get();
        return view('frontend.pages.checkout', compact('userAddresses'));
    }
}
