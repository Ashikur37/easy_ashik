@extends('layouts.front')
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/page/login.css">
@endsection
@section('content')
<div class="login__page">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-10 offset-xl-2 offset-lg-1">
                <div class="login-box white-bg">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="email-login-box">
                                <div class="title">{{$lng->Login}}</div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Phone *</label>
                                        <input required name="email" type="text" @if(Session::has('old_email')) value="{{ Session::get('old_email') }}" @endif class="form-control" id="email" placeholder=" Phone Number" />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{$lng->Password}} *</label>
                                      <div class="show-password-wrap position-r">
                                            <input required name="password" type="password" class="form-control" id="password" placeholder="{{$lng->Password}}" />
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
                                    @if(Session::has('error'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('error') }}
                                    </div>
                                    @endif
                                    <div class="forget-password-row">    
                                        <div class="form-group custom-checkbox">
                                            <label>
                                                <input type="checkbox" name="remember">
                                                <span class="box"></span>
                                                {{$lng->RememberMe}}
                                            </label>
                                        </div>
                                        <div class="forget">
                                            <a class="forget__link" href="{{URL::to('password/select')}}">{{$lng->ForgotPassword}} ?</a>
                                        </div>
                                    </div>
                                    <input class="default-btn login__btn" type="submit" value="Login" />
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 create-account-section">
                            <div class="create-account-box">
                                <div class="title color-white">{{$lng->CreateAccount}}</div>
                                <a class="mail__address" href="{{route('register')}}">
                                    <i class="ri-mail-fill"></i>
                                    <span>Continue With  Mobile</span>
                                </a>                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection