@extends('layouts.admin',['headerText' => $lng->PaymentGatewayList])
@section('title', "$lng->PaymentGatewayList")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/dataTables.bootstrap4.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->PaymentGatewayList }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header">
                    <div class="d-flex">
                        <div>
                            @can('payment-gateway.create')
                                <a href="{{ route('payment-gateway.create') }}" class="submit-btn mr-3">
                                    {{ $lng->Add }}
                                </a>
                            @endcan
                        </div>
                        <div class="action-wrapper">
                            @can('payment-gateway.edit')
                                <select class="select2 mr-3 select-status-head"
                                    data-route="{{ URL::to('/admin/payment-gateway/multi') }}">
                                    <option value="">{{ $lng->Status }}</option>
                                    <option value="1">{{ $lng->Enabled }}</option>
                                    <option value="0">{{ $lng->Disabled }}</option>
                                </select>
                            @endcan
                            @can('payment-gateway.destroy')
                                <button class="trash-btn delete-button-head mr-3"
                                    data-route="{{ URL::to('/admin/payment-gateway/multi') }}">
                                    {{ $lng->Delete }}
                                </button>
                            @endcan
                        </div>
                    </div>
                    <div class="d-flex ">
                        <div class="data-table-search-box">
                            <input id="searchBox" type="text" placeholder="{{ $lng->Search }}" /><span> </span>
                        </div>
                        <div class="pl-3">
                            <select class="select2 form-control" id="pagelen">
                                <option value="10">10</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="-1">{{ $lng->All }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-table">
                    <div class="table-responsive">
                        <table class="table table-striped first" id="takwa-table">
                            <thead>
                                <tr>
                                    @canany(['payment-gateway.edit','payment-gateway.destroy'])
                                    <th>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                            <label for="checkboxPrimary0">
                                            </label>
                                        </div>
                                    </th>
                                    @endcanany
                                    <th>{{ $lng->Name }}</th>
                                    <th> {{ $lng->Details }} </th>
                                    @can('payment-gateway.create')
                                        <th> {{ $lng->Status }} </th>
                                    @endcan
                                    @canany(['payment-gateway.edit','payment-gateway.destroy'])
                                    <th>{{ $lng->Action }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('includes.scripts.admin.data-table', ['route' => 'payment-gateway.index','columns'=>[
    auth()->user()->can('payment-gateway.edit')||auth()->user()->can('payment-gateway.destroy')?
    [
    "name"=>'index',
    'order'=>'false'
    ]:null,
    [
    "name"=>'title',
    'order'=>'true'
    ],
    [
    "name"=>'details',
    'order'=>'true'
    ],
    auth()->user()->can('payment-gateway.edit')?
    [
    "name"=>'status',
    'order'=>'false'
    ]:null,
    auth()->user()->can('payment-gateway.edit')||auth()->user()->can('payment-gateway.destroy')?
    [
    "name"=>'action',
    'order'=>'false'
    ]:null,
    ]])
@endsection
