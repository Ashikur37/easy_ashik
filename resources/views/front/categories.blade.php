@extends('layouts.front')
@section('title', "$lng->Categories") 
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/page/categories.css">
@endsection
@section('content')
<section class="category-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="category-wrapper">
                @foreach($categories as $category)
                    <div class="main-category">
                        <h3 class="category-name"><a href="{{route('category',[$category->slug])}}">{{$category->name}} <span>({{$category->products->count()}})</span></a></h3>
                        <ul class="sub-category">
                            @foreach($category->subCategories as $subCategory)
                            <li>
                                <a class="sub-category-name" href="{{route('category',[$category->slug,$subCategory->slug])}}">{{$subCategory->name}} <span>({{$subCategory->products->count()}})</span></a>
                                <ul>
                                    @foreach($subCategory->childCategories as $childCategory)
                                    <li>
                                        <a href="{{route('category',[$category->slug,$subCategory->slug,$childCategory->slug])}}"><i class="ri-arrow-right-s-line"></i>{{$childCategory->name}}<span>({{$childCategory->products->count()}})</span></a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
