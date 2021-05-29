@extends('layouts.admin',['headerText' => $lng->StripeSetting])
@section('title', "$lng->StripeSetting")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->StripeSetting }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ URL::to('admin/payment-setting/stripe-update') }}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="{{ route('payment-gateway.index') }}" class="list-btn">{{ $lng->SeeList }}</a>
                        </div>
                        <div class="align-self-end">
                            <input type="submit" value="{{ $lng->Save }}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-between paymentGateway-status">
                            <label class="mt-2">{{ $lng->Status }}</label>
                            <label class="ts-swich-label">
                                <input {{ $paymentSetting->is_stripe ? 'checked' : '' }} name="is_stripe" type="checkbox"
                                    class="switch ts-swich-input">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>{{ $lng->APIKey }}<span>*</span></label>
                        <input value="{{ $paymentSetting->stripe_key }}" required name="stripe_key" type="text"
                            class="form-control" placeholder="{{ $lng->APIKey }}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>{{ $lng->APISecret }} <span>*</span></label>
                        <input value="{{ $paymentSetting->stripe_secret }}" required name="stripe_secret" type="text"
                            class="form-control" placeholder="{{ $lng->APISecret }}">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
