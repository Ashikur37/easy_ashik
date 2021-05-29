@extends('layouts.front')
@section('title', "$lng->Checkout")
@section('pageStyle')
    <link rel="stylesheet" href="{{ asset('front') }}/css/vendor/select2.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/css/page/checkout.css">
@endsection
@section('content')
    <section class="checkout-section">
        <div class="container white-bg">
            <div class="row">
                <div class="col-md-10 offset-md-1 white-bg">
                    <h2>{{ $lng->Checkout }} </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 checkout-form white-bg p-20 pb-25 ">
                    <form action="{{ route('checkout.submit') }}" method="post" onsubmit="return validateCheckout()"
                            class="require-validation" data-cc-on-file="false"
                            data-stripe-publishable-key="{{ $paymentSetting->stripe_key }}" id="payment-form">
                            @csrf
                        <div class="row">
                            <div class="col-12">
                                <h4>{{ $lng->PersonalInfo }}</h4>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fname">{{ $lng->Name }} <span>*</span></label>
                                    <input value="{{ auth()->check() ? auth()->user()->name : '' }}" id="fname"
                                        name="customer_first_name" type="text" class="require-field form-control">
                                    <div class="has-error-text">{{ $lng->TheNameIsRequired }}</div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">{{ $lng->Phone }}*</label>
                                    <input id="phone" name="customer_phone" type="text" class="require-field form-control">
                                    <div class="has-error-text">{{ $lng->RequiredValidPhone }}</div>
                                </div>
                            </div>
                            <div class="col-12 mt-20">
                                <h4>{{ $lng->BillingAddress }}</h4>
                            </div>
                            <div class="col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="address">{{ $lng->AddressLine1 }} <span>*</span></label>
                                    <input name="billing_address_1" id="address" type="text" class="form-control require-field">
                                    <div class="has-error-text">{{ $lng->TheAddressLine1IsRequired }}</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="shipping-order-note">{{ $lng->OrderNote }}</label>
                                    <textarea name="note" id="shipping-order-note" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-15">
                            <div class="col-md-5 col-sm-6 col-12 md-pr-10">
                                <div class="shipping-method-section">
                                    <h4 class="mb-25">{{ $lng->ShippingMethod }} </h4>
                                    <div class="has-error-text" id="ship-error">{{ $lng->TheShippingMethodIsRequired }}</div>
                                    <div class="shipping-method-wrapper">
                                        @foreach ($shippingMethods as $shippingMethod)
                                            <div class="shipping-method-item">
                                                <label>
                                                    <input value="{{ $shippingMethod->id }}" name="shipping_method"
                                                        class="shipping-method" type="radio" data-val="{{ $shippingMethod->id }}">
                                                    {{ $shippingMethod->name }}
                                                </label>
                                                <span class="ml-auto">
                                                    {{ App\Model\Product::currencyPriceRate($shippingMethod->payablePrice()) }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-6 col-12 mt-20 mt-sm-0 md-pl-10">
                                <div class="payment-method-section">
                                    <h4 class="mb-25">{{ $lng->PaymentMethods }} </h4>
                                    <div class="has-error-text" id="pay-error">{{ $lng->ThePaymentMethodIsRequired }}</div>
                                    <div class="payment-method-wrapper">
                                       <div class="row">                                    
                                            @if (auth()->check() && $setting->affiliate_shopping)
                                                @if (auth()->user()->affiliate_balance >= Cart::total())
                                                    <div class="col-xl-4 col-md-6 pr-0 pl-10 sm-pl-0 pl-10">
                                                        <label>
                                                            <input class="payment_method" type="radio" name="payment_method"
                                                                value="Affiliate">
                                                            Affiliate Balance
                                                            ({{ App\Model\Product::currencyPriceRate(auth()->user()->affiliate_balance) }})
                                                        </label>
                                                    </div>
                                                @endif
                                            @endif
                                            @if ($paymentSetting->is_ssl)
                                                <div class="col-xl-4 col-md-6 pr-0 pl-10 sm-pl-0 pl-10">
                                                    <label>
                                                        <input checked class="payment_method" type="radio" name="payment_method"
                                                            value="SSL Commerz">
                                                        {{$lng->OnlinePay}}
                                                    </label>
                                                </div>
                                            @endif
                                            @if ($paymentSetting->is_paypal)
                                                <div class="col-xl-4 col-md-6 pr-0 pl-10 sm-pl-0 pl-10">
                                                    <label>
                                                        <input class="payment_method" type="radio" name="payment_method" value="Paypal">
                                                        {{ $lng->Paypal }}
                                                    </label>
                                                </div>
                                            @endif
                                                    
                                            @if ($paymentSetting->is_stripe)
                                                <div class="col-xl-4 col-md-6 pr-0 pl-10 sm-pl-0 pl-10">
                                                    <label>
                                                        <input class="payment_method" type="radio" name="payment_method" value="Stripe">
                                                        {{ $lng->Stripe }}
                                                    </label>
                                                </div>
                                            @endif
                                            @if ($paymentSetting->is_razor_pay)
                                                <div class="col-xl-4 col-md-6 pr-0 pl-10 sm-pl-0 pl-10">
                                                    <label>
                                                        <input class="payment_method" type="radio" name="payment_method"
                                                            value="Razorpay">
                                                        {{ $lng->Razorpay }}
                                                    </label>
                                                </div>
                                            @endif
                                            @if ($paymentSetting->is_cod)
                                                <div class="col-xl-4 col-md-6 pr-0 pl-10 sm-pl-0 pl-10">
                                                    <label>
                                                        <input class="payment_method" type="radio" name="payment_method"
                                                            value="Cash On Delivery">
                                                        {{ $lng->CashOnDelivery }}
                                                    </label>
                                                </div>
                                            @endif
                                        
                                            @foreach ($paymentGateways as $paymentGateway)
                                                <div class="col-xl-4 col-md-6 pr-0 pl-10 sm-pl-0 pl-10">
                                                    <label>
                                                        <input class="payment_method custom-payment" type="radio" name="payment_method"
                                                            data-val="{{ $paymentGateway->id }}" value="{{ $paymentGateway->title }}">
                                                        {{ $paymentGateway->title }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-15" id="payment-additional"></div>
                        <div class="row mt-15">
                            <div id="stripe-field" class="d-none col-12">
                                <div class="row">
                                    <div class='col-sm-6 col-12 form-group required'>
                                        <label class='control-label'>{{ $lng->NameOnCard }}</label>
                                        <input class='form-control' size='4' type='text'>
                                    </div>
                                    <div class='col-sm-6 col-12 form-group required'>
                                        <label class='control-label'>{{ $lng->CardNumber }}</label>
                                        <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-12 col-sm-4 form-group cvc required'>
                                        <label class='control-label'>{{ $lng->CVC }}</label>
                                        <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4'
                                            type='text'>
                                    </div>
                                    <div class='col-12 col-sm-4 form-group expiration required'>
                                        <label class='control-label'>{{ $lng->ExpirationMonth }}</label>
                                        <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                    </div>
                                    <div class='col-12 col-sm-4 form-group expiration required'>
                                        <label class='control-label'>{{ $lng->ExpirationYear }}</label>
                                        <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-12 error form-group d-none'>
                                        <div class='alert-danger alert'>Please correct the errors and try
                                            again.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-20">
                            <div id="checkout-cart" class="checkout-process col-12">
                                <div class="row">
                                    <div class="col-lg-3 col-4 lg-coupon-section pl-10">
                                        <h4>{{ $lng->HaveCoupon }}?</h4>
                                        @if (Session::has('coupon'))
                                            <div class="applied-coupon">
                                                <span class="coupon-content">
                                                    <span class="coupon-name">"{{ Session::get('coupon') }}"</span>
                                                    {{ $lng->Applied }}<span class="coupon-closer"><i
                                                            class="ri-close-line"></i></span>
                                                </span>
                                            </div>
                                        @else
                                            <div class="input-group">
                                                <input id="coupon-input" type="text" class="form-control"
                                                    placeholder="Enter Coupon">
                                                <div class="input-group-append">
                                                    <button id="coupon-apply-btn" class="sm-btn default-btn"
                                                        type="button">{{ $lng->Apply }}</button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-5 col-12 ">
                                        <div class="checkout-process-content">
                                            <div class="flex-item">
                                                <p>{{ $lng->Discount }}</p>
                                                <span>{{ App\Model\Product::currencyPriceRate(Cart::discount()) }}</span>
                                            </div>
                                            <div class="flex-item">
                                                <p>{{ $lng->Tax }}</p>
                                                <span>{{ App\Model\Product::currencyPriceRate(Cart::tax()) }}</span>
                                            </div>
                                            <div class="flex-item">
                                                <p class="mb-md-0">{{ $lng->SubTotal }}</p>
                                                <span>{{ App\Model\Product::currencyPriceRate(Cart::subtotal()) }}</span>
                                            </div>
                                            <div class="sm-grand-total">
                                                <div class="grand-total">
                                                    <p class="mb-0">{{ $lng->GrandTotal }}</p>
                                                    <span
                                                        class="total-price">{{ App\Model\Product::currencyPriceRate(Cart::total()) }}</span>
                                                </div>
                                                <div>
                                                    @if (Session::has('coupon'))
                                                        <div class="applied-coupon sm-applied-coupon">
                                                            <span class="coupon-content">
                                                                <span class="coupon-name">{{ Session::get('coupon') }}"</span>
                                                                {{ $lng->Applied }}<span class="coupon-closer"><i
                                                                        class="ri-close-line"></i></span>
                                                            </span>
                                                        </div>
                                                    @else
                                                        <button class="btn-coupon apply-coupon-trigger"
                                                            type="button">{{ $lng->ApplyCoupon }}</button>
                                                        <div class="sm-coupon-input">
                                                            <div class="input-group">
                                                                <input id="sm-coupon-input" type="text" class="form-control"
                                                                    placeholder="Enter Coupon">
                                                                <div class="input-group-append">
                                                                    <button id="sm-coupon-apply-btn" class="sm-btn default-btn"
                                                                        type="button">{{ $lng->Apply }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <button class="btn-checkout default-btn">{{ $lng->Order }}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 lg-grand-total pr-10">
                                        <div class="grand-total">
                                            <p class="mb-4">{{ $lng->GrandTotal }}</p>
                                            <span
                                                class="total-price">{{ App\Model\Product::currencyPriceRate(Cart::total()) }}</span>
                                        </div>
                                        <button class="default-btn btn-checkout">{{ $lng->Order }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>       
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('pageScripts')
    <script src="{{ asset('assets/admin/js/vendor/select2.full.min.js') }}"></script>
    <script src="{{ asset('front/js/page/checkout.js') }}"></script>
    <script src="{{ asset('front/js/vendor/stripe.min.js') }}"></script>
@endsection