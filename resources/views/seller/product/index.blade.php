@extends('layouts.vendor',['headerText' => $lng->ProductList])
@section('title', "$lng->ProductList")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/dataTables.bootstrap4.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->ProductList }}</a> 
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header">
                    <div class="d-flex">
                        <div>
                            @can('product.create')
                                <a href="{{ route('product.create') }}" class="submit-btn mr-3">
                                    {{ $lng->Add }}
                                </a>
                            @endcan
                        </div>
                        <div class="action-wrapper">
                            @can('product.edit')
                                <select class="select2 select-status-head" data-route="{{ URL::to('/admin/product/multi') }}">
                                    <option value="">{{ $lng->Status }}</option>
                                    <option value="1">{{ $lng->Enabled }}</option>
                                    <option value="0">{{ $lng->Disabled }}</option>
                                </select>
                            @endcan
                            @can('product.destroy')
                                <button class="trash-btn delete-button-head mr-3"
                                    data-route="{{ URL::to('/admin/product/multi') }}">
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
                    <div class="responsive-table">
                        <table class="table table-striped first" id="takwa-table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                            <label for="checkboxPrimary0">
                                            </label>
                                        </div>
                                    </th>
                                    <th>Id</th>
                                    <th>{{ $lng->Image }}</th>
                                    <th> {{ $lng->Name }} </th>
                                    <th> {{ $lng->Price }} </th>
                                    <th> {{$lng->Quantity}} </th>
                                    <th>{{ $lng->Status }}</th>
                                    <th>{{ $lng->Created }}</th>
                                    <th>{{ $lng->Action }}</th>
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
    @include('includes.scripts.admin.data-table',
    ['route' => 'vendor.product_list','columns'=>[ 
    
    [
    "name"=>'index',
    'order'=>'false'
    ],
    [
    "name"=>'id',
    'order'=>'true'
    ],
    [
    "name"=>'image',
    'order'=>'false'
    ],
    [
    "name"=>'name',
    'order'=>'true'
    ],
    [
    "name"=>'selling_price',
    'order'=>'false',
    ],
    [
    "name"=>'qty',
    'order'=>'true',
    ],
    
    [
    "name"=>'status',
    'order'=>'false'
],
    [
    "name"=>'created',
    'order'=>'true'
    ],
    [
    "name"=>'action',
    'order'=>'false'
    ],
    ]])

@endsection
