@extends('layouts.admin',['headerText' => $lng->WithdrawList])
@section('title', "$lng->WithdrawList")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->WithdrawList }}</a>
    </li>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/dataTables.bootstrap4.min.css">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header">
                    <div class="d-flex">
                        <div class="action-wrapper">
                            @can('withdraw.update')
                                <select class="select2 mr-3 select-status-head"
                                    data-route="{{ URL::to('/admin/withdraw/multi') }}">
                                    <option value="">{{ $lng->Status }}</option>
                                    <option value="0">{{ $lng->Unpaid }}</option>
                                    <option value="1">{{ $lng->Paid }}</option>
                                </select>
                            @endcan
                            @can('withdraw.destroy')
                                <button class="trash-btn delete-button-head mr-3"
                                    data-route="{{ URL::to('/admin/withdraw/multi') }}">
                                    {{ $lng->Delete }}
                                </button>
                            @endcan
                        </div>
                    </div>
                    <div class="d-flex ">
                        <div class="data-table-search-box">
                            <input id="searchBox" type="text" placeholder="Search..." />
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
                                    @canany(['withdraw.edit','withdraw.destroy'])
                                    <th>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                            <label for="checkboxPrimary0">
                                            </label>
                                        </div>
                                    </th>
                                    @endcanany
                                    <th>{{ $lng->Name }}</th>
                                    <th>{{ $lng->Amount }}</th>
                                    <th>{{ $lng->PaymentMethod }}</th>
                                    <th>{{ $lng->Details }}</th>
                                    <th>{{ $lng->Reference }}</th>
                                    @can('withdraw.update')
                                        <th>{{ $lng->Status }}</th>
                                    @endcan
                                    @canany(['withdraw.update','withdraw.destroy'])
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
    @include('includes.scripts.admin.data-table', ['route' => 'withdraw.index','columns'=>[
    auth()->user()->can('withdraw.edit')||auth()->user()->can('withdraw.destroy')?
    [
    "name"=>'index',
    'order'=>'false'
    ]:null,
    [
    "name"=>'name',
    'order'=>'true'
    ],
    [
    "name"=>'amount',
    'order'=>'true'
    ],
    [
    "name"=>'method',
    'order'=>'true'
    ],
    [
    "name"=>'detail',
    'order'=>'true'
    ],
    [
    "name"=>'reference',
    'order'=>'false'
    ],
    auth()->user()->can('withdraw.update')?
    [
    "name"=>'status',
    'order'=>'false'
    ]:null,
    auth()->user()->can('withdraw.update')||auth()->user()->can('withdraw.destroy')?
    [
    "name"=>'action',
    'order'=>'false'
    ]:null,
    ]])
@endsection
