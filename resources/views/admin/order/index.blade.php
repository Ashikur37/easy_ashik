@extends('layouts.admin',['headerText' => $lng->OrderList])
@section('title', "$lng->OrderList")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/dataTables.bootstrap4.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->OrderList }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header">
                    <div class="d-flex">
                        <div class=""></div>
                        <div class="action-wrapper">
                            @can('order.edit')
                                <select id='status-dropdown' class='select2 mr-3 select-status-head'
                                    data-route="{{ URL::to('/admin/order/multi') }}">
                                    <option value='0'>{{ $lng->Pending }}</option>
                                    <option value='1'>{{ $lng->Processing }}</option>
                                    <option value='2'>{{ $lng->OnHold }}</option>
                                    <option value='3'>{{ $lng->Completed }}</option>
                                    <option value='4'>{{ $lng->OnDelivery }}</option>
                                    <option value='5'>{{ $lng->Refunded }}</option>
                                    <option value='6'>{{ $lng->Canceled }}</option>
                                </select>
                            @endcan
                            @can('order.destroy')
                                <button class="trash-btn delete-button-head mr-3"
                                    data-route="{{ URL::to('/admin/order/multi') }}">
                                    {{ $lng->Delete }}
                                </button>
                            @endcan
                        </div>
                    </div>
                    <div class="d-flex ">
                        <div class="data-table-search-box">
                            <input id="searchBox" type="text" placeholder="Search..." /><span> </span>
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
                                    @canany(['order.edit','order.destroy'])
                                    <th>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                            <label for="checkboxPrimary0">
                                            </label>
                                        </div>
                                    </th>
                                    @endcanany
                                    <th>{{ $lng->Id }}</th>
                                    <th>{{ $lng->Customer }}</th>
                                    <th>{{ $lng->Details }}</th>
                                    <th>{{ $lng->Status }}</th>
                                    @can('order.edit')
                                        <th>{{ $lng->Payment }}</th>
                                    @endcan
                                    @canany(['order.edit','order.destroy'])
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
    <script src="{{ asset('assets/admin/js/vendor/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2({
                minimumResultsForSearch: -1
            });
        })
    </script>
    @include('includes.scripts.admin.order-table',
    ['route' => 'order.index','columns'=>[
    auth()->user()->can('order.edit')||auth()->user()->can('order.destroy')?
    [
    "name"=>'index',
    'order'=>'false'
    ]:null,
    [
    "name"=>'order_number',
    'order'=>'true'
    ],
    [
    "name"=>'customer_name',
    'order'=>'true'
    ],
    [
    "name"=>'details',
    'order'=>'true'
    ],
    [
    "name"=>'status_text',
    'order'=>'true'
    ],
    auth()->user()->can('order.edit')?
    [
    "name"=>'payment_status',
    'order'=>'false'
    ]:null,
    auth()->user()->can('order.edit')||auth()->user()->can('order.destroy')?
    [
    "name"=>'action',
    'order'=>'false'
    ]:null,
    ]])
@endsection
