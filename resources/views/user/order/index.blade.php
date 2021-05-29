@extends('layouts.user')
@section('title', "Order List")
@section('content')
<div class="user-panel-content-wrapper">
   <div class="main-content-wrapper recent-order-container">
        <h4 class="section-title bb-none">{{$lng->MyOrder}}</h4>
        <table class="table">
            <thead>
                <tr class="title-row">
                    <th scope="col">{{$lng->OrderId}}</th>
                    <th scope="col">{{$lng->Date}}</th>
                    <th scope="col">{{$lng->Total}}</th>
                    <th scope="col">{{$lng->Status}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="table-row" data-href="{{route('user.order.show', $order->order_number)}}">
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->created_at->format('Md,Y')}}</td>
                    <td>{{App\Model\Product::currencyPriceRate($order->total)}}</td>
                    <td><span class="status-badge {{$order->statusClass()}}">{{$order->statusText()}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="md-card-wrapper">
            @foreach($orders as $order)
            <div class="md-card table-row" data-href="{{route('user.order.show', $order->order_number)}}">
                <div class="md-card-row">
                    <span>{{$lng->OrderId}}</span>
                    <span>{{$order->order_number}}</span>
                </div>
                <div class="md-card-row">
                    <span>{{$lng->Date}}</span>
                    <span>{{$order->created_at->format('Md,Y')}}</span>
                </div>
                <div class="md-card-row">
                    <span>{{$lng->Total}}</span>
                    <span>{{App\Model\Product::currencyPriceRate($order->total)}}</span>
                </div>
                <div class="md-card-row">
                    <span>{{$lng->Status}}</span>
                    <span><span class="status-badge {{$order->statusClass()}}">{{$order->statusText()}}</span></span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {!!$orders->links()!!}
</div>
@endsection
