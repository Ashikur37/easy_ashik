@extends('layouts.admin',['headerText' => $lng->SEO])
@section('title', "$lng->SEO")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/static.css">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->SEO }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="social-link row">
            <div class="col-12">
                <form action="{{ URL::to('/admin/seo') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="flex-item">
                                    <label> {{ $lng->MetaKeywords }}</label>
                                </div>
                                <input type="text" class="form-control" name="meta_title"
                                    value="{{ $setting->meta_title }}" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="flex-item">
                                    <label> {{ $lng->MetaDescription }}</label>
                                </div>
                                <textarea name="meta_description" rows="8"
                                    class="form-control mr-4">{{ $setting->meta_description }}</textarea>
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
