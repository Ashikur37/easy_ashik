@extends('layouts.front') 
@section('title', "$lng->TrackOrder") 
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/page/order-track.css">
@endsection
@section('content')
   <div class="order-track-page white-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="row">
                <div class="col text-center">
                <h2 class="tracked-header">{{$lng->TrackOrder}}</h2>
                </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-6 col-12 mb-5 mb-md-0">
                    <div class="order-track-step">
                        @foreach($order->tracks as $track)
                        <div class="step step-completed">
                            <div class="step-icon">
                            <div class="progress-circle"></div>
                            <div class="progress-line"></div>
                            </div>                
                            <div class="track-step-content">
                            <p class="order-title">{{$track->title}}</p>
                            <span class="order-time">{{$track->created_at->format('d M Y, h.ia')}}</span>
                            <p class="order-subtitle">{{$track->details}}</p>
                            </div>
                        </div>
                        @endforeach                
                    </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="order-track-option-wrapper">
                        <div class="d-flex">                  
                        <span> <i class="ri-bank-card-line"></i></span>
                            <div class="order-track-content">
                                <p class="order-track-title mb-3">Payment </p>                        
                                <div class="d-flex order-track-subtitle">
                                    <span>Payment status</span>
                                    <span class="ml-auto">{{$order->payment_status==1?'Confirmed':'Pending'}}</span>
                                </div>
                                <div class="d-flex order-track-subtitle">
                                    <span>Payment method</span>
                                    <span class="ml-auto">{{$order->payment_method}}</span>
                                </div>
                                <div class="d-flex order-track-subtitle">
                                <span class="">{{$lng->Amount}}</span>
                                    <span class="ml-auto">৳{{App\Model\Product::currencyPriceRate($order->shipping_cost+$order->total)}}</span>
                                </div>                           
                            </div>
                            </div>
                            <div class="d-flex mt-3">
                            <span><i class="ri-history-line"></i></span>
                            <div class="order-track-content">
                            <p class="order-track-title mb-3">{{$lng->RecentlyTracked}}</p>
                                @foreach($tracks as $track)
                                <div class="d-flex order-track-subtitle">
                                <a href="{{route('order-track',$track->order_number)}}">{{$track->order_number}}</a>
                                    <span class="ml-auto track-date">{{$track->created_at->format('d M Y, h.ia')}}</span>
                                </div>
                                @endforeach                         
                            </div>
                            </div>
                            <div class="d-flex mt-3" >
                            <span><i class="ri-focus-3-line"></i></span>
                            <div class="order-track-content">
                            <p class="order-track-title mb-3">{{$lng->TrackAnother}}</p>
                                <div class="d-flex order-track-subtitle">
                                    <form class="form-inprogress-line">
                                        <input id="order_code" type="text" class="form-control" placeholder="{{$lng->OrderId}}">
                                        <button type="button" id="track_submit" class="order-track-btn">{{$lng->Submit}}</button>
                                    </form>
                                </div>                       
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
    </div>
</div>
@endsection
