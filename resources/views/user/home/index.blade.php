@extends('layouts.user')
@section('title', "$lng->Dashboard")
@section('content')
<div class="user-panel-content-wrapper">
    <div class="main-content-wrapper">
        <h4 class="section-title">{{$lng->AccountInfo}}</h4>
        <div class="account-infos">
            <div class="row">
                <div class="col-md-6 right-border">
                    <div class="info">
                        <span class="label">{{$lng->Name}}</span>
                        <span class="value">{{auth()->user()->name}}</span>
                    </div>
                    <div class="info">
                        <span class="label">{{$lng->Mail}}</span>
                        <span class="value">{{auth()->user()->email}}</span>
                    </div>
                    <div class="info">
                        <span class="label">{{$lng->Joined}}</span>
                        <span class="value">{{auth()->user()->created_at->diffForHumans()}}</span>
                    </div>
                </div>
                <div class="col-md-6 pl-md-25">
                    <div class="info">
                        <span class="label">{{$lng->TotalOrder}}</span>
                        <span class="value">{{auth()->user()->orders->count()}}</span>
                    </div>
                    <div class="info">
                        <span class="label">{{$lng->Balance}}</span>
                        <span class="value">{{App\Model\Product::currencyPriceRate(auth()->user()->affiliate_balance)}}</span>
                    </div>
                    <div class="info">
                        <span class="label">{{$lng->Spent}}</span>
                        <span class="value">{{App\Model\Product::currencyPriceRate(auth()->user()->spent())}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="chart-wrapper">
        <div class="row my-3">
            <div class="col-md-6 col-12">
                <div class="order-status-chart">
                    <div class="legend-wrapper">
                        <span>{{$lng->OrderStatus}}</span>
                        <div class="legend-info">
                            <span class="legend-bg delivered"></span>
                            <span class="legend-text">{{$lng->Completed}}</span>
                            <span class="legend-value">{{auth()->user()->orders->where('status',3)->count()}}</span>
                        </div>
                        <div class="legend-info">
                            <span class="legend-bg pending"></span>
                            <span class="legend-text">{{$lng->Pending}}</span>
                            <span class="legend-value">{{auth()->user()->orders->where('status',0)->count()}}</span>
                        </div>
                        <div class="legend-info">
                            <span class="legend-bg canceled"></span>
                            <span class="legend-text">{{$lng->Other}}</span>
                            <span class="legend-value">{{auth()->user()->orders->whereNotIn('status',[0,3])->count()}}</span>
                        </div>
                    </div>
                    <svg id="pie-chart" width="200" height="150">
                        <text x="53%" y="50%" class="text" text-anchor="middle">
                            <tspan dx="0" dy="0">{{$lng->Total}}</tspan>
                            <tspan dx="52%" x="0" dy="1.6em">{{auth()->user()->orders->count()}}</tspan>
                        </text>
                    </svg>
                </div>
            </div>
            <div class="col-md-6 col-12 affiliate-chart-wrapper">
                <div class="affiliate-info-chart">
                    <div class="legend-wrapper">
                        <span>{{$lng->Affiliation}} {{$lng->Status}}</span>
                        <div class="legend-info">
                            <span class="legend-bg earned"></span>
                            <span class="legend-text">{{$lng->Earned}}</span>
                            <span class="legend-value">{{App\Model\Product::currencyPriceRate(auth()->user()->withdrawAmount()+auth()->user()->spent()+auth()->user()->affiliate_balance)}}</span>
                        </div>
                        <div class="legend-info">
                            <span class="legend-bg balance"></span>
                            <span class="legend-text">{{$lng->Balance}}</span>
                            <span class="legend-value">{{App\Model\Product::currencyPriceRate(auth()->user()->affiliate_balance)}}</span>
                        </div>
                        <div class="legend-info">
                            <span class="legend-bg spent"></span>
                            <span class="legend-text">{{$lng->Withdraw}}</span>
                            <span class="legend-value">{{App\Model\Product::currencyPriceRate(auth()->user()->withdrawAmount())}}</span>
                        </div>
                    </div>
                    <svg id="pie-chart2" width="200" height="150">
                        <text x="53%" y="50%" class="text" text-anchor="middle">
                            <tspan dx="0" dy="0">{{$lng->Spent}}</tspan>
                            <tspan dx="52%" x="0" dy="1.6em">{{App\Model\Product::currencyPriceRate(auth()->user()->spent())}}</tspan>
                        </text>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content-wrapper recent-order-container mb-0">
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
</div>
@endsection

@section('pageScripts')
<script>
    var data = [{
        "name": "{{$lng->Completed}}",
        "color": "#00C1FF",
        "value": {{auth()->user()->orders->where('status', 3)->count()}}
    }, {
        "name": "{{$lng->Pending}}",
        "color": "#8E98BF",
        "value": {{auth()->user()->orders->where('status', 0)->count()}}
    }, {
        "name": "{{$lng->Other}}",
        "color": "#FF2660",
        "value": {{auth()->user()->orders->whereNotIn('status', [0, 3])->count()}}
    }];
    var svg = document.getElementById('pie-chart'),
        totalValue = 0,
        radius = 55,
        circleLength = Math.PI * (radius * 2),
        spaceLeft = circleLength;
    for (var i = 0; i < data.length; i++) {
        totalValue += data[i].value;
    }
    for (var c = 0; c < data.length; c++) {
        var circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
        circle.setAttribute("class", "pie-chart-value");
        circle.setAttribute("cx", 100);
        circle.setAttribute("cy", 75);
        circle.setAttribute("r", radius);
        circle.style.strokeDasharray = (spaceLeft) + " " + circleLength;
        circle.style.stroke = data[c].color;
        svg.appendChild(circle);
        spaceLeft -= (data[c].value / totalValue) * circleLength;
    }
</script>

<script>
    var data = [{
            "name": "{{$lng->Earned}}",
            "color": "#275EF6",
            "value": {{auth()->user()->withdrawAmount()+auth()->user()->spent()+auth()->user()->affiliate_balance}}
        },
        {
            "name": "{{$lng->Balance}}",
            "color": "#AA35E3",
            "value": {{auth()->user()->affiliate_balance}}
        }, {
            "name": "{{$lng->Withdraw}}",
            "color": "#FF2660",
            "value": {{auth()->user()->withdrawAmount()}}
        }
    ];
    var svg = document.getElementById('pie-chart2'),
        list = document.getElementById('pie-values2'),
        totalValue = 0,
        radius = 55,
        circleLength = Math.PI * (radius * 2), // Circumference = PI * Diameter
        spaceLeft = circleLength;
    for (var i = 0; i < data.length; i++) {
        totalValue += data[i].value;
    }
    for (var c = 0; c < data.length; c++) {
        var circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
        circle.setAttribute("class", "pie-chart-value");
        circle.setAttribute("cx", 100);
        circle.setAttribute("cy", 75);
        circle.setAttribute("r", radius);
        circle.style.strokeDasharray = (spaceLeft) + " " + circleLength;
        circle.style.stroke = data[c].color;
        svg.appendChild(circle);
        spaceLeft -= (data[c].value / totalValue) * circleLength;
    }
</script>
@endsection