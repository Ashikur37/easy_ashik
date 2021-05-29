@extends('layouts.admin',['headerText' => $lng->CreateColor])
@section('title', "$lng->CreateColor")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->AddColor}}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form   method="post" action="{{route('color.store')}}"  >
           @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="{{route('color.index')}}" class="list-btn">{{$lng->SeeList}}</a>
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
                    <input value="{{ old('name') }}" name="name" required type="text" class="form-control" placeholder="{{$lng->EnterColorName}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Color </label>
                        <br>
                        <input  name="code" value="#ffffff" type="color" class="ts-color-pickr">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

