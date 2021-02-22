@extends('frontend.layouts.root')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Search</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description">Title</td>

                        <td class="total">Description</td>
                        <td class="total">Price</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="{{ asset('storage/'.$product->image) }}" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{ $product->title }}</a></h4>
                            </td>
                            <td>
                                <p>{{ $product->details }}</p>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{ $product->price }}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection