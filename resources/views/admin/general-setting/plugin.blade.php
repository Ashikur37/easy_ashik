@extends('layouts.admin',['headerText' => $lng->Plugin])
@section('title', "$lng->Plugin")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/static.css">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->Plugin }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="social-link row">
            <div class="col-12">
                <form action="{{ URL::to('/admin/plugin') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="flex-item">
                                    <label> {{ $lng->GoogleAnalyticsScript }}</label>
                                    <label class="ts-swich-label mb-10">
                                        <input {{ $setting->is_analytic == 1 ? 'checked' : '' }} type="checkbox"
                                            class="switch ts-swich-input" name="is_analytic">
                                        <span class="ts-swich-body"></span>
                                    </label>
                                </div>
                                <textarea name="google_analytic" rows="8"
                                    class="form-control mr-4">{{ $setting->google_analytic }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4 mt-md-0">
                            <div class="form-group">
                                <div class="flex-item">
                                    <label> {{ $lng->FacebookPixels }}</label>
                                    <label class="ts-swich-label mb-10">
                                        <input {{ $setting->is_pixel == 1 ? 'checked' : '' }} name="is_pixel"
                                            type="checkbox" class="switch ts-swich-input">
                                        <span class="ts-swich-body"></span>
                                    </label>
                                </div>
                                <textarea name="facebook_pixel" rows="8"
                                    class="form-control mr-4">{{ $setting->facebook_pixel }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <div class="flex-item">
                                    <label>{{ $lng->Messenger }} </label>
                                    <label class="ts-swich-label mb-10">
                                        <input {{ $setting->is_messenger == 1 ? 'checked' : '' }} name="is_messenger"
                                            type="checkbox" class="switch ts-swich-input">
                                        <span class="ts-swich-body"></span>
                                    </label>
                                </div>
                                <textarea name="messenger" rows="8"
                                    class="form-control mr-4">{{ $setting->messenger }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <div class="flex-item">
                                    <label> {{ $lng->TawkTo }}</label>
                                    <label class="ts-swich-label mb-10">
                                        <input {{ $setting->is_tawk_to == 1 ? 'checked' : '' }} type="checkbox"
                                            class="switch ts-swich-input" name="is_tawk_to">
                                        <span class="ts-swich-body"></span>
                                    </label>
                                </div>
                                <textarea name="tawk_to" rows="8"
                                    class="form-control mr-4">{{ $setting->is_tawk_to }}</textarea>
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
