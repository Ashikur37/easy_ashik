@extends('layouts.admin',['headerText' => $lng->PaymentSetting])
@section('title', "$lng->PaymentSetting")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->PaymentSetting }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ URL::to('admin/payment-setting/general-update') }}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item top-info-header">
                        <div>
                            <a href="{{ route('payment-gateway.index') }}" class="list-btn">{{ $lng->SeeList }}</a>
                        </div>
                        <div>
                            <input type="submit" value="{{ $lng->Save }}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <div>
                            <label>{{ $lng->CashOnDelivery }}</label>
                            <div class="d-flex align-items-center justify-content-between CashOnDelivery-status">
                                <label class="mt-2">{{ $lng->Status }}</label>
                                <label class="ts-swich-label">
                                    <input {{ $paymentSetting->is_cod ? 'checked' : '' }} name="is_cod" type="checkbox"
                                        class="switch ts-swich-input">
                                    <span class="ts-swich-body"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="form-group">
                        <label>{{ $lng->Tax }} <span>*</span></label>
                        <input value="{{ $paymentSetting->tax }}" required value="" name="tax" type="text"
                            class="form-control" placeholder="Enter tax">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
