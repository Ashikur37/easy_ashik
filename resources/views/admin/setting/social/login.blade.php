@extends('layouts.admin',['headerText' => $lng->SocialLogin])
@section('title', "$lng->SocialLogin")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->SocialLogin }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ URL::to('admin/social-setting/social-login-update') }}">
            @csrf
            <div class="row"> 
                <div class="col-md-6">               
                    <div class="col-12">
                        <h4 class="mb-3">{{ $lng->FacebookLoginSetting }}</h4>
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <label>{{ $lng->Status }}</label>
                                <label class="ts-swich-label">
                                    <input {{ $socialSetting->is_facebook ? 'checked' : '' }} name="is_facebook" type="checkbox"
                                        class="switch ts-swich-input">
                                    <span class="ts-swich-body"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>{{ $lng->ApiId }} <span>*</span></label>
                            <input value="{{ $socialSetting->facebook_client_id }}" required name="facebook_client_id"
                                type="text" class="form-control" placeholder="{{ $lng->ApiId }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>{{ $lng->APISecret }} <span>*</span></label>
                            <input value="{{ $socialSetting->facebook_client_secret }}" required name="facebook_client_secret"
                                type="text" class="form-control" placeholder="{{ $lng->APISecret }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>{{ $lng->RedirectURL }} </label>
                            <input value="{{ URL::to('/oauth/facebook/callback') }}" disabled type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-12">
                        <h4 class="mb-3">{{ $lng->GoogleLoginSetting }}</h4>
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <label>{{ $lng->Status }}</label>
                                <label class="ts-swich-label">
                                    <input {{ $socialSetting->is_google ? 'checked' : '' }} name="is_google" type="checkbox"
                                        class="switch ts-swich-input">
                                    <span class="ts-swich-body"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>{{ $lng->ApiId }} <span>*</span></label>
                            <input value="{{ $socialSetting->google_client_id }}" required name="google_client_id" type="text"
                                class="form-control" placeholder="{{ $lng->ApiId }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>{{ $lng->APISecret }} <span>*</span></label>
                            <input value="{{ $socialSetting->google_client_secret }}" required name="google_client_secret"
                                type="text" class="form-control" placeholder="{{ $lng->APISecret }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>{{ $lng->RedirectURL }} </label>
                            <input value="{{ URL::to('/oauth/google/callback') }}" disabled type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3 text-center">
                    <button class="submit-btn">{{ $lng->Save }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
