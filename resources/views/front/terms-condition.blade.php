@extends('layouts.front')
@section('title', "$lng->TermsAndCondition")
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/page/aboutus.css">
@endsection
@section('content')
<div class="terms-condition-page white-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 mb-20 white-bg">
                <h2 class="header-title">{{$setting->term_title}}</h2>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 mb-20 white-bg pt-20 pb-20">
                    {!!$setting->term_description!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection