<div class="lg-header">
    <div class="top-nav">
        <div class="container">
            <div class="top-nav-wrapper">
                <div class="contact-mail">
                    <span><i class="ri-phone-line"></i>{{$setting->phone1}}</span>
                    <span><i class="ri-mail-line"></i>{{$setting->mail1}}</span>
                </div>
                <div class="d-flex align-items-center"> 
                    <a href="@guest{{ route('login')}}@elseif(auth()->user()->type==0){{ route('user.home')}}@else{{ URL::to('/admin')}}@endguest
                        " class="login">
                        @guest
                        {{$lng->Login}}
                        @else
                        {{$lng->Account}}
                        @endif
                    </a> 
                    <span class="order-track order-track-button">{{$lng->TrackOrder}}</span> 
                    <div class="currency-language-wrapper">
                        <select class="ts-custom-select selectors"> 
                        @foreach($langs as $lang)
                            <option value="{{route('front.language',$lang->id)}}" {{ Session::has('language') ? ( Session::get('language')->id == $lang->id ? 'selected':'' ):($langs->where('is_default','=',1)->first()->id == $lang->id?'selected':'')}}>
                                {{$lang->name}}
                            </option>
                        @endforeach
                        </select>
                        <select class="ts-custom-select selectors">
                            @foreach($currencies as $currency)
                            <option value="{{route('front.currency',$currency->id)}}"
                                {{ Session::has('currency') ? ( Session::get('currency')->id == $currency->id ? 'selected' : '' ) : ($currencies->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}>
                                {{$currency->sign." ".$currency->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle-nav">
        <div class="container">
            <div class="middle-nav-content">
                <div class="logo-wrapper">
                    <a href="{{route('home')}}" class="header-logo">
                        <img alt="{{$setting->title}}" src="{{asset('images/banner/'.$setting->header_logo)}}">
                    </a>
                   <div class="position-relative active-sticky-category">
                         <span class="ts__dropdown__trigger"><i class="ri-menu-unfold-line"></i></span>
                    <nav class="ts__dropdown dropdown-category">
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
                </div>
                <div class="searchbox-wrapper">
                    <div class="searchbox">
                    <div class="searchbox-category">
                            <select class="ts-custom-select wide" id="search-category">
                                <option value="">{{$lng->AllCategories}}</option>
                                @foreach(\App\Model\Category::get()->sortByDesc('product_view')->take(5) as $category)
                                <option value="{{$category->slug}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>                       
                        <div class="searchbox-input">
                            <input type="text" class="input" placeholder="{{$lng->SearchGoods}}" id="searchProduct">
                            <div class="search-suggestion-wrapper" id="suggestedProduct">
                                <span class="popular-product">{{$lng->PopularProduct}}</span>
                                @foreach($topProducts as $product)
                                <div class="suggested-products-info">
                                    <div class="product-title">
                                        <a href="{{route('front-product.show',$product->slug)}}">{{ $product->name}}
                                            <br>
                                            <span class="product-price">{{App\Model\Product::currencyPrice($product->price)}}</span>
                                        </a>
                                    </div>
                                    <div class="product-img">
                                        <a href="{{route('front-product.show',$product->slug)}}">
                                            <img alt="{{$product->name}}" src="{{asset('images/product/'.$product->image)}}">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                <span class="top-search">Top Search</span>
                                @foreach($topKeys as $key)
                                <a class="link top-keyword" href="{{route('category')}}?key={{urlencode($key->term)}}">{{$key->term}}</a>
                                @endforeach
                            </div>
                        </div> 
                        <div class="searchbox-icon">
                            <i class="ri-search-line"></i>
                        </div> 
                    </div>  
                </div>       
                <div class="checkout-process-option" id="dynamic-header">
                    @include('load.front.header')
                </div>            
            </div>
        </div>
    </div>  
</div>
<!-- mobile header -->
<div class="d-lg-none">
    <div class="sm-top-header-section">
        <div class="container white-bg">
            <div class="brand-name">
                <a href="{{URL::to('/')}}">
                    <img alt="{{$setting->title}}" src="{{asset('images/banner/'.$setting->header_logo)}}"/>             
                </a>
            </div>
        </div>
    </div>
    <div class="sm-bottom-nav">
        <div class="container">
            <div class="sm-bottom-nav-wrapper">
                <a href="{{URL::to('/')}}">
                    <span class="sm-nav-item"><i class="ri-home-4-line"></i></span>
                </a>
                <span class="sm-nav-item ts__dropdown__trigger sm-dropdown-trigger">
                    <i class="ri-apps-2-line"></i>
                </span>
                <nav class="ts__dropdown dropdown-category">
                    <h4>{{$lng->Categories}}</h4>
                    <a href="#0" class="ts__close">{{$lng->Close}}</a>
                    <ul class="ts__dropdown__content custom-scrollbar">
                        @foreach($categories as $category)
                        @if($category->subCategories->count()>0)
                        <li class="has-children sm-device">
                            <a href="{{route('category',[$category->slug])}}"><img src="{{URL::to('/images/category/'.$category->image)}}" alt="{{$category->name}}">{{$category->name}}</a>
                            <ul class="ts__secondary__dropdown is-hidden">
                                <li class="go-back"><a href="#0">{{$lng->Menu}}</a></li>
                                @foreach($category->subCategories as $subCategory)
                                @if($subCategory->childCategories->count()>0)
                                <li class="has-children sm-device">
                                    <a href="{{route('category',[$category->slug,$subCategory->slug])}}">{{$subCategory->name}}</a>
                                    <ul class="is-hidden">
                                        <li class="go-back"><a href="#0">{{$subCategory->name}}</a></li>
                                        @foreach($subCategory->childCategories as $childCategory)
                                        <li><a href="{{route('category',[$category->slug,$subCategory->slug,$childCategory->slug])}}">{{$childCategory->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @else
                                <li><a href="{{route('category',[$category->slug,$subCategory->slug])}}">{{$subCategory->name}}</a>
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
                <span class="sm-nav-item aside-cart-trigger" id="sm-cart-counter">
                    <i class="ri-shopping-bag-line"></i>
                    @if(Cart::instance('default')->content()->count()>0)
                    <span class="counter-badge">{{Cart::instance('default')->content()->count()}}</span>
                    @endif 
                </span>                             
                <span class="sm-nav-item sm-search-trigger">
                    <i class="ri-search-line"></i>
                </span>
                <div class="sm-search-container custom-scrollbar">
                    <input type="text" id="smSearchBar" placeholder="{{$lng->SearchGoods}}" />
                    <span class="sm-search-closer"> <i class="ri-close-line"></i></span>
                    <div class="search-suggestion-wrapper active-suggested" id="smSuggestedProduct">
                    <span class="popular-product">{{$lng->PopularProduct}}</span>
                        @foreach($topProducts as $product)
                        <div class="suggested-products-info">
                            <div class="product-title">
                                <a href="{{route('front-product.show',$product->slug)}}">{{$product->name}}
                                <span class="product-price">{{App\Model\Product::currencyPrice($product->price)}}</span>
                                </a>
                            </div>
                            <div class="product-img">
                                <a href="{{route('front-product.show',$product->slug)}}">
                                    <img src="{{asset('images/product/'.$product->image)}}" alt="{{$product->name}}">
                                </a>
                            </div>
                        </div>
                        @endforeach
                        <strong class="top-search">{{$lng->TopSearch}}</strong>
                        @foreach($topKeys as $key)
                        <a class="link top-keyword" href="{{route('category')}}?key={{urlencode ( $key->term)}}">{{$key->term}}</a>
                        @endforeach
                    </div>
                </div>
                <span class="sm-nav-item sm-main-menu-trigger">
                    <i class="ri-user-line"></i>
                </span>
                <div class="sm-main-menu">
                    <div class="header">
                        <div class="avater">
                            @guest
                            <i class="ri-user-line"></i>
                            @else
                            <img alt="avatar"
                            src="{{ auth()->user()->provider ? auth()->user()->avatar : asset('images/avatar.png') }}" />
                            @endguest
                        </div>
                        @guest
                        <a href="{{route('login')}}" class="login-btn">{{$lng->Login}}</a>
                        @elseif(auth()->user()->type==0)
                        <a href="{{route('user.home')}}" class="login-btn">{{$lng->Account}}</a>
                        @else
                        <a href="{{URL::to('/admin')}}" class="login-btn">{{$lng->Account}}</a>
                        @endif
                    </div>
                    <div class="content-wrapper">
                        <div class="select-checkout_process_option">
                            <div class="select-option">                            
                                <select class="ts-custom-select selectors">
                                    @foreach($currencies as $currency)
                                    <option value="{{route('front.currency',$currency->id)}}"
                                        {{ Session::has('currency') ? ( Session::get('currency')->id == $currency->id ? 'selected' : '' ) : ($currencies->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}>
                                        {{$currency->sign." ".$currency->name}}</option>
                                    @endforeach
                                </select>
                                <select class="ts-custom-select selectors">
                                    @foreach($langs as $lang)
                                    <option value="{{route('front.language',$lang->id)}}"
                                        {{ Session::has('language') ? ( Session::get('language')->id == $lang->id ? 'selected' : '' ) : ($langs->where('is_default','=',1)->first()->id == $lang->id ? 'selected' : '') }}>
                                        {{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="checkout_process_option" id="sm-all-counter">
                                
                                <a href="{{route('user.wishlist')}}">
                                    <i class="ri-heart-line"></i>
                                    @if($wishCount)
                                    <span class="counter-badge">{{$wishCount}}</span>
                                    @endif
                                </a>
                                
                                <a href="{{route('compare')}}"><i class="ri-shuffle-line"></i>
                                    @if(Cart::instance('compare-list')->content()->count())
                                    <span class="counter-badge">
                                        {{Cart::instance('compare-list')->content()->count()}}
                                    </span>
                                    @endif
                                </a> 
                                <a href="#" class="order-track-button"><i class="ri-focus-3-line"></i></a>
                            </div> 
                        </div>
                        <ul class="main-menu-item-wrapper">
                            <li><a href="{{route('category')}}">{{$lng->Shop}}</a></li>
                            <li><a href="{{route('about-us')}}">{{$lng->AboutUs}}</a></li>
                            <li><a href="{{route('contact')}}">{{$lng->Contact}}</a></li>
                            <li><a href="{{route('faq')}}">{{$lng->FAQ}}</a></li>
                            <li><a href="{{route('blog')}}">{{$lng->Blog}}</a></li>
                        </ul>
                    </div>
                </div>                     
            </div>       
        </div>
    </div>
</div>