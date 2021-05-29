@extends('layouts.user')
@section('title', "$lng->ChangePassword")
@section('content')
<div class="user-panel-content-wrapper">
    <div class="main-content-wrapper changepassword-container">
        <h4 class="section-title">{{$lng->ChangePassword}}</h4>
        <form action="{{route('user.update-password')}}" method="POST" class="changePassword-form">
            @csrf         
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="oldpassword">{{$lng->OldPassword}}</label>
                        <input required type="password" class="form-control" id="oldpassword" name="old_password" placeholder="" />
                    </div>
                </div>  
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="password">{{$lng->NewPassword}}</label>
                        <input required type="password" class="form-control" id="password" name="password" placeholder="" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="confirmpassword">{{$lng->ConfirmPassword}}</label>
                        <input required type="password" class="form-control" id="confirmpassword" name="password_confirmation" placeholder="" />
                    </div>
                </div>
            </div>
            <div class="form-group mb-10">
                <input class="default-btn" type="submit" value="{{$lng->Save}}">
            </div>
        </form>
    </div>
</div>
@endsection