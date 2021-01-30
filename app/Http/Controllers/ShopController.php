<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()->take(9)->get();
        return view('frontend.shop',[
            'products' => $products,
        ]);
    }
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('frontend.product',['product' => $product]);
    }
}
