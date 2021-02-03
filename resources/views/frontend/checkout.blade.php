@extends('frontend.layouts.app')

@section('extra-css')
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
@endsection

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->

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

            <div class="register-req">
                <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
            </div><!--/register-req-->

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="bill-to">
                            <form action="{{ route('checkout.store') }}" method="POST" id="payment-form" required>
                                @csrf
                                <div class="form-group">
                                    <input class="form-control form-control-lg" type="text" name="email" placeholder="Email*" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Name *" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">                                        
                                    <input class="form-control" name="address" type="text" id="address" placeholder="Address" value="{{ old('address') }}">
                                </div>
                                <div class="form-group">  
                                    <input class="form-control" name="postalcode" type="text" id="postalcode" placeholder="Zip / Postal Code *" value="{{ old('postalcode') }}">
                                </div>
                                <div class="form-group">  
                                    <input class="form-control" name="province" type="text" id="province" placeholder="Province" value="{{ old('province') }}">
                                </div>
                                <div class="form-group">  
                                    <input class="form-control" name="city" type="text" id="city" placeholder="City" value="{{ old('city') }}">
                                </div>
                                <div class="form-group">  
                                    <input class="form-control" type="phone" placeholder="Mobile Phone" value="{{ old('phone') }}">
                                </div>
                                <div class="form-group">
                                    <label for="name_on_card">Name on Card</label>
                                    <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">
                                </div>
                                <div class="form-group">
                                    <label for="card-element">
                                        Credit or debit card
                                      </label>
                                      <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                      </div>
                                      <!-- Used to display Element errors. -->
                                      <div id="card-errors" role="alert"></div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="complete-order" class="btn btn-primary btn-lg btn-block">Complete Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <!----- Cart Items ---->
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
                                    @foreach (Cart::content() as $item)
                                        <tr>
                                            <td class="cart_product">
                                                <a href="{{ route('shop.show',[$item->model->slug]) }}"><img src="{{ asset('frontend/images/shop/'.$item->model->slug.'.jpg') }}" alt=""></a>
                                            </td>
                                            <td class="cart_description">
                                                <h5><a href="{{ route('shop.show',[$item->model->slug]) }}">{{ $item->model->title }}</a></h5>
                                            </td>
                                            <td class="cart_price">
                                                <p>TK-{{ $item->model->price }}</p>
                                            </td>
                                            <td class="cart_quantity">
                                                <div class="cart_quantity_button">
                                                    <a class="cart_quantity_up" href=""> + </a>
                                                    <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                                                    <a class="cart_quantity_down" href=""> - </a>
                                                </div>
                                            </td>
                                            <td class="cart_total">
                                                <p class="cart_total_price">TK-{{ $item->model->price}}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>					
                </div>
            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection

@section('extra-js')
    <script>
        (function() {
        var stripe = Stripe('pk_test_51IG1XaLOQKQFJA7ZTUILvcwA7g4zxu2XsXKAvdCRDfyxJUzST0EWOlmTvxvR7NuzLYGYKLXDoZL19BfDeGTbUjLy00HQbUyur9');
        // Create an instance of Elements
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
            },
            invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true
        });

        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
            displayError.textContent = event.error.message;
            } else {
            displayError.textContent = '';
            }
        });

        // Create a token or display an error when the form is submitted.
        var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
            event.preventDefault();

            //Diable the submit button to prevent repeated click
            document.getElementById('complete-order').disabled = true;

            var options = {
                name: document.getElementById('name_on_card').value,
                address_line1: document.getElementById('address').value,
                address_city: document.getElementById('city').value,
                address_state: document.getElementById('province').value,
                address_zip: document.getElementById('postalcode').value
              }

            stripe.createToken(card,options).then(function(result) {
                if (result.error) {
                // Inform the customer that there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                document.getElementById('complete-order').disabled = true;
                } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
        })();
</script>
@endsection