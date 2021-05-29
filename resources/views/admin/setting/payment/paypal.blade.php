@extends('layouts.admin',['headerText' => $lng->PaypalSetting])
@section('title', "$lng->PaypalSetting")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->PaypalSetting }}</a>
    </li>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ URL::to('admin/payment-setting/paypal-update') }}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item top-info-header">
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
                        <div class="d-flex align-items-center justify-content-between paymentGateway-status paypal">
                            <label class="mt-2">{{ $lng->Status }}</label>
                            <label class="ts-swich-label">
                                <input {{ $paymentSetting->is_paypal ? 'checked' : '' }} name="is_paypal" type="checkbox"
                                    class="switch ts-swich-input">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="form-group">
                        <label>{{ $lng->Mode }}<span>*</span></label>
                        <select name="paypal_mode" class="select2 form-control">
                            <option value="sandbox">{{ $lng->Sandbox }}</option>
                            <option {{ $paymentSetting->paypal_mode == 'live' ? 'selected' : '' }} value="live">
                                {{ $lng->Live }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>{{ $lng->APIKey }} <span>*</span></label>
                        <input value="{{ $paymentSetting->paypal_client }}" required value="" name="paypal_client"
                            type="text" class="form-control" placeholder="{{ $lng->APIKey }}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>{{ $lng->APISecret }} <span>*</span></label>
                        <input value="{{ $paymentSetting->paypal_secret }}" required value="" name="paypal_secret"
                            type="text" class="form-control" placeholder="{{ $lng->APISecret }}">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/vendor/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2({
                minimumResultsForSearch: -1
            });

        });

    </script>
@endsection
