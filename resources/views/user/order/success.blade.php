@extends('layouts.front')
@section('title', "$lng->OrderPlaced")
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front/css/user.css')}}">
@endsection 
@section('content')
<div class="container white-bg mt-20 mb-20">
    <div class="row">
        <div class="col-xl-10 offset-xl-1">
            <div class="single__order__page my-4">
                <div class="main-content-wrapper order-details">
                    <h4 class="section-title">
                        <i class="ri-checkbox-circle-fill"></i>{{$lng->OrderPlaced}}
                        <a href="{{route('user.order.print',$order->order_number)}}" target="_blank">
                            <i class="ri-printer-fill"></i>
                        </a> 
                    </h4>
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="content-title">
                                    {{$lng->OrderInfo}}
                                </div>
                                <div class="info-row">
                                    <div class="info-label">{{$lng->OrderId}}</div>
                                    <div class="info-value">{{$order->order_number}}</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">{{$lng->Date}}</div>
                                    <div class="info-value">
                                        {{$order->created_at->format("d M Y, h:i a")}}
                                    </div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">{{$lng->Status}}</div>
                                    <span class="status-badge {{$order->statusClass()}}">{{$order->statusText()}}</span>
                                </div>
                                @if($order->coupon)
                                <div class="info-row">
                                    <div class="info-label">{{$lng->Coupon}}</div>
                                    <div class="info-value coupon-code">{{$order->coupon->code}}</div>
                                </div>
                                @endif
                                <div class="info-row">
                                    <div class="info-label">{{$lng->PaymentMethod}}</div>
                                    <div class="info-value">{{$order->payment_method}}
                                        @foreach($order->additionals as $additional)
                                        <div>
                                            {{$additional->paymentGatewayAdditional->title}} {{$additional->value}}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">{{$lng->PaymentStatus}}</div>
                                    <div class="info-value {{$order->paymentStatusClass()}}">{{$order->paymentStatusText()}}</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">{{$lng->ShippingMethod}}</div>
                                    <div class="info-value">{{$order->shipping_method}}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="content-title">
                                    {{$lng->Summary}}
                                </div>
                                <div class="info-row">
                                    <div class="info-label">{{$lng->Discount}}</div>
                                    <div class="info-value">৳{{App\Model\Product::currencyPriceRate($order->discount)}}</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">{{$lng->Tax}}</div>
                                    <div class="info-value">৳{{App\Model\Product::currencyPriceRate($order->tax)}}</div>
                                </div>
                                <div class="info-row">
                                <div class="info-label">Cashback</div>
                                <div class="info-value">৳{{App\Model\Product::currencyPriceRate($order->cashback)}}</div>
                            </div>
                                <div class="info-row">
                                    <div class="info-label">{{$lng->SubTotal}}</div>
                                    <div class="info-value">৳{{App\Model\Product::currencyPriceRate($order->total)}}</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">{{$lng->Shipping}}</div>
                                    <div class="info-value">৳{{App\Model\Product::currencyPriceRate($order->shipping_cost)}}</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">{{$lng->GrandTotal}}</div>
                                    <div class="info-value grand-total">৳{{App\Model\Product::currencyPriceRate($order->shipping_cost+$order->total)}}</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content-title">
                                    {{$lng->Address}}
                                </div>
                                <div class="address-info-row">
                                    <div class="info-label">{{$order->billing_first_name}}</div>
                                    <div class="info-label">{{$order->customer_phone}}</div>
                                    <div class="info-label">{{$order->billing_address_1}}</div>
                                </div>
                            </div>                          
                        </div>
                        @if($order->note)
                        <div class="row">
                            <div class="col-12">
                                <div class="content-title">
                                    {{$lng->OrderNote}}
                                </div>
                                <div class="info-row order-note">
                                    <div class="info-label">
                                        {{$order->note}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="product-info-table border p-10 mt-25">
                    <table class="table product-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">{{$lng->Product}}</th>
                                <th scope="col">{{$lng->Price}}</th>
                                <th scope="col">{{$lng->Quantity}}</th>
                                <th scope="col">{{$lng->Total}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>
                                    <div class="product-img-name">
                                        <img src="{{asset('images/product/')}}/{{$item->options->image}}" class="product-img" alt="product-image">
                                        <p class="mb-0">
                                            {{ Str::limit($item->name,50)}}
                                            <span class="product-attribute">
                                                {!!$item->options->size?"<span> $lng->Size : ".$item->options->size.'</span>':''!!}
                                                {!!$item->options->color?"<span> $lng->Color : ".$item->options->colorName.'</span>': ''!!}
                                                @foreach ($item->options->options as $key => $value)
                                                <span>{{$key}}: {{$value}}</span>
                                                @endforeach
                                            </span>                                   
                                        </p>
                                    </div>                          
                                </td>
                                <td><span>৳{{App\Model\Product::currencyPriceRate($item->price)}}</span></td>
                                <td><span>{{$item->qty}}</span></td>
                                <td><span>৳{{App\Model\Product::currencyPriceRate($item->subtotal)}}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="product-table-md">
                        @foreach($items as $item)
                        <div class="md-product-row">
                            <div class="product-img">
                                <img src="{{asset('images/product/')}}/{{$item->options->image}}"alt="product-image">
                            </div>
                            <div class="product-desc">
                                <div class="name-qnt">
                                    <p class="mb-0">
                                        {{ Str::limit($item->name,50)}}                                   
                                    </p>
                                    <span class="qnt">x {{$item->qty}}</span>
                                </div>
                                <div class="product-price">
                                    <span>৳{{App\Model\Product::currencyPriceRate($item->price)}}</span>
                                    <span>৳{{App\Model\Product::currencyPriceRate($item->subtotal)}}</span>
                                </div>
                                <div class="product-attributes">
                                    {!!$item->options->size?'<span> $lng->Size :'.$item->options->size.'</span>':''!!}
                                    {!!$item->options->size?'<span> $lng->Color :'.$item->options->color.'</span>':''!!}
                                    @foreach ($item->options->options as $key => $value)
                                    <span>{{$key}}:{{$value}}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection