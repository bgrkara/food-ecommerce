<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CartController extends Controller
{

    public function index() : View
    {
        return view('frontend.pages.cart-view');
    }

    /**
     * Add Product in Cart
     **/
    public function addToCart(Request $request)
    {
        $product = Product::with(['productSizes', 'productOptions'])->findOrFail($request->product_id);
        if ($product->quantity < $request->quantity){
            throw ValidationException::withMessages(['Ürün Miktarı Stokta Mevcut Değil']);
        }
        try {
            $productSize = $product->productSizes->where('id', $request->product_size)->first();
            $productOptions = $product->productOptions->whereIn('id', $request->product_option);

            $options = [
                'product_size' => [],
                'product_options' => [],
                'product_info' => [
                    'image' => $product->thumb_image,
                    'slug' => $product->slug
                ]
            ];

            if ($productSize !== null){
                $options['product_size'] = [
                    'id' => $productSize?->id,
                    'name' => $productSize?->name,
                    'price' => $productSize?->price
                ];
            }

            foreach ($productOptions as $option){
                $options['product_options'][] = [
                    'id' => $option->id,
                    'name' => $option->name,
                    'price' => $option->price
                ];
            }

            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $request->quantity,
                'price' => $product->offer_price > 0 ? $product->offer_price : $product->price,
                'weight' => 0,
                'options' => $options]);

            return response(['status' => 'success', 'message' => 'Ürününüz Sepete Eklendi'], 200);

        }catch (\Exception $e){
            return  response(['status' => 'error' , 'message' => $e->getMessage()], 500);
        }


    }

    public function getCartProduct()
    {
        return view('frontend.layouts.ajax-files.sidebar-cart-item')->render();
    }

    public function cartProductRemove($rowId)
    {
        try {
            Cart::remove($rowId);
            return response([
                'status' => 'success',
                'message' => 'Ürün Sepetten Kaldırıldı',
                'cart_total' => cartTotal(),
                'grand_cart_total' => grandCartTotal()],
                200);
        }catch (\Exception $e){
            return response(['status' => 'error', 'message' => 'Ürün Sepetten Kaldırılırken Sorun Oluştu'], 500);
        }
    }

    public function cartQtyUpdate(Request $request) : Response
    {
        $cartItem = Cart::get($request->rowId);
        $product = Product::findOrFail($cartItem->id);

        if ($product->quantity < $request->qty){
            return response(['status' => 'error', 'message' => 'Ürün Miktarı Stokta Mevcut Değil', 'qty' => $cartItem->qty]);
        }
        try {
            $cart = Cart::update($request->rowId, $request->qty);
            return response([
                'product_total' => productTotal($request->rowId),
                'qty' => $cart->qty,
                'status' => 'success',
                'cart_total' => cartTotal(),
                'grand_cart_total' => grandCartTotal()],
                200);
        }catch (\Exception $e){
            logger($e);
            return response(['status' => 'error', 'message' => 'Birşeyler Ters Gitti Lütfen Sayfayı Yenileyiniz!'], 500);
        }
    }

    public function cartDestroy()
    {
        try {
            Cart::destroy();
            session()->forget('coupon');
            return redirect()->back();
        }catch (\Exception $e){
            return response(['status' => 'error', 'message' => 'Birşeyler Ters Gitti Lütfen Sayfayı Yenileyiniz!'], 500);
        }
    }


}
