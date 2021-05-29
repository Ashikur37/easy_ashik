@extends('layouts.admin',['headerText' => $lng->EditShippingMethod])
@section('title', "$lng->EditShippingMethod")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->EditShippingMethod }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ route('shipping-method.update', $shippingMethod->id) }}">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-12">
                    <div class="flex-item top-info-header">
                        <div>
                            <a href="{{ route('shipping-method.index') }}" class="list-btn">See list</a>
                        </div>
                        <div>
                            <input type="submit" value="{{ $lng->Save }}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->Name }} <span>*</span></label>
                        <input value="{{ $shippingMethod->name }}" name="name" required type="text" class="form-control"
                            placeholder="Shipping method name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->Price }} <span>*</span></label>
                        <input step=".01" value="{{ $shippingMethod->price }}" name="price" required type="number" class="form-control"
                            placeholder="Shipping method price">
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->MinimumAmountForFreeShiping }} </label>
                        <input value="{{ $shippingMethod->free_min }}" name="free_min" required type="text"
                            class="form-control" placeholder="{{ $lng->MinimumAmountForFreeShiping }}">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
