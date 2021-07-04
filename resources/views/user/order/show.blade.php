@extends('layouts.user')
@section('title', $lng->Order)
@section('content')
<div class="single__order__page">
    <div class="main-content-wrapper order-details">
        <h4 class="section-title">
            {{$lng->OrderDetails}}
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
                        <div class="info-value">{{App\Model\Product::currencyPriceRate($order->discount)}}</div>
                    </div>
                  
                     <div class="info-row">
                        <div class="info-label">Cashback</div>
                        <div class="info-value">{{App\Model\Product::currencyPriceRate($order->cashback)}}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">{{$lng->SubTotal}}</div>
                        <div class="info-value">{{App\Model\Product::currencyPriceRate($order->total)}}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">{{$lng->Shipping}}</div>
                        <div class="info-value">{{App\Model\Product::currencyPriceRate($order->shipping_cost)}}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">{{$lng->GrandTotal}}</div>
                        <div class="info-value grand-total">{{App\Model\Product::currencyPriceRate($order->total)}}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Paid Amount</div>
                        <div class="info-value">{{$order->paid_amount}}</div>
                    </div>
                    <div class="info-row">
                        @if($order->paid_amount<$order->total)
                                <button onclick="" class="btn btn-info" id="pay-btn">Pay Now</button>
                        @endif
                    </div>
                    <div class="info-row">
                        <div class="info-label">Due Amount</div>
                        <div class="info-value">{{$order->total-$order->paid_amount}}</div>
                    </div>
                    
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="content-title">
                        {{$lng->BillingAddress}}
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
    <div class="product-info-table border-top p-10 mt-25">
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
                    <td><span>{{App\Model\Product::currencyPriceRate($item->price)}}</span></td>
                    <td><span>{{$item->qty}}</span></td>
                    <td><span>{{App\Model\Product::currencyPriceRate($item->subtotal)}}</span></td>
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
                        <span>{{App\Model\Product::currencyPriceRate($item->price)}}</span>
                        <span>{{App\Model\Product::currencyPriceRate($item->subtotal)}}</span>
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
<div class="modal fade" id="order-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content"> 
       <div class="modal-body p-5">
          <h2 class="mb-4 text-center">Pay Now</h2>
          <span class="close modal-close-btn" data-dismiss="modal"><i class="ri-close-line"></i></span>
          <form method="post" action="{{URL::to('/user/order/partial-payment/'.$order->id)}}">
            <div class="form-group">
              @csrf

            <div class="form-group">
                <label for="subject">Amount *</label>
                <input value="{{$order->total-$order->paid_amount}}" required placeholder="Amount" type="text" class="form-control" name="amount">
            </div>
        
            <div class="form-group mb-0">    
                <button  class="default-btn px-4 mt-4">{{$lng->Submit}}</button>          
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('pageScripts')
<script>
  $(function () {
    $("#pay-btn").on('click', function() {
      $('#order-modal').modal('show');
      return;
    });
  });
    </script>


    @endsection