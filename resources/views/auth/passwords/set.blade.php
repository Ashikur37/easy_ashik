@extends('layouts.front')
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/page/login.css">
@endsection
@section('content')
<div class="login__page">
    <div class="container ">
       <div class="row">
           <div class="col-md-4 white-bg offset-md-4 p-5 my-5">
            <a class="forget__link password-reset-btn" href="{{URL::to('password/reset')}}">Reset with email</a>
            <a class="forget__link password-reset-btn mt-15" href="{{URL::to('password/mobile')}}">Reset with mobile</a>
           </div>
       </div>
    </div>
</div>
@endsection

