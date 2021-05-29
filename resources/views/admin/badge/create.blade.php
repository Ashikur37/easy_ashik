@extends('layouts.admin',['headerText' => $lng->AddBadge])
@section('title', "$lng->AddBadge")
@section('style')
 <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="{{route('badge.create',1)}}">{{$lng->CreateBadge}}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form  method="post" action="{{route('badge.store')}}">
           @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="{{route('badge.index')}}" class="list-btn">{{$lng->SeeList}}</a>
                        </div>
                        <div>
                        <input type="submit" value="{{$lng->Save}}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{$lng->Name}} <span>*</span></label>
                        <input id="badge-name" value="{{ old('name') }}" name="name" required type="text" class="form-control" placeholder="{{$lng->EnterBadgeName}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{$lng->Status}} </label>
                        <select name="status" class="select2 form-control">
                            <option value="1">{{$lng->Enabled}}</option>
                            <option value="0">{{$lng->Disabled}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">{{$lng->TextColor}} </label>
                        <br>
                        <input id="badge-color" name="color" value="#ffffff" type="color" class="ts-color-pickr">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">{{$lng->BackgroundColor}} </label>
                        <br>
                        <input id="badge-background" name="background" value="#3772fb" type="color" class="ts-color-pickr">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="">{{$lng->BadgePreview}}</label>
                        <br>
                        <span class="ts-badge-preview">
                            {{$lng->Badge}}
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
<script src="{{asset('assets/admin/js/vendor/select2.full.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/page/badge.js') }}"></script>
@endsection

