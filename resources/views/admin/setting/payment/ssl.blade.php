@extends('layouts.admin',['headerText' => "SSL Commerz"])
@section('title', "SSL Commerz")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">SSL Commerz</a>
    </li>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ URL::to('admin/payment-setting/ssl-commerz-update') }}">
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
                                <input {{ $paymentSetting->is_ssl ? 'checked' : '' }} name="is_ssl" type="checkbox"
                                    class="switch ts-swich-input">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="form-group">
                        <label>{{ $lng->Mode }}<span>*</span></label>
                        <select name="ssl_mode" class="select2 form-control">
                            <option value="sandbox">{{ $lng->Sandbox }}</option>
                            <option {{ $paymentSetting->ssl_mode == 'live' ? 'selected' : '' }} value="live">
                                {{ $lng->Live }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Store ID <span>*</span></label>
                        <input value="{{ $paymentSetting->store_id }}" required value="" name="store_id"
                            type="text" class="form-control" placeholder="Store ID">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Password <span>*</span></label>
                        <input value="{{ $paymentSetting->store_password }}" required value="" name="store_password"
                            type="text" class="form-control" placeholder="Password">
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
