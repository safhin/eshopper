<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()->take(8)->get();
        $recommendedItems = Product::inRandomOrder()->take(3)->get();
        return view('frontend.home',[
            'products' => $products,
            'recommendedItems' => $recommendedItems 
        ]);
    }
}
