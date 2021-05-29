@extends('layouts.admin',['headerText' => $lng->EditCurrency])
@section('title', "$lng->EditCurrency")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->EditCurrency}}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{route('currency.update',$currency->id)}}" >
            @method('patch')
           @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="{{route('currency.index')}}" class="list-btn">{{$lng->SeeList}}</a>
                        </div>
                       <div>
                            <input type="submit" value="{{$lng->Save}}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label >{{$lng->Name}} <span>*</span></label>
                        <input value="{{ $currency->name }}" name="name" required type="text" class="form-control" placeholder="{{$lng->Name}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label >{{$lng->CurrencySign}} </label>
                        <input required value="{{ $currency->sign }}"  name="sign" type="text" class="form-control" placeholder="{{$lng->CurrencySign}}">
                        @error('sign')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label >{{$lng->Rate}} <span>*</span></label>
                        <input step=".001" value="{{ $currency->rate }}" name="rate" required type="number" class="form-control" placeholder="{{$lng->Rate}}">
                        @error('rate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

