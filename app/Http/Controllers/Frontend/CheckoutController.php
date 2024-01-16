<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\DeliveryArea;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index() : View
    {
        $userAddresses = Address::where('user_id', auth()->user()->id)->get();
        $deliveryAreas = DeliveryArea::where('status', 1)->get();
        return view('frontend.pages.checkout', compact('userAddresses', 'deliveryAreas'));
    }

    public function CalculateDeliveryCharge(string $id)
    {
        try {
            $address = Address::findOrFail($id);
            $deliveryFee = $address->deliveryArea->delivery_fee;
            $grandTotal = grandCartTotal($deliveryFee);
            return response(['delivery_fee' => $deliveryFee, 'grand_total' => $grandTotal]);
        }catch (\Exception $e){
            logger($e);
            return response(['message' => 'Bir şeyler yanlış gitti!'], 422);
        }
    }

    public function checkoutRedirect(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer']
        ]);

        $address = Address::with('deliveryArea')->findOrFail($request->id);
        $selectedAddress = $address->address. ', Teslimat Alanı: ' . $address->deliveryArea?->area_name;
        session()->put('address', $selectedAddress);
        session()->put('delivery_fee', $address->deliveryArea->delivery_fee);
        return response(['redirect_url' => route('payment.index')]);
    }

}
