<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $pagination = 9;
        $categories = Category::all();
        if(request()->category){
            $products = Product::with('categories')->whereHas('categories', function($query){
                $query->where('slug', request()->category);
            });
            $categoryName = optional($categories->where('slug', request()->category)->first())->name;
        }else{
            $products = Product::where('featured', true)->inRandomOrder();
            $categoryName = 'Featured Items';
        }

        if(request()->sort == 'low_high'){
            $products = $products->orderBy('price')->paginate($pagination);
        }elseif(request()->sort == 'high_low'){
            $products = $products->orderBy('price','desc')->paginate($pagination);
        }else{
            $products = $products->paginate(9);
        }
        return view('frontend.shop',[
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName
        ]);
    }
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('frontend.product',[
            'product' => $product
            ]
        );
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::search($query)->paginate(8);
        return view('frontend.search')->with('products', $products);
    }
}
