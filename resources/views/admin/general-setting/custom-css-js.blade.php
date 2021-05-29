@extends('layouts.admin',['headerText' => $lng->CustomCssJs])
@section('title', "$lng->CustomCssJs")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/static.css">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->CustomCssJs }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="social-link row">

            <div class="col-12">
                <form action="{{ URL::to('/admin/custom-css-js') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ $lng->Header }}</label>
                                <textarea name="custom_css" rows="8"
                                    class="form-control">{{ $setting->custom_css }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ $lng->Footer }}</label>
                                <textarea name="custom_js" rows="8"
                                    class="form-control">{{ $setting->custom_js }}</textarea>
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
