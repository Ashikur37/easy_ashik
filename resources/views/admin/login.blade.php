@extends('layouts.front')
@section('title', "$lng->AdminLogin")
@section('pageStyle')
    <link rel="stylesheet" href="{{ asset('front') }}/css/page/login.css">
@endsection
@section('content')
    <div class="login__page ">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="login-box white-bg">
                        <div class="row">
                            <div class="col-12 px-4">
                                <div class="email-login-box">
                                    <div class="title">{{ $lng->Login }}</div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">{{ $lng->Email }} *</label>
                                            <input required name="email" type="email" @if (Session::has('old_email')) value="{{ Session::get('old_email') }}" @endif class="form-control" id="email"
                                                placeholder="{{ $lng->Email }}" />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">{{ $lng->Password }} *</label>
                                            <div class="show-password-wrap">
                                            <input required name="password" type="password" class="form-control"
                                                id="password" placeholder="{{ $lng->Password }}" />
                                        <span> 
                                           <i class="ri-eye-line" onclick="showPass()"></i>
                                       </span>
                                       </div>
                                        <script >
                                           function showPass(){
                                               if(document.getElementById("password").type=="password"){
                                                   document.getElementById("password").type="text";
                                                   
                                               }
                                               else{
                                                   document.getElementById("password").type="password";
                                                   
                                               }
                                               
                                           }
                                        </script>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        @if (Session::has('error'))
                                            <div class="alert alert-danger">
                                                {{ Session::get('error') }}
                                            </div>
                                        @endif
                                        <div class="forget-password-row">
                                            <div class="form-group custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember">
                                                    <span class="box"></span>
                                                    {{ $lng->RememberMe }}
                                                </label>
                                            </div>
                                            <div class="forget">
                                                <a class="forget__link"
                                                    href="{{ URL::to('password/reset') }}">{{ $lng->ForgotPassword }} ?</a>
                                            </div>
                                        </div>
                                        <input class="default-btn login__btn" type="submit" value="Login" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
