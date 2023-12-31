<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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


}
