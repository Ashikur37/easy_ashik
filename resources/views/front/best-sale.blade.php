@extends('layouts.front')
@section('title', 'Best Sale')
@section('pageStyle')
    <link rel="stylesheet" href="{{ asset('front') }}/css/page/category.css">
@endsection
@section('content')
    <div class="container white-bg mb-20 mt-20">
        <div class="row mb-20 pt-20">
            <div class="col-md-5">
                <div class="sorting-left">
                    <h4>{{ $lng->BestSelling }}</h4>
                </div>
            </div>
            <div class="col-md-7">
                <div class="sorting-right justify-content-end">
                    <select id="sort" class="ts-custom-select">
                        <option value="0">{{ $lng->Latest }}</option>
                        <option value="7">{{ $lng->Popular }}</option>
                        <option value="6">{{ $lng->TopRated }}</option>
                        <option value="2">{{ $lng->PriceLowToHigh }}</option>
                        <option value="3">{{ $lng->PriceHighToLow }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-xl-2 col-md-3 col-6 mb-20 sm-mb-15 {{ $loop->even ? 'sm-pl' : 'sm-pr' }} prl-10">
                    @include('common.product.style1')
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('pageScripts')
    <script src="{{ asset('front/js/page/sale.js') }}"></script>
@endsection
