@extends('layouts.admin',['headerText' => $lng->ContactUs])
@section('title', "$lng->ContactUs")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/static.css">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->ContactUs }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="social-link row">
            <div class="col-12">
                <form action="{{ URL::to('/admin/contact-setting') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>{{ $lng->Address }}</label>
                                        <textarea name="address2" class="form-control"
                                            rows="5">{{ $setting->address2 }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $lng->Mail }}</label>
                                        <input name="mail1" value="{{ $setting->mail1 }}" class="form-control" type="text"
                                            placeholder="{{ $lng->Mail }} 1">
                                        <input name="mail2" value="{{ $setting->mail2 }}" class="form-control mt-3"
                                            type="text" placeholder="{{ $lng->Mail }} 2({{ $lng->Optional }})">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $lng->PhoneNumber }}</label>
                                        <input name="phone1" value="{{ $setting->phone1 }}" class="form-control" type="text"
                                            placeholder="{{ $lng->PhoneNumber }} 1">
                                        <input name="phone2" value="{{ $setting->phone2 }}" class="form-control mt-3"
                                            type="text" placeholder="{{ $lng->PhoneNumber }} 2({{ $lng->Optional }})">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mt-4 mt-md-0">
                            <div class="card">
                                <div class="card-header">
                                    <div class="flex-item">
                                        <h5>{{ $lng->LocationMap }}</h5>
                                        <label class="ts-swich-label">
                                            <input name="is_map" {{ $setting->is_map ? 'checked' : '' }} type="checkbox"
                                                class="switch ts-swich-input" value="#">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>{{ $lng->Latitude }}</label>
                                        <input name="lat" value="{{ $setting->lat }}" class="form-control" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $lng->Longitude }}</label>
                                        <input name="lon" value="{{ $setting->lon }}" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4 text-center">
                            <button class="submit-btn">{{ $lng->Save }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
