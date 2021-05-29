@extends('layouts.admin',['headerText' => $lng->Services])
@section('title', "$lng->Services")

@section('style')

    
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/static.css">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->Services }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ URL::to('/admin/services') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            {{ $lng->Service1 }}
                        </div>
                        <div class="card-body"> 
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ $lng->ServiceTitle }} </label>
                                        <input type="text" name="service1_title" class="form-control" id=""
                                            value="{{ $setting->service1_title }}">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $lng->SubTitle }} </label>
                                        <input type="text" name="service1_sub_title" class="form-control" id=""
                                            value="{{ $setting->service1_sub_title }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0">{{ $lng->ServiceIcon }} </label>
                                        <a class="btn btn-link" href="https://remixicon.com/"
                                            target="_blank">{{ $lng->IconList }} </a>
                                        <input class="form-control" value="{{ $setting->service1_image }}" type="text"
                                            name="service1_image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="card">
                        <div class="card-header">
                            {{ $lng->Service2 }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ $lng->ServiceTitle }} </label>
                                        <input type="text" name="service2_title" class="form-control"
                                            value="{{ $setting->service2_title }}">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $lng->SubTitle }} </label>
                                        <input type="text" name="service2_sub_title" class="form-control" id=""
                                            value="{{ $setting->service2_sub_title }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0">{{ $lng->ServiceIcon }} </label>
                                        <a class="btn btn-link" href="https://remixicon.com/"
                                            target="_blank">{{ $lng->IconList }} </a>
                                        <input class="form-control" value="{{ $setting->service2_image }}" type="text"
                                            name="service2_image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="card">
                        <div class="card-header">
                            {{ $lng->Service3 }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ $lng->ServiceTitle }} </label>
                                        <input type="text" name="service3_title" class="form-control"
                                            value="{{ $setting->service3_title }}">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $lng->SubTitle }} </label>
                                        <input type="text" name="service3_sub_title" class="form-control" id=""
                                            value="{{ $setting->service3_sub_title }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0">{{ $lng->ServiceIcon }} </label>
                                        <a class="btn btn-link" href="https://remixicon.com/"
                                            target="_blank">{{ $lng->IconList }} </a>
                                        <input class="form-control" value="{{ $setting->service3_image }}" type="text"
                                            name="service3_image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="card">
                        <div class="card-header">
                            {{ $lng->Service4 }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ $lng->ServiceTitle }} </label>
                                        <input type="text" name="service4_title" class="form-control"
                                            value="{{ $setting->service4_title }}">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $lng->SubTitle }} </label>
                                        <input type="text" name="service4_sub_title" class="form-control" id=""
                                            value="{{ $setting->service4_sub_title }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0">{{ $lng->ServiceIcon }} </label>
                                        <a class="btn btn-link" href="https://remixicon.com/"
                                            target="_blank">{{ $lng->IconList }} </a>
                                        <input class="form-control" value="{{ $setting->service4_image }}" type="text"
                                            name="service4_image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-center mt-4">
                    <button class="submit-btn">{{ $lng->Save }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
