@extends('frontend.layouts.app')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                @if (session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('success_message') }}    
                    </div>    
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (Cart::count() > 0)
                    <h2>{{ Cart::count() }} item(s) in shopping Cart</h2>
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Item</td>
                                <td class="description"></td>
                                <td class="price">Price</td>
                                <td class="quantity">Quantity</td>
                                <td class="total">Total</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $item)
                                <tr>
                                    <td class="cart_product">
                                        <a href="{{ route('shop.show',[$item->model->slug]) }}"><img src="{{ asset('frontend/images/shop/'.$item->model->slug.'.jpg') }}" alt=""></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href="{{ route('shop.show',[$item->model->slug]) }}">{{ $item->model->title }}</a></h4>
                                        <p>Web ID: 1089772</p>
                                    </td>
                                    <td class="cart_price">
                                        <p>TK-{{ $item->model->price }}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <select class="quantity" data-id="{{ $item->rowId }}">
                                                @for($i = 1; $i < 5 + 1;$i++)
                                                    <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>  
                                                @endfor
                                            </select>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">TK-{{ $item->subtotal() }}</p>
                                    </td>
                                    <td class="cart_delete">
                                        <form action="{{ route('cart.destroy',$item->rowId ) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="cart_quantity_delete" type="submit"><i class="fa fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>No item(s) in shopping Cart</h4>
                    <button type="button" class="btn btn-outline-success btn-lg"><a href="{{ route('shop.index') }}">Continue Shopping</a></button>
                @endif
            </div>
        </div>
    </section>

    <section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>TK-{{ Cart::subtotal() }}</span></li>
							<li>Eco Tax <span>TK-{{ Cart::tax() }}</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>TK-{{ Cart::total() }}</span></li>
						</ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a href="{{ route('checkout.index') }}" class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
            </div>
		</div>
	</section>
@endsection

@section('extra-js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity')

            Array.from(classname).forEach(function(element){
                element.addEventListener('change', function(){
                    const id = element.getAttribute('data-id')
                    axios.patch(`/cart/${id}`, {
                        quantity: this.value,
                    })
                    .then(function (response) {
                        window.location.href = '{{ route('cart.index') }}'
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                })
            })
        })();
    </script>
@endsection