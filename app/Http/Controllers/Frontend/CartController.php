<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Add Product in Cart
     **/
    public function addToCart(Request $request)
    {
        try {
            $product = Product::with(['productSizes', 'productOptions'])->findOrFail($request->product_id);
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
            return response(['status' => 'success', 'message' => 'Ürün Sepetten Kaldırıldı'], 200);
        }catch (\Exception $e){
            return response(['status' => 'error', 'message' => 'Ürün Sepetten Kaldırılırken Sorun Oluştu'], 500);
        }
    }


}
