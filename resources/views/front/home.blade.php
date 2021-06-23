@extends('layouts.front')
@section('title', "$lng->Home")
@section('pageStyle')
    <link rel="stylesheet" href="{{ asset('front') }}/css/vendor/slick.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/css/vendor/animate.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/css/page/home.css">
@endsection
@section('content')
    <div class="container">
        <div class="offers-wrapper">
            <ul class="d-flex">
                <li><a href="{{route('single-voucher')}}"><img src="{{asset('images/voucher/index.svg')}}" alt="" style=""><span>Voucher Shops</span></a></li>
                <li><a href="{{route('single-voucher')}}"><img src="{{asset('images/voucher/index1.svg')}}" alt="" style=""><span>Prime Shops</span></a></li>
                <li><a href="{{route('rocket-shop')}}"><img src="{{asset('images/voucher/index2.svg')}}" alt="" style=""><span>Easymert Rocket</span></a></li>
                <li><a href="{{route('campaign')}}"><img src="{{asset('images/voucher/index3.jpg')}}" alt="" style=""><span>Easymert Offers</span></a></li>
            </ul>
        </div>
        <div class="hero-section">
            <div class="position-relative"> 
                <nav class="ts__dropdown d-none d-lg-block category-home">
                    <h5 class="category-title">Categories</h5>
                    <a href="#0" class="ts__close">{{$lng->Close}}</a>
                    <ul class="ts__dropdown__content">
                        @foreach($categories as $category)
                        @if($category->subCategories->count()>0)
                        <li class="has-children">                                
                            <a href="{{route('category',[$category->slug])}}">
                                <img src="{{URL::to('/images/category/'.$category->image)}}" alt="{{$category->name}}">{{$category->name}}</a>
                            <ul class="{{$category->childCategories->count()==0?'ts__primary__dropdown':'ts__secondary__dropdown'}} is-hidden">
                                <li class="go-back"><a href="#0">{{$lng->Menu}}</a></li>
                                @foreach($category->subCategories as $subCategory)
                                @if($category->subCategories->count()>0)
                                <li class="{{$subCategory->childCategories->count()==0?'':'has-children'}} ">
                                    <a href="{{route('category',[$category->slug,$subCategory->slug])}}">{{$subCategory->name}}</a>
                                    <ul class="is-hidden">
                                        @foreach($subCategory->childCategories as $childCategory)
                                        <li><a href="{{route('category',[$category->slug,$subCategory->slug,$childCategory->slug])}}">{{$childCategory->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @else
                                <li>
                                    <a href="{{route('category',[$category->slug,$subCategory->slug])}}">{{$subCategory->name}}</a>
                                </li>
                                @endif
                                @endforeach
                            </ul> 
                        </li> 
                        @else
                        <li><a href="{{route('category',[$category->slug])}}"><img src="{{URL::to('/images/category/'.$category->image)}}" alt="{{$category->name}}">{{$category->name}}</a></li>
                        @endif
                        @endforeach
                        <li><a href="{{ route('categories') }}"><i class="ri-add-circle-line"></i>{{$lng->AllCategories}}</a></li>
                    </ul> 
                </nav>
            </div>
            <div class="home-slider">
                @foreach ($slides as $slide)
                    <div class="slide">
                        <div class="slide-img">
                            <img src="{{ asset('images/slider/' . $slide->image) }}" alt="{{ $slide->title }}"
                                data-lazy="{{ asset('images/slider/' . $slide->image) }}" class="full-image animated"
                                data-animation-in="zoomInImage" />
                        </div>
                        <div
                            class="slide-content {{ $slide->direction == 1 ? 'slide-content-left' : 'slide-content-right' }}">
                            <div
                                class="slide-content-wrapper {{ $slide->direction == 1 ? 'text-left' : 'text-right' }}">
                                <span style="color:{{ $slide->title_color }}" class="animated title"
                                    data-animation-in="{{ $slide->direction == 1 ? 'fadeInRight' : 'fadeInLeft' }}">{{ $slide->title }}</span>
                                <span style="color:{{ $slide->color }}" class="animated sub-title"
                                    data-animation-in="{{ $slide->direction == 1 ? 'fadeInRight' : 'fadeInLeft' }}"
                                    data-delay-in="0.3">{{ $slide->body }}</span>
                                <a href="{{ $slide->call_to_action_url }}" data-delay-in="0.6"
                                    class="animated btn-action" data-animation-in="zoomIn">{{ $slide->button_text }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="top-category-banner">
                <div class="banner">
                    @if ($setting->top_right_banner_1_image)
                        <img src="{{ asset('images/banner/' . $setting->top_right_banner_1_image) }}" alt="banner">
                    @endif
                    <div class="banner-content">
                        <h3>{{ $setting->top_right_banner_1_text }}</h3>
                        <a href="{{ $setting->top_right_banner_1_url }}"
                            {{ $setting->top_right_banner_1_new_window == 1 ? 'target="_blank"' : '' }}>Explore</a>
                    </div>
                </div>
                <div class="banner">
                    @if ($setting->top_right_banner_2_image)
                        <img src="{{ asset('images/banner/' . $setting->top_right_banner_2_image) }}" alt="banner">
                    @endif
                    <div class="banner-content">
                        <h3>{{ $setting->top_right_banner_2_text }}</h3>
                        <a href="{{ $setting->top_right_banner_2_url }}"
                            {{ $setting->top_right_banner_2_new_window == 1 ? 'target="_blank"' : '' }}>Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($setting->is_service)
        <div class="container">
            <div class="shop-with-us mt-20 sm-mt-10">
                @if ($setting->is_service)
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="shop-facility">
                            <span class="large-icon">{!! $setting['service' . $i . '_image'] !!}</span>
                            <div>
                                <span class="title">{{ $setting['service' . $i . '_title'] }} </span>
                                <span class="sub-title">{{ $setting['service' . $i . '_sub_title'] }} </span>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    @endif
       @if ($flashSale)
        <div class="container">
            <div class="flash-sale-section mt-20 sm-mt-10 p-20 pb-0">
                <div class="flash-deal-wrapper ">
                    <div class="flash-deal-lg-content">
                        <h5 class="item-section-info mb-0"><span>
                        <i class="ri-shield-flash-line flash-icon"></i></span>{{ $flashSale->title }}</h5>
                        <div class="flash-deal-counter">
                            <span>end in</span>
                            <div id="flashClock">
                                <div>
                                    <span class="days"></span>:
                                </div>
                                <div>
                                    <span class="hours"></span>:
                                </div>
                                <div>
                                    <span class="minutes"></span>:
                                </div>
                                <div>
                                    <span class="seconds"></span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('flash-sale') }}" class="see-all-product">{{ $lng->ViewAll }}
                                <i class="ri-arrow-right-line see-all-arrow"></i>
                            </a>
                        </div>
                    </div>
                    <div class="sm-flash-deal-counter">
                        <div class="small">{{ $lng->EndingIn }}</div>
                        <div id="smFlashClock">
                            <div>
                                <span class="days"></span>:
                            </div>
                            <div>
                                <span class="hours"></span>:
                            </div>
                            <div>
                                <span class="minutes"></span>:
                            </div>
                            <div>
                                <span class="seconds"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-20">
                    <div class="flash-slider">                   
                        @foreach ($flashSale->products as $product)           
                            @include('common.product.flash-sale')                     
                        @endforeach
                   </div>
                </div>
            </div>
        </div>
    @endif
        <div id="extra">
        </div>

    @if ($setting->is_newsletter)
        <div class="modal fade" id="newsLatterModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="newsletter-inner">
                            <span class="close" data-dismiss="modal">
                                <i class="ri-close-line"></i>
                            </span>
                            <div class="left"
                                style="background-image: url('{{ URL::to('images/banner/' . $setting->news_letter_image) }}')">
                            </div>
                            <div class="right">
                                <h3 class="title">
                                    {{ $setting->news_letter_title }}
                                </h3>
                                <p class="sub-title">{{ $setting->news_letter_sub_title }}</p>
                                <form onsubmit="return subscribe()">
                                    <div class="input-group">
                                        <input required type="email" class="form-control email-field"
                                            placeholder="{{ $lng->Email }}" id="sub_email">
                                        <button type="submit" class="default-btn submit-btn">{{ $lng->Subscribe }}</button>
                                    </div>
                                    <div class="form-group custom-checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" id="hide-news-letter">
                                            <span class="box"></span>
                                            {{ $lng->DontShowthisAgain }}
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    
@endsection
@section('pageScripts')
    <script src="{{ asset('front') }}/js/vendor/slick.min.js"></script>
    <script src="{{ asset('front') }}/js/vendor/slick-animation.min.js"></script>
    <script src="{{ asset('front') }}/js/page/home.js"></script>
    <script>
        @if($flashSale)
        window.flashSale=true;
        window.deadline = new Date('{{$flashSale->end}}');
        @else
        window.flashSale=false;
        @endif
    </script>
    
@endsection