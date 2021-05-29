@extends('layouts.front')
@section('title', "$brand->name")
@section('pageStyle')
<link rel="stylesheet" href="{{ asset('front') }}/css/vendor/jquery-ui.css">
<link rel="stylesheet" href="{{asset('front')}}/css/page/category.css">
@endsection
@section('content')
<div class="container">
    <div class="md-mt-40 sm-mt-20">
        <div class="sorting-left sm-sorting-left">
            <h3>{{$brand->name}}</h3>
        </div>
        <div class="banner-img">
            @if($brand->banner)
            <img src="{{ asset('/images/' . $brand->banner) }}" alt="banner">
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="row md-mt-40 sm-mt-20 mb-25">
        <div class="col-md-5">
            <div class="sorting-left">
                <h3>{{$brand->name}}</h3>
            </div>
        </div>
        <div class="col-md-7">
            <div class="sorting-right">
                <div class="sm-device-sorting">
                    <h4 class="sm-sorting-trigger">{{$lng->Filters}}</h4>
                    <span class="d-sm-none sm-sorting-trigger"><i class="ri-filter-line"></i></span>
                </div>
                <div class="d-flex">
                    <ul class="d-flex nav nav-pills grid-list-view">
                        <li><a id="grid" class="active view" data-toggle="pill" href="#grid-view"><i class="ri-function-line"></i></a></li>
                        <li><a id="list" class="view" data-toggle="pill" href="#list-view"><i class="ri-list-check-2"></i></a></li>
                    </ul>
                    <select id="sort" class="ts-custom-select">
                        <option value="0">{{$lng->Latest}}</option>
                        <option value="7">{{$lng->Popular}}</option>
                        <option value="6">{{$lng->TopRated}}</option>
                        <option value="2">{{$lng->PriceLowToHigh}}</option>
                        <option value="3">{{$lng->PriceHighToLow}}</option>
                    </select>
                    <select id="page" class="ts-custom-select">
                        <option value="9">9</option>
                        <option value="15">15</option>
                        <option value="24">24</option>
                        <option value="30">30</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 d-none d-lg-block">
            <span class="price-filter-item">{{$lng->Price}}</span>
            <div id="slider-range" class="slider-range" data-price-min="{{floor($minPrice)}}" data-price-max="{{ceil($maxPrice)}}"></div>
            <p class="price-filter-input">
                <input type="text" class="price-min-value" placeholder={{floor($minPrice)}}>
                <span class="price-separator"><span></span></span>
                <input type="text" class="price-max-value" placeholder={{ceil($maxPrice)}}>
            </p>
            @if($colors->count()>0)
            <div class="color-option">
                <span class="filter-item-title">{{$lng->Color}}</span>
                <div class="color-list">
                    @foreach($colors as $color)
                    <div class="color-item" style="background-color:{{$color->code}}">
                        <input value="{{$color->id}}" type="checkbox" name="color" class="product-color color-variant">
                        <i class="checked-icon"></i>
                    </div>
                    @endforeach 
                </div>
            </div>
            @endif
            @if($sizes->count()>0)
            <div class="size-option">
                <span class="filter-item-title">{{$lng->Size}}</span>
                @foreach ($sizes as $size)
                <div class="custom-checkbox">
                    <label>
                        <input type="checkbox" class="product-size" value="{{$size->id}}">
                        <span class="box"></span>
                        {{$size->name}}
                    </label>
                </div>
                @endforeach
            </div>
            @endif
            <div class="attribute-option">
                @foreach($attributes as $attribute)
                <span class="filter-item-title">{{$attribute->name}}</span>
                @foreach($attribute->datas as $data)
                <div class="custom-checkbox">
                    <label>
                        <input type="checkbox" class="attribute-value" value="{{$data->id}}">
                        <span class="box"></span>
                        {{$data->value}}
                    </label>
                </div>
                @endforeach
                @endforeach
            </div>
        </div>
        <div class="col-xl-9 col-12">
            <div class="tab-content" id="pills-tabContent">
                @include('load.front.category')
            </div>
        </div>
    </div>
    </div>        
</div>
<section class="aside-sm-filter p-5 custom-scrollbar">
    <div class="mt-2">
        <h4 class="price-filter-item">{{$lng->Price}}</h4>
        <div id="slider-range-sm" class="slider-range" data-price-min="{{floor($minPrice)}}" data-price-max="{{ceil($maxPrice)}}"></div>
        <p class="price-filter-input">
            <input type="text" class="price-min-value" placeholder={{floor($minPrice)}}>
            <span class="price-separator"><span></span></span>
            <input type="text" class="price-max-value" placeholder={{ceil($maxPrice)}}>
        </p>
    </div>
    @if($colors->count()>0)
    <div class="color-option">
        <h4 class="filter-item-title">{{$lng->Color}}</h4>
        <div class="color-list">
            @foreach($colors as $color)
            <div class="color-item" style="background-color:{{$color->code}}">
                <input value="{{$color->id}}" type="checkbox" name="color" class="product-color color-variant">
                <i class="checked-icon"></i>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @if($sizes->count()>0)
    <div class="size-option">
        <h4 class="filter-item-title">{{$lng->Size}}</h4>
        @foreach ($sizes as $size)
        <div class="custom-checkbox">
            <label>
                <input type="checkbox" class="product-size" value="{{$size->id}}">
                <span class="box"></span>
                {{$size->name}}
            </label>
        </div>
        @endforeach
    </div>
    @endif
    <div class="attribute-option">
        @foreach($attributes as $attribute)
        <h4 class="filter-item-title">{{$attribute->name}}</h4>
        @foreach($attribute->datas as $data)
        <div class="custom-checkbox">
            <label>
                <input type="checkbox" class="attribute-value" value="{{$data->id}}">
                <span class="box"></span>
                {{$data->value}}
            </label>
        </div>
        @endforeach
        @endforeach
    </div>
</section>
@endsection

@section('pageScripts')
    <script src="{{ asset('front/js/vendor/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('front/js/page/category.js') }}"></script>
    <script>
        $(function() {
            var $slider = $(".slider-range");
            var priceMin = Math.floor($slider.attr("data-price-min")),
                priceMax = Math.ceil($slider.attr("data-price-max"));
                $(".price-min-value, .price-max-value").map(function () {
                $(this).attr({
                    "min": Math.floor(priceMin),
                    "max": Math.ceil(priceMax)
                });
            });
            $(".price-min-value").attr({
                "placeholder": "min " + priceMin,
                "value": {{floor($minPrice)}}
            });
            $(".price-max-value").attr({
                "placeholder": "max " + priceMax,
                "value": {{ceil($maxPrice)}}
            });

            $slider.slider({
            range: true,
            stop: function (_, ui) {
                filter();
            },
            min: Math.max(priceMin, 0),
            max: priceMax,
            values: [{{floor($minPrice)}}, {{ceil($maxPrice)}}],
            slide: function (event, ui) {
                $(".price-min-value").val(Math.floor(ui.values[0]));
                $(".price-max-value").val(Math.ceil(ui.values[1]));
            }
        });
        $(".price-min-value").on("input", function () {
                minVal=$(this).val();
                $(".price-min-value").each(function(){
                $(this).val(minVal)
                })
                updateSlider();
                filter();
        });
        $(".price-max-value").on("input", function () {
                maxVal=$(this).val();
                $(".price-max-value").each(function(){
                $(this).val(maxVal)
                })
                updateSlider();
                filter();
        });
        function updateSlider() {
            $slider.slider("values", [Math.floor($(".price-min-value").val()), Math.ceil($(".price-max-value").val())]);
        }     
        });
    </script>
@endsection
