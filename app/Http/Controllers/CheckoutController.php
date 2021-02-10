<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {

        return view('frontend.checkout')->with([
            'discount' => $this->getAmounts()->get('discount'),
            'newSubtotal' => $this->getAmounts()->get('newSubtotal'),
            'newTax' => $this->getAmounts()->get('newTax'),
            'newTotal' =>$this->getAmounts()->get('newTotal'),
        ]);
    }

    public function store(CheckoutRequest $request)
    {
        $contents = Cart::content()->map(function($item){
            return $item->model->slug.','.$item->qty;
        })->values()->toJson();
        try{
            $charge = Stripe::charges()->create([
                'amount' => $this->getAmounts()->get('newTotal'),
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);
            Cart::instance('default')->destroy();
            session()->forget('cupon');
            //successful
            return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accept');
        } catch(CardErrorException $e){
            return back()->withErrors('Error!'.$e->getMessage()); 
        }
    }

    private function getAmounts()
    {
        $tax = config('cart.tax') / 100;
        $discount = session()->get('cupon')['discount'] ?? 0;
        $newSubtotal = (Cart::subtotal() - $discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax);
        return collect([
            'tax' => $tax,
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
        ]);
    }
}
