@extends('layouts.user')
@section('title', "$lng->WishList")
@section('content')
<div class="user-panel-content-wrapper">
    <div class="main-content-wrapper wishlist-container">
        <h4 class="section-title bb-none"> {{$lng->MyWishList}}</h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="title-row">
                        <th scope="col">{{$lng->Product}}</th>
                        <th scope="col">{{$lng->Price}}</th>
                        <th scope="col">{{$lng->Status}}</th>
                        <th scope="col">{{$lng->Action}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            <div class="product-wrapper">
                                <img src="{{asset('images/product/'.$product->image)}}" alt="{{Str::limit($product->name,50)}}" />
                                <a class="product-name" href="{{route('front-product.show',$product->slug)}}">
                                    {{Str::limit($product->name,50)}}
                                </a>
                            </div>
                        </td>
                        <td><span>{{App\Model\Product::currencyPrice($product->price)}}</span></td>
                        <td>
                            @if($product->inStock())
                            <span class="status-badge success">{{$lng->InStock}}</span>
                            @else
                            <span class="status-badge danger">{{$lng->OutOfStock}}</span>
                            @endif
                        </td>
                        <td>
                            <div class="icon-wrapper">
                                @if(!$product->inStock())
                                <i class="ri-shopping-bag-line add__cart__out"></i>
                                @elseif(count($product->options)==0)
                                <i data-url="{{route('cart.add')}}" data-id="{{$product->id}}" class="ri-shopping-bag-line  add__cart"></i>
                                @elseif(count($product->options)>0)
                                <a href="{{route('front-product.show',$product->slug)}}"><i class="ri-shopping-bag-line"></i></a>
                                @endif
                                <i class="ri-delete-bin-line wishlist__remove" data-url="{{route('wishlist.remove')}}" data-id="{{$product->id}}"></i>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="md-wishlist-wrapper">
            @foreach($products as $product)
            <div class="md-wishlist-row">
                <a href="#" class="left">
                    <img src="{{asset('images/product/'.$product->image)}}" alt=" {{Str::limit($product->name,50)}}" />
                    <div class="md-product-wrapper">
                        <p class="product-name">
                            {{Str::limit($product->name,50)}}
                        </p>
                        <div class="price-status">
                            <span>{{App\Model\Product::currencyPrice($product->price)}}</span>
                            @if($product->inStock())
                            <span class="status-badge success">{{$lng->InStock}}</span>
                            @else
                            <span class="status-badge danger">{{$lng->SoldOut}}</span>
                            @endif
                        </div>
                    </div>
                </a>
                <div class="right">
                    <div class="md-icon-wrapper">
                        @if(!$product->inStock())
                        <i class="ri-shopping-bag-line  add__cart__out"></i>
                        @elseif(count($product->options)==0)
                        <i data-url="{{route('cart.add')}}" data-id="{{$product->id}}" class="ri-shopping-bag-line  add__cart"></i>
                        @elseif(count($product->options)>0)
                        <a href="{{route('front-product.show',$product->slug)}}"><i class="ri-shopping-bag-line"></i></a>
                        @endif
                        <i class="ri-delete-bin-line wishlist__remove" data-url="{{route('wishlist.remove')}}" data-id="{{$product->id}}"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {!!$products->links()!!}
    </div>
</div>
@endsection
