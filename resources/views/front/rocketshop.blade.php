@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row my-20">
            <div class="col-md-2 mb-20 prl-10">
                <div class="single-card rocket-card">
                   <a href="{{route('single-voucher')}}"> 
                       <div class="img-wrap">
                            <img src="{{asset('images/voucher/voucher.png')}}" alt="" class="img-fluid">
                        </div>
                        <div class="content-wrapper">
                            <h2 class="section-title">Meghna Pulp &amp;  Paper Mills Ltd</h2>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-2 mb-20 prl-10">
                <a href="{{route('single-voucher')}}">
                    <div class="single-card rocket-card">
                        <div class="img-wrap">
                            <img src="{{asset('images/voucher/rocketshop.jpg')}}" alt="" class="img-fluid">
                        </div>
                        <div class="content-wrapper">
                            <h2 class="section-title">Meghna Pulp &amp;  Paper Mills Ltd</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 mb-20 prl-10">
                <a href="{{route('single-voucher')}}">
                    <div class="single-card rocket-card">
                        <div class="img-wrap">
                            <img src="{{asset('images/voucher/voucher.png')}}" alt="" class="img-fluid">
                        </div>
                        <div class="content-wrapper">
                            <h2 class="section-title">Meghna Pulp &amp;  Paper Mills Ltd</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 mb-20 prl-10">
                <a href="{{route('single-voucher')}}">
                    <div class="single-card rocket-card">
                        <div class="img-wrap">
                            <img src="{{asset('images/voucher/rocketshop2.jpeg')}}" alt="" class="img-fluid">
                        </div>
                        <div class="content-wrapper">
                            <h2 class="section-title">Meghna Pulp &amp;  Paper Mills Ltd</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 mb-20 prl-10">
                <a href="{{route('single-voucher')}}">
                    <div class="single-card rocket-card">
                        <div class="img-wrap">
                            <img src="{{asset('images/voucher/voucher.png')}}" alt="" class="img-fluid">
                        </div>
                        <div class="content-wrapper">
                            <h2 class="section-title">Meghna Pulp &amp;  Paper Mills Ltd</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 mb-20 prl-10">
                <a href="{{route('single-voucher')}}">
                    <div class="single-card rocket-card">
                        <div class="img-wrap">
                            <img src="{{asset('images/voucher/rocketshop3.jpeg')}}" alt="" class="img-fluid">
                        </div>
                        <div class="content-wrapper">
                            <h2 class="section-title">Meghna Pulp &amp;  Paper Mills Ltd</h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection