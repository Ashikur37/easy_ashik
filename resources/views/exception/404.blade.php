@extends('layouts.front')
@section('title', "$lng->_404NotFound")
@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col"><img src="{{asset('images/banner/'.$setting->banner_404)}}" alt="Not Found" /></div>
    </div>
</div>
@endsection