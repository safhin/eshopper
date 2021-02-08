<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('frontend.cart');
    }

    public function store(Request  $request)
    {
        $duplicates = Cart::search(function($cartItem, $rowId) use($request){
            return $cartItem->id === $request->id;
        });
        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message', 'Item already in your cart!');
        }
        Cart::add($request->id, $request->title, 1, $request->price)->associate('App\Models\Product');
        return redirect()->route('cart.index')->with('success_message', 'Your item added success fully');
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(),[
            'quantity' => 'required|numeric|between:1,5'
        ]);

        if($validate->fails()){
            session()->flash('errors', collect(['Quantity must be between 1 and 5']));
            return response()->json(['success' => false], 400);
        }
        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Quantity was successfully updated!');
        return response()->json(['success' => true]);
    }


    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('success_message', 'Item has been removed!');
    }
}
