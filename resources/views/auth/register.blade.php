@extends('layouts.front')
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/page/register.css">
@endsection
@section('content')
<div class="register__page">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-12 offset-xl-2">
                <div class="register-box white-bg">
                    <div class="register-title">{{$lng->Register}}</div>
                    <div class="register-form">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{$lng->FirstName}} *</label>
                                        <input value="{{old('name')}}" name="name" type="text" class="form-control" id="name" placeholder="{{$lng->FirstName}}" required />
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{$lng->LastName}} *</label>
                                        <input value="{{old('lastname')}}" name="lastname" type="text" class="form-control" id="name" placeholder="{{$lng->LastName}}" required />
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email/Phone *</label>
                                        <input value="{{old('email')}}" name="email" type="text" class="form-control" id="email" placeholder="Email address or Phone number" required />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">{{$lng->Password}} *</label>
                                        <input name="password" type="password" class="form-control" id="password" placeholder="{{$lng->Password}}" required />
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirmPassword">{{$lng->ConfirmPassword}} *</label>
                                        <input name="password_confirmation" type="password" class="form-control" id="confirmPassword" placeholder="{{$lng->ConfirmPassword}}" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if($setting->is_captcha)
                                    <div class="form-group captcha-group">
                                        @captcha
                                        <input required class="form-control" type="text" id="captcha" name="captcha" placeholder="{{$lng->EnterCaptcha}}">
                                        @error('captcha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row flex-md-row flex-column-reverse">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="login-button-div">
                                            <span>{{$lng->AlreadyHaveAccount}}?</span>
                                            <a class="login-btn" href="{{route('login')}}">{{$lng->Login}}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="default-btn submit-btn" type="submit" value="{{$lng->CreateAccount}}" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection