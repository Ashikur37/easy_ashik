@extends('layouts.front')
@section('title', "$lng->Cart")
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/page/cart.css">
@endsection
@section('content')
    <section class="cart-section">
        <div class="container white-bg">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <h2>{{ $lng->ShoppingCart }}</h2>
                </div>
            </div>
            <div id="dynamic-cart">
                @include('load.front.cart')
            </div>
        </div>
    </section>
@endsection
@section('pageScripts')
    <script src="{{ asset('front/js/page/cart.js') }}"></script>
@endsection
