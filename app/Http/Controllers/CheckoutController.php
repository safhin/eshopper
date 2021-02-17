<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {

        if(Cart::instance('default')->count() == 0)
        {
            return redirect()->route('shop.index');
        }

        if(auth()->user() && request()->is('guestCheckout')){
            return redirect()->route('shop.index');
        }
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
            $this->addToOrdersTable($request, null);
            //successful
            Cart::instance('default')->destroy();
            session()->forget('cupon');
            return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accept');
        } catch(CardErrorException $e){
            $this->addToOrdersTable($request, $e->getMessage());
            return back()->withErrors('Error!'.$e->getMessage()); 
        }
    }

    protected function addToOrdersTable(Request $request, $error)
    {
        //Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_phone' => $request->phone,
            'billing_postalcode' => $request->postalcode,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => $this->getAmounts()->get('discount'),
            'billing_subtotal' => $this->getAmounts()->get('newSubtotal'),
            'billing_discount_code' => $this->getAmounts()->get('code'),
            'billing_tax' => $this->getAmounts()->get('tax'),
            'billing_total' => $this->getAmounts()->get('newTotal'),
            'error' => $error,
        ]);

        //Insert into pivot table
        foreach(Cart::content() as $item){
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }
    }

    private function getAmounts()
    {
        $tax = config('cart.tax') / 100;
        $discount = session()->get('cupon')['discount'] ?? 0;
        $code = session()->get('cupon')['name'] ?? null;
        $newSubtotal = (Cart::subtotal() - $discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax);
        return collect([
            'tax' => $tax,
            'discount' => $discount,
            'code' => $code,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
        ]);
    }
}
