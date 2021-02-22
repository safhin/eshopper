@extends('frontend.layouts.root')

@section('content')
    <section id="form">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <ul class="profile_menu">
                        <li><a href="{{ route('profile.edit') }}">My Profile</a></li>
                        <li><a href="{{ route('orders.index') }}">My Orders</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-md-offset-1">
                    <div class="login-form"><!--login form-->
                        <h1>My profile</h1>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @method('patch')
                            @csrf
                            <input type="text" class="@error('name') is-invalid @enderror" placeholder="Name" name="name" id="name" value="{{ $user->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="email" class="@error('email') is-invalid @enderror" name="email" id="email" value="{{ $user->email }}" placeholder="Email Address">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="password" class="@error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="password" name="password_confirmation" id="password-confirmation" placeholder="Password">
                            <button type="submit" class="btn btn-default">Update</button>
                        </form>
                    </div><!--/login form-->
                </div>
            </div>
        </div>
    </section>
@endsection