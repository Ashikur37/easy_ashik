@extends('layouts.front')
@section('title', "$lng->FAQ")
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/page/faq.css">
@endsection
@section('content')
<div class="faq-page white-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 white-bg">
                <h2 class="header-title">{{$lng->FrequentlyAskedQuestion}}</h2>
            </div>
        </div>
    </div>
    <div class="faq-wrapper">
        <div class="container">
            @foreach($faqs as $faq)
            <div class="row">
                <div class="col-md-10 offset-md-1 white-bg pb-20">
                    <div class="faq-box">
                        <div class="title">
                            {{$faq->title}}
                        </div>
                        <div class="description">
                            <p>{{$faq->details}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection