@extends('frontend.layouts.root')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset("frontend/css/custom.css") }}">    
@endsection

@section('content')
<section id="advertisement">
    <div class="container">
        <img src="{{ asset('frontend/images/shop/advertisement.jpg') }}" alt="" />
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        @foreach ($categories as $cat)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title {{ setActiveCategory($cat->slug) }}"><a href="{{ route('shop.index',['category' => $cat->slug ]) }}">{{ $cat->name }}</a></h4>
                                </div>
                            </div>
                        @endforeach
                    </div><!--/category-productsr-->
                    
                    <div class="shipping text-center"><!--shipping-->
                        <img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
                    </div><!--/shipping-->
                    
                </div>
            </div>
            
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <div class="product_header">
                        <h2 class="title">{{ $categoryName }}</h2>
                        <div>
                            <a href="{{ route('shop.index',['category' => request()->category, 'sort' => 'low_high' ]) }}">Low To High | </a>
                            <a href="{{ route('shop.index',['category' => request()->category, 'sort' => 'high_low' ]) }}">High To Low</a>
                        </div>
                    </div>
                    @forelse ($products as $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{  productImage($product->image) }}" alt="" />
                                        <h2>TK-{{ $product->price }}</h2>
                                        <p>{{ $product->title }}</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>$56</h2>
                                            <p><a href="{{ route('shop.show',['slug' => $product->slug ]) }}">{{ $product->title }}</a></p>
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="title" value="{{ $product->title }}">
                                                <input type="hidden" name="price" value="{{ $product->price }}">
                                                <button type="submit" class="btn btn-fefault cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    Add to cart
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h3>No items here</h3>
                    @endforelse
                </div><!--features_items-->
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</section>
@endsection