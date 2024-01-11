<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FrontendController extends Controller
{
    function index() : View
    {
        $sliders = Slider::where('status', 1)->get();
        $categories = Category::where(['show_at_home' => 1, 'status' => 1])->get();

        /* 8 Ürünle Sınırlı*/
        $products = Product::where(['show_at_home' => 1, 'status' => 1])
            ->orderBy('id' , 'DESC')
            ->take(8)
            ->get();
        return view('frontend.home.index',
            compact(
                'sliders',
                'categories',
                'products'
            ));
    }

    public function showProduct(string $slug) : View
    {
        $product = Product::with(['productImages', 'productSizes' ,'productOptions'])->where(['slug' => $slug, 'status' => 1])->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)->take(8)->latest()->get();
        return view('frontend.pages.product-view', compact('product', 'relatedProducts'));
    }

    public function loadProductModal($productId)
    {
        $product = Product::with('productSizes', 'productOptions')->findOrFail($productId);
        return view('frontend.layouts.ajax-files.product-popup-modal', compact('product'))->render();
    }

    public function applyCoupon(Request $request) {
        $subtotal = $request->subtotal;
        $code = $request->code;

        $coupon = Coupon::where('code', $code)->first();

        if(!$coupon){
            return response(['message' => 'Geçersiz Kupon Kodu!'],422);
        }
        if($coupon->quantity <= 0){
            return response(['message' => 'Kupon Tamamen Kullanıldı'],422);
        }
        if ($coupon->expire_date < now()){
            return response(['message' => 'Kupon Geçerlilik Süresi Bitti'],422);
        }
        if ($coupon->discount_type === 'percent'){
            $discount = number_format($subtotal * ($coupon->discount / 100), 2);
        }elseif ($coupon->discount_type === 'amount'){
            $discount = number_format($coupon->discount, 2);
        }
        $finalTotal = $subtotal - $discount;
        session()->put('coupon', ['code' => $code, 'discount' => $discount]);
        return response(['message' => 'Kupon Kodu Uygulandı','discount' => $discount, 'finalTotal' => $finalTotal, 'coupon_code' => $code]);
    }

    public function destroyCoupon()
    {
        try {
            session()->forget('coupon');
            return response(['message' => 'Kupon Kaldırıldı', 'grand_cart_total' => grandCartTotal()]);
        }catch (\Exception $e){
            logger($e);
            return response(['status' => 'error', 'message' => 'Kupon Kaldırılırken Hata Oluştu!']);
        }
    }


}
