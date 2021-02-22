@extends('frontend.layouts.root')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description">Title</td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @foreach ($order->products as $product)
                                <tr>
                                    <td class="cart_product">
                                        <a href="{{ route('shop.show',[$product->slug]) }}"><img src="{{  productImage($product->image) }}" alt=""></a>
                                    </td>
                                    <td class="cart_description">
                                        <h5><a href="{{ route('shop.show',[$product->slug]) }}">{{ $product->title }}</a></h5>
                                    </td>
                                    <td class="cart_price">
                                        <p>TK-{{ $product->price }}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">TK-{{ $product->price}}</p>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection