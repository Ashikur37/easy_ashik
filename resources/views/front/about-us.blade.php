@extends('layouts.front')
@section('title', "$lng->AboutUs")
@section('pageStyle')
    <link rel="stylesheet" href="{{ asset('front') }}/css/page/aboutus.css">
@endsection
@section('content')
    <div class="about__us__page white-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 white-bg">
                    <h2 class="header-title">{{ $setting->about_title }}</h2>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1 white-bg p-20">
                        {!! $setting->about_description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
