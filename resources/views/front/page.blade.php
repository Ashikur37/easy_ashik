@extends('layouts.front')
@section('title', "$page->name")
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/page/aboutus.css">
@endsection
@section('content')
<section class="custom-page white-bg">
    <div class="container">
       <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="content-wrapper"> {!!$page->body!!}</div>
            </div>
       </div>
    </div>
</section>
@endsection