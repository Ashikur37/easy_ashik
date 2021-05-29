@extends('layouts.admin',['headerText' => $lng->SocialLink])
@section('title', "$lng->SocialLink")

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/static.css">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->SocialLink }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="social-link row">
            <div class="col-12">
                <form action="{{ URL::to('/admin/social-link') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ $lng->Facebook }}</label>
                                <div class="flex-item">
                                    <input type="text" class="form-control" value="{{ $setting->facebook_link }}" name="facebook_link">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ $lng->Youtube }}</label>
                                <div class="flex-item">
                                    <input type="text" class="form-control" value="{{ $setting->youtube_link }}" name="youtube_link">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ $lng->Instagram }}</label>
                                <div class="flex-item">
                                    <input type="text" class="form-control" value="{{ $setting->instagram_link }}"
                                        name="instagram_link">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ $lng->Twitter }}</label>
                                <div class="flex-item">
                                    <input type="text" class="form-control" value="{{ $setting->skype_link }}"
                                        name="skype_link">
                                </div>
                            </div> 
                            <div class="form-group">
                                <label>{{ $lng->Pinterest }}</label>
                                <div class="flex-item">
                                    <input type="text" class="form-control" value="{{ $setting->pinterest_link }}"
                                        name="pinterest_link">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3 text-center">
                            <button class="submit-btn">{{ $lng->Save }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
