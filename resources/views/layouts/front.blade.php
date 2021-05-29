<!doctype html>
<html lang="en">
<head>
    <title>
        @hasSection('title')
@yield('title')-{{ $setting->title }}
@else
        {{ $setting->title }}
@endif
    </title>
    <link rel="icon" href="{{ URL::to('/images/banner/' . $setting->favicon) }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@sectionMissing('meta')
    <meta name="keywords" content="{{ $setting->meta_title }}">
    <meta name="description" content="{{ $setting->meta_description }}">
    <meta property="og:title" content="{{ $setting->meta_title }}" />
    <meta property="og:description" content="{{ $setting->meta_description }}" />
    <meta property="og:image" content="{{ URL::to('/images/banner/' . $setting->header_logo) }}" />
@endif
@yield('meta')
    
    <link rel="stylesheet" href="{{ asset('front/css/vendor/vendor-plugin.css') }}" />  
@yield('pageStyle')
<link rel="stylesheet" href="{{ asset('front/css/core.css') }}" />
    {!! $setting->custom_css !!}
    @if ($setting->is_pixel)
    {!! $setting->facebook_pixel !!}
    @endif
</head>
<body style="--dynamic-color:{{ $setting->theme_color }}">
@include('includes.front.header')
    <div class="d-none" id="site-loader">
        <img alt="loader" class="loader__image" src="{{ asset('images/banner/' . $setting->site_loader) }}">
    </div>
    @yield('content')
    <!--top scroll button   -->
    <a id="back-to-top"><i class="ri-arrow-up-s-line"></i></a>
    @include('includes.front.footer')
    <div class="product-cart-status" id="aside-cart">
        @include('includes.front.cart')
    </div>
    
    <script src="{{ asset('front/js/vendor/jquery.min.js') }}"></script>
    @yield('pageScripts')
    <script src="{{ asset('front/js/vendor/plugins.js') }}"></script>
    <script src="{{ asset('front/js/core.js') }}"></script>
    <script>
        var mainUrl = "{{ URL::to('/') }}";
        var lng = {!!json_encode($lng) !!}
        var loggedIn = "{{ auth()->check() }}";
        $(function () {
            $(".theme-color").on('click',function(){
               $(document.body).css("--dynamic-color",$(this).val())
            })
            $("#favcolor").on('input',function(){
                $(document.body).css("--dynamic-color",$(this).val())
            })
            @if(Session::has('success'))     
            toastr.success('{{ Session::get('success') }}')
            @endif
            @if(Session::has('error'))
            toastr.error('{{ Session::get('error') }}')
            @endif
        }) 
    </script>
    
    @if ($setting->is_messenger)
        {!! $setting->messenger !!}
    @endif

    @if ($setting->is_tawk_to)
        {!! $setting->tawk_to !!}
    @endif

    @if ($setting->is_analytic)
        {!! $setting->google_analytic !!}
    @endif
    {!! $setting->custom_js !!}
    
    <script>
    var btn = $('#back-to-top');
    $(window).scroll(function() {
      if ($(window).scrollTop() > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });
    
    btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop:0}, '300');
    });
    </script>
</body>
</html>
