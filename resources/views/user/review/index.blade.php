@extends('layouts.user')
@section('title', "$lng->Reviews")
@section('content')
<div class="user-panel-content-wrapper">
    <div class="main-content-wrapper reviews-container">
        <h4 class="section-title bb-none">{{$lng->Reviews}}</h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="title-row">
                        <th scope="col">{{$lng->Product}}</th>
                        <th scope="col">{{$lng->Review}}</th>
                        <th scope="col">{{$lng->Action}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                    <tr class="reviews-row">
                        <td>
                            <a class="product-name" href="{{route('front-product.show',$review->product->slug)}}">
                                <img src="{{asset('images/product/'.$review->product->image)}}" alt="{{Str::limit($review->product->name,50)}}" />
                                {{Str::limit($review->product->name,50)}}</a>
                        </td>
                        <td>
                        <div class="review-text">
                            <div class="ratings">
                                <div class="empty-stars"></div>
                                <div class="full-stars" style="width:{{$review->rating*20}}%"></div>
                            </div>
                            <p>{{Str::limit($review->comment,50)}}</p>
                        </div>
                        </td>
                        <td>
                            <div class="icon-wrapper">
                                @if(!$review->product->inStock())
                                <i class="ri-shopping-bag-line add__cart"></i>
                                @elseif(count($review->product->options)==0)
                                <i data-url="{{route('cart.add')}}" data-id="{{$review->product->id}}" class="ri-shopping-bag-line add__cart"></i>
                                @elseif(count($review->product->options)>0)
                                <a href="{{route('front-product.show',$review->product->slug)}}">{{$lng->SeeOptions}}</a>
                                @endif
                                <i class="ri-delete-bin-line review__remove" data-url="{{route('review.remove')}}" data-id="{{$review->id}}"></i>
                            </div>
                        </td>
                    </tr>                            
                    @endforeach
                </tbody>
            </table>
        </div>          
        {!!$reviews->links()!!}
    </div>
</div>
@endsection
