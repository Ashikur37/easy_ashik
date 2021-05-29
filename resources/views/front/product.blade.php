@extends('layouts.front')
@section('title', "$product->name")
@section('meta')
<meta name="title" content="{{$product->meta_title}}">
<meta name="description" content="{{$product->meta_description}}">
<meta property="og:title"  content="{{ $product->meta_title }}" />
<meta property="og:description" content="{{html_entity_decode(Str::limit(trim(strip_tags($product->details)),180,'.'))}}" />
<meta property="og:image"  content="{{asset('images/product/'.$product->image)}}" data-zoom="{{asset('images/product/'.$product->image)}}" />
@endsection
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/vendor/slick.min.css">
<link rel="stylesheet" href="{{ asset('front') }}/css/page/product.css">
@endsection
@section('content')
<div class="product-page white-bg"> 
    <div class="container">
        <div class="row"> 
            <div class="col-12">
                <div class="row mt-40">
                    <div class="col-md-4 col-sm-8 offset-sm-2 offset-md-0">
                        <div class="gallery">
                            <div class="slickbox-border">
                                <div class="product-image-slider">
                                    @foreach($product->images as $image)
                                        <div class="product-image image-zoom" data-src="{{asset('images/product/'.$image->image)}}">
                                            <img src="{{asset('images/product/'.$image->image)}}" alt="product-image" />
                                        </div>
                                    @endforeach                     
                                </div>             
                            </div> 
                            <div class="product-thumbs">
                                @foreach($product->images as $image)
                                    <div class="product-thumbs-item">
                                        <img src="{{asset('images/product/'.$image->image)}}" alt="product-thumbs" />                  
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="product-details-wrapper">
                        <div class="brand-stock_status">
                                @if($product->inStock())
                                <span class="in-stock"><i class="ri-checkbox-circle-fill"></i>{{$lng->InStock}}</span>
                                @else
                                <span class="out-of-stock"><i class="ri-close-circle-fill"></i>{{$lng->OutOfStock}}</span>
                                @endif
                            <span class="brand-name">{{$product->brand?$product->brand->name:''}}</span>
                        </div>
                            <div class="product-name-rating">
                                <span class="product-name">
                                    {{$product->name}}
                                </span>
                                <div class="rating-container">
                                    <div class="ratings">
                                        <div class="empty-stars"></div>
                                        <div class="full-stars" style="width:{{$rating*20}}%"></div> 
                                    </div>
                                    <span>( {{$product->reviews->count()}} )</span>
                                </div> 
                            </div>
                            <div class="product-price">
                                <span id="product-price" class="new-price"> {{App\Model\Product::currencyPrice($product->price)}}</span>
                                @if($product->price!=$product->actualPrice())
                                <span class="old-price">{{App\Model\Product::currencyPrice($product->actualPrice())}} </span>
                                @endif
                            </div>
                            <div class='product-short-desc'>
                                <p>{{html_entity_decode(Str::limit(trim(strip_tags($product->details)),180,'.'))}}</p>
                            </div>
                            <div class="color-wrapper">
                                @if($product->productColors->count()>0)
                                <div class="color-title">{{$lng->Color}}</div>
                                <div class="color-options">
                                    @foreach($product->productColors as $color)
                                    <div class="color-item" style="background-color:{{$color->code}}">
                                        <input class="product-variant color-product" data-val="{{$color->id}}" type="radio" name="color">
                                        <i class="checked-icon"></i>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @if($product->productSizes->count()>0)
                            <div class="size-wrapper">
                                <div class="size-title">{{$lng->Size}}</div>
                                @foreach($product->sizes as $size)
                                <label>
                                    <input data-val="{{$size->size->id}}" class="product-variant size-product" type="radio" name="size" />
                                    {{$size->size->name}}
                                    @if($size->price>0)
                                    &nbsp;+ <b>{{App\Model\Product::currencyPriceRate($size->price)}}</b>
                                    @endif
                                </label>
                                @endforeach
                            </div>
                            @endif
                            @foreach($product->options as $option)
                            <div class="size-wrapper">
                                <div class="size-title">{{$option->option->name}}</div>
                                @foreach($option->option->values as $value)
                                <label>
                                    <input {{$loop->first&&$option->option->required?'checked':''}} class="product-variant option-input" data-id="{{$option->option_id}}" data-val="{{$value->id}}" type="radio" name="option[{{$option->option_id}}]" />
                                    {{$value->label}} &nbsp;+ <b>{{App\Model\Product::currencyPriceRate($value->price)}}</b>
                                </label>
                                @endforeach
                            </div>
                            @endforeach
                            <div class="cart-buy-btn">
                                @if($product->inStock())
                                <button data-url="{{route('cart.add')}}" data-id="{{$product->id}}" id="add__cart" class="add__cart">{{$lng->AddToCart}}</button>
                                @else
                                <button class="add__cart">{{$lng->SoldOut}}</button>
                                @endif
                                <button data-url="{{route('cart.add')}}" data-id="{{$product->id}}" class="buy-btn">{{$lng->BuyNow}}</button>
                            </div>
                            <hr>
                            <div class="wishlist-favourite-action">
                                <div data-url="{{route('wishlist.add')}}" class="add__wishlist fav {{in_array($product->id,$wishProducts)?'active':''}}" data-id="{{$product->id}}"><i class="ri-heart-line"></i>wishlist</div>
                                <div class="add-to-compare" data-url="{{ route('compare.add') }}" class="add-to-compare" data-id="{{ $product->id }}">
                                    <i class="ri-shuffle-line"></i>compare</div>
                            </div>           
                            <div class="aditional-infos-row">
                                <div class="info-title">categories</div>
                                <div class="info-item">
                                    <a href="{{route('category',$product->category->slug)}}" class="item">{{$product->category->name}},</a>
                                    @if($product->sub_category_id)
                                    <a href="{{route('category',[$product->category->slug,$product->subCategory->slug])}}" class="item">{{$product->subCategory->name}},</a>
                                    @endif
                                    @if($product->child_category_id)
                                    <a href="{{route('category',[$product->category->slug,$product->subCategory->slug,$product->childCategory->slug])}}" class="item">{{$product->childCategory->name}}</a>
                                    @endif
                                </div>
                            </div>
                            @if($product->productTags->count()>0)
                            <div class="aditional-infos-row">
                                <div class="info-title">{{$lng->Tags}}</div>
                                <div class="info-item">
                                    @foreach($product->productTags as $tag)
                                    <a href="{{route('tag.product',$tag->name)}}" class="item">{{$tag->name}}</a>
                                    @endforeach
                                </div>
                            </div>
                            @endif      
                            <div class="social-share mt-4">
                                <div class="info-title mb-2">{{$lng->Share}}</div>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}" target="_blank">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                                <a href="https://wa.me/?text={{$product->name}} {{Request::url()}}" target="_blank"><i class="ri-whatsapp-fill"></i></a>
                                <a href="https://twitter.com/share?url={{Request::url()}}" target="_blank">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{Request::url()}}" target="_blank">
                                    <i class="ri-linkedin-box-fill"></i>
                                </a>
                                <a href="http://www.tumblr.com/share?v=3&amp;u={{Request::url()}}" target="_blank">
                                    <i class="ri-tumblr-fill"></i>
                                </a>
                            
                            </div>            
                        </div>
                    </div>
                    <div class="col-3 d-none d-md-block">
                        <div class="text-center p-20 seller-info-wrapper">
                            <h4>Seller Information</h4>
                            @if(!$product->user_id)
                            <div class="seller-info">
                                <span class="avater"><img alt="{{$setting->title}}" src="{{asset('images/banner/'.$setting->header_logo)}}"></span>
                                <span class="seller-name">{{$setting->title}}<span class="is-verify"> <img style="width:70px" src="{{URL::to('images/verified.png')}}"> </span></span>
                            </div> 
                            @else
                            <div class="seller-info">
                                <span class="avater">
                                    <img alt="avatar"
                                    src="{{ auth()->user()->provider ? auth()->user()->avatar : asset('images/avatar.png') }}" />
                                </span>
                                <span class="seller-name">{{\App\Model\Vendor::where('user_id',$product->user_id)->first()->store_name}}<span class="is-verify"> <img style="width:70px" src="{{URL::to('images/verified.png')}}">  </span></span>
                            </div>
                            @endif
                            <span class="store-status">{{\App\Model\Product::where('user_id',$product->user_id)->count()}} items</span>
                            <a href="{{route('seller')}}?id={{$product->user_id}}" class="store-btn">Visit Seller Store</a> 
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col"> 
                        <div class="product-desc-container">
                        <div class="desc-tabs">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="desc-tab" data-toggle="tab" href="#desc"><span>{{$lng->Details}}</span></a>
                                        </li>
                                        @if(count($product->attributes)>0)
                                        <li class="nav-item">
                                            <a class="nav-link" id="spec-tab" data-toggle="tab" href="#spec"><span>{{$lng->Spec}}</span></a>
                                        </li>
                                        @endif
                                        <li class="nav-item">
                                            <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments"><span>{{$lng->Comments}}</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews"><span>{{$lng->Reviews}}</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="desc">
                                    <div class="content-wrapper">
                                        {!!$product->details!!}
                                    </div>
                                    </div>
                                    <div class="tab-pane" id="spec">
                                        @foreach ($product->attributes as $attribute)
                                            <div class="specifications">
                                                <span class="label">{{$attribute->attribute->name}}</span>
                                                @foreach($attribute->values as $value)
                                                <span class="value">{{$value->value->value}}</span>&nbsp;
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="comments">
                                        <div class="post-comment">
                                            <div class="section-title">
                                                <span>{{$lng->PostAComment}}</span>
                                            </div>
                                            @auth
                                            <form method="post" action="{{ route('product.comment', $product->id) }}">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea required name="text" cols="100" class="form-control" rows="3" placeholder="Your Comment ..."></textarea>
                                                </div>
                                                <div class="form-group">                                    
                                                    <button class="default-btn submit-btn" type="submit">Post</button>
                                                </div>
                                            </form>
                                            @else                     
                                            <span class="login-comment">{{ $lng->PleaseLoginToComment }}</span>
                                            <a class="default-btn login-button login-modal"> Login</a>
                                            @endauth
                                        </div>
                                        <div class="comments-section">
                                            <div class="comments-header">
                                                <div class="section-title"><span>{{ $lng->Comments }}({{ $product->comments->count() }})</span></div>
                                            </div>
                                            @foreach($product->comments as $comment)
                                            <div class="comment-wrapper"> 
                                                <div class="thumb">
                                                    <img onerror="this.onerror=null;this.src='{{ asset('images/avatar.png') }}'" src="{{ $comment->user->getImageUrl() }}" alt="avatar" />
                                                </div>
                                                <div class="comment-details">
                                                    <span class="name">{{ $comment->user->name }}</span> 
                                                    <p class="comment">{{ $comment->text }}</p>
                                                    <div class="reply-date">
                                                        @auth
                                                        <span onclick="showReplyContainer({{ $comment->id }},this)" class="reply-button">{{ $lng->Reply }}</span> 
                                                        @else
                                                        <span class="reply-button login-modal">{{ $lng->Reply }}</span> 
                                                        @endauth
                                                        <span class="date-time">&mid; {{ $comment->created_at->diffForHumans() }}</span>
                                                    </div>                                 
                                                    <div class="reply-container">                               
                                                        @auth
                                                        <div class="reply-form hide" id="reply-container{{$comment->id}}">
                                                            <form class="mb-3" method="post" action="{{ route('product.comment.reply', $comment->id) }}">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <textarea required name="text" cols="100" class="form-control" rows="3" placeholder="Your Reply ..."></textarea>
                                                                </div>
                                                                <button class="default-btn submit-btn">Reply</button>
                                                            </form>
                                                        </div>                             
                                                        @endauth
                                                        @foreach ($comment->replies as $reply)
                                                        <div class="reply-wrapper">
                                                            <div class="thumb">
                                                                <img onerror="this.onerror=null;this.src='{{ asset('images/avatar.png') }}'" src="{{ $reply->user->getImageUrl() }}" alt="avatar" />
                                                            </div>
                                                            <div class="reply-details">
                                                                <span class="name">{{ $reply->user->name }}</span> 
                                                                <p class="comment">{{ $reply->text }}</p>
                                                                <span class="date-time">{{ $reply->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach                                       
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="reviews">
                                        <div class="reviews">
                                            <h4 class="review-count">{{$lng->Reviews}}({{$product->reviews->count()}})</h4>
                                            @foreach($product->reviews->where('is_approved',1) as $review)
                                            <div class="review">
                                                <div class="thumb">
                                                    <img onerror="this.onerror=null;this.src='{{asset('images/avatar.png')}}'" src="{{$review->user->getImageUrl()}}" alt="avatar" />
                                                </div>
                                                <div class="review-details">
                                                    <div class="name-rating">
                                                        <span class="name">{{$review->user->name}}</span>
                                                        <div class="ratings">
                                                            <div class="empty-stars"></div>
                                                            <div class="full-stars" style="width:{{$review->rating*20}}%"></div>
                                                        </div>
                                                    </div>
                                                <div class="review-bg">
                                                        <div class="title-date">
                                                            <span class="title">{{$review->title}}</span>
                                                            <span class="date-time">{{$review->created_at->diffForhumans()}}</span>
                                                        </div>
                                                        <div class="review-detail">
                                                            <p>{{$review->comment}}</p>
                                                        </div>
                                                </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="post-review">
                                                @if(auth()->check())
                                                @if($product->canReview()&&!$product->hadReview())
                                                <span class="section-title">{{$lng->AddAReview}}</span>
                                                @endif
                                                <div class="review-form">
                                                    @if($product->canReview())
                                                    @if(!$product->hadReview())
                                                    <form method="post" action="{{route('product.review',$product->id)}}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <label>{{$lng->ReviewTitle}}</label>
                                                                    <input type="text" class="form-control" id="review__title" name="title" placeholder="review title" />
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>{{$lng->Rating}} *</label>
                                                                    <div class="custom__input">
                                                                        <div class="rat">
                                                                            <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
                                                                            <label for="star5">☆</label>
                                                                            <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
                                                                            <label for="star4">☆</label>
                                                                            <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
                                                                            <label for="star3">☆</label>
                                                                            <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
                                                                            <label for="star2">☆</label>
                                                                            <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
                                                                            <label for="star1">☆</label>
                                                                            <div class="clear"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Comment">{{$lng->Comment}}*</label>
                                                            <textarea name="comment" cols="100" class="form-control" id="Comment" rows="3"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="default-btn px-3">{{$lng->Submit}}</button>
                                                        </div>
                                                    </form>
                                                    @endif
                                                    @else
                                                    {{$lng->BuyThisProductToReview}}
                                                    @endif
                                                </div>
                                                @else
                                                <span class="section-title">{{$lng->PleaseLoginToAddAReview}}</span>
                                                <a class="default-btn login-btn login-modal"> {{$lng->LoginNow}}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="row d-md-none mb-4">
                    <div class="col-12">
                        <div class="text-center p-20 seller-info-wrapper">
                            <h4>Seller Information</h4>
                            @if(!$product->user_id)
                            <div class="seller-info">
                                <span class="avater"><img alt="{{$setting->title}}" src="{{asset('images/banner/'.$setting->header_logo)}}"></span>
                                <span class="seller-name">{{$setting->title}}<span class="is-verify"> (verified) </span></span>
                            </div> 
                            @else
                            <div class="seller-info">
                                <span class="avater">
                                    <img alt="avatar"
                                    src="{{ auth()->user()->provider ? auth()->user()->avatar : asset('images/avatar.png') }}" />
                                </span>
                                <span class="seller-name">{{\App\Model\Vendor::where('user_id',$product->user_id)->first()->store_name}}<span class="is-verify"> (verified) </span></span>
                            </div>
                            @endif
                            <span class="store-status">{{\App\Model\Product::where('user_id',$product->user_id)->count()}} items</span>
                            <a href="{{route('category')}}?seller={{$product->user_id}}" class="store-btn">Visit Seller Store</a> 
                            
                        </div>
                    </div>
                </div>
                <div class="related-product-section">
                <h3 class="mt-20">{{$lng->RelatedProducts}}</h3> 
                    <div class="row mt-25">
                        @foreach($relatedProducts as $relatedProduct)
                        <div class="col-lg-3 col-md-4 col-6 mb-30 sm-mb-15 {{$loop->even?'sm-pl':'sm-pr'}}">
                            <div
        class="item-inner cart-item-{{ $relatedProduct->id }} {{ array_key_exists($relatedProduct->id, $cartProducts) ? 'in-cart' : '' }}">
        <div class="item-img-badge">
            <a href="{{ route('front-product.show', $relatedProduct->slug) }}" class="item-img">
                <img alt="{{ Str::limit($relatedProduct->name, 50) }}"
                    src="{{ asset('/') }}images/product/{{ $relatedProduct->image }}">
            </a>
            <div class="item-badge-wrapper">
                @foreach ($relatedProduct->productBadges as $badge)
                    <span style="background-color:{{ $badge->background }};color:{{ $badge->color }};"
                        class="item-badge">{{ $badge->name }}</span>
                @endforeach
            </div>
            <span class="{{ in_array($relatedProduct->id, $wishProducts) ? 'active' : '' }} add__wishlist ri-heart-fill"
                data-url="{{ route('wishlist.add') }}" data-id="{{ $relatedProduct->id }}"></span>
            @if (!$relatedProduct->inStock())
                <span class="stockout-btn">{{ $lng->OutOfStock }}</span>
            @endif
        </div>
        <div
            class="item-content cart-item-{{ $relatedProduct->id }} {{ array_key_exists($relatedProduct->id, $cartProducts) ? 'in-cart' : '' }}">
            <div class="item-price-ratings">
                <div class="item-price">
                    <span class="new-price">{{ App\Model\Product::currencyPrice($relatedProduct->price) }}</span>
                    @if ($relatedProduct->actualPrice() != $relatedProduct->price)
                        <span
                            class="old-price">{{ App\Model\Product::currencyPrice($relatedProduct->actualPrice()) }}</span>
                    @endif
                </div>
                <div class="ratings">
                    <div class="empty-stars"></div>
                    <div class="full-stars" style="width:{{ $relatedProduct->rating * 20 }}%"></div>
                </div>
            </div>
            <div class="item-title">
                <a
                    href="{{ route('front-product.show', $relatedProduct->slug) }}">{{ Str::limit($relatedProduct->name, 50) }}</a>
            </div>
            <div
                class="item-action cart-item-{{ $relatedProduct->id }} {{ array_key_exists($relatedProduct->id, $cartProducts) ? 'in-cart' : '' }}">
                <ul>
                    <li class="cart-button-wrapper-{{ $relatedProduct->id }} @if (!(count($relatedProduct->
                        options) == 0 && count($relatedProduct->colors) == 0 && count($relatedProduct->sizes) == 0) ||
                        !$relatedProduct->inStock()) w-100 @endif">
                        @if (!$relatedProduct->inStock())
                            <span class="sold-out-btn">{{ $lng->SoldOut }}</span>
                        @elseif(count($relatedProduct->options)==0&&count($relatedProduct->colors)==0&&count($relatedProduct->sizes)==0)
                            @if (array_key_exists($relatedProduct->id, $cartProducts))
                                <div class="product-count item-count">
                                    <div class="btn-minus" data-id="{{ $relatedProduct->id }}"
                                        data-row="{{ $cartProducts[$relatedProduct->id]['rowId'] }}">
                                        <button aria-label="substract" type="button" class="counter">
                                            <i class="ri-subtract-line"></i>
                                        </button>
                                    </div>
                                    <input type="text" readonly class="counter-field qty-{{ $cartProducts[$relatedProduct->id]['rowId'] }}"
                                        value="{{ $cartProducts[$relatedProduct->id]['qty'] }}">
                                    <div class="btn-plus" data-row="{{ $cartProducts[$relatedProduct->id]['rowId'] }}">
                                        <button aria-label="addition" type="button" class="counter counter-plus">
                                            <i class="ri-add-line"></i>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <span data-url="{{ route('cart.add') }}" data-id="{{ $relatedProduct->id }}"
                                    class="add__cart related">
                                    {{ $lng->AddToCart }}
                                </span>
                            @endif
                        @else
                            <span class="see-option-btn">
                                <a
                                    href="{{ route('front-product.show', $relatedProduct->slug) }}">{{ $lng->SeeOptions }}</a>
                            </span>
                        @endif
                    </li>
                    @if (count($relatedProduct->options) == 0 && count($relatedProduct->colors) == 0 && count($relatedProduct->sizes) == 0 && $relatedProduct->inStock())
                        <li>
                            @if (count($relatedProduct->options) == 0 && count($relatedProduct->colors) == 0 && count($relatedProduct->sizes) == 0 && $relatedProduct->inStock())
                                <span data-url="{{ route('cart.add') }}" data-id="{{ $relatedProduct->id }}"
                                    class="buy-btn related">
                                    <a href="#"> {{ $lng->BuyNow }}</a>
                                </span>
                            @endif
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
                                        
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pageScripts')
<script src="{{asset('front/js/vendor/slick.min.js')}}"></script>
<script src="{{asset('front/js/vendor/jquery-zoom.js')}}"></script> 
<script src="{{asset('front/js/page/product.js')}}"></script> 
<script>
        function updatePrice() {
            let size = "";
            let color = "";
            let optionIds = [];
            let optionValues = [];
            if ($('.color-product').length > 0) {
                color = $('.color-product:checked').data('val');
            }
            if ($('.size-product').length > 0) {
                size = $('.size-product:checked').data('val');
            }
            if ($('.option-input').length > 0) {
                optionIds = $(".option-input:checked").map(function() {
                    return $(this).data('id');
                }).get();
                optionValues = $(".option-input:checked").map(function() {
                    return $(this).data('val');
                }).get();
            }
            productId = "{{$product->id}}";
            url = "{{route('product.price')}}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    productId,
                    optionIds,
                    optionValues,
                    color,
                    size,
                    submit: true
                }
            }).always(function(data) {
                $("#product-price").html(data)
            });
        }
    </script>
@endsection