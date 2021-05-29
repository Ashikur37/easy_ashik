@extends('layouts.front')
@section('title', "$tag->name") 
@section('meta')
<meta name="title" content="{{$tag->name}}">
@endsection
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/page/category.css">
@endsection
@section('content')
  <section>
    <div class="container">
        <div class="row md-mt-40 sm-mt-20 mb-25">
            <div class="col-md-5">
                <div class="sorting-left">
                    <h3>{{$tag->name}}</h3>
                </div>
            </div>
            <div class="col-md-7">
                <div class="sorting-right justify-content-end">
                  <select id="sort" class="ts-custom-select">
                    <option value="0">{{$lng->Latest}}</option>
                    <option value="7">{{$lng->Popular}}</option>
                    <option value="6">{{$lng->TopRated}}</option>
                    <option value="2">{{$lng->PriceLowToHigh}}</option>
                    <option value="3">{{$lng->PriceHighToLow}}</option>
                </select>
                </div>
            </div>
        </div>
        <div class="row mt-4" id="pills-tabContent">
            @foreach ($tag->products as $product)
                <div class="col-lg-3 col-md-4 col-6 mb-5 {{$loop->even?'sm-pl':'sm-pr'}}">
                    @include('common.product.style1') 
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection 
@section('pageScripts')
<script src="{{ asset('front/js/page/sale.js') }}"></script>
@endsection