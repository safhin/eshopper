<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    public function store(Request $request)
    {
        $cupon = Cupon::where('code', $request->cupon_code)->first();
        if(!$cupon){
            return redirect()->route('checkout.index')->withErrors('Invalid cupond code. Please try again');
        }
        session()->put('cupon', [
            'name' => $cupon->code,
            'discount' => $cupon->discount(Cart::subtotal()),
        ]);

        return redirect()->route('checkout.index')->with('success_message','Cupon has been applied!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('cupon');
        return redirect()->route('checkout.index')->with('success_message','Cupon has been removed!');
    }
}
