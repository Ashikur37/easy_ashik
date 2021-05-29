@extends('layouts.admin',['headerText' =>"Vendor List"])
@section('title', "Vendor List")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/dataTables.bootstrap4.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">Vendor List</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header">
                    <div class="d-flex">
                        <div>
                            
                        </div>
                        <div class="action-wrapper">
                            @can('page.edit')
                                <select class="select2 mr-3 select-status-head" data-route="{{ URL::to('/admin/page/multi') }}">
                                    <option value="">{{ $lng->Status }}</option>
                                    <option value="1">{{ $lng->Enabled }}</option>
                                    <option value="0">{{ $lng->Disabled }}</option>
                                </select>
                            @endcan
                            @can('page.destroy')
                                <button class="trash-btn delete-button-head mr-3"
                                    data-route="{{ URL::to('/admin/page/multi') }}">
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
                                    <th>Store Name</th>
                                    <th>Name</th>
                                    <th>Email/Phone</th>
                                    <th>Contact Number</th>
                                    <th>Address</th>
                                    <th>Product Type</th>
                                    <th>NID/Trade</th>
                                    <th>Dealing System</th>
                                    <th>Mobile Banking No</th>
                                    <th>Mobile Bank Type</th>
                                    <th>Mobile Bank System</th>
                                    <th>Bank Account</th>
                                    <th>Bank Name</th>
                                    <th>Branch</th>
                                    <th>Status</th>
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
    @include('includes.scripts.admin.data-table', ['route' => 'vendor.index','columns'=>[
    [
    "name"=>'store_name',
    'order'=>'true'
    ],
    [
    "name"=>'user.name',
    'order'=>'true'
    ],
    [
    "name"=>'user.email',
    'order'=>'true'
    ],
    [
    "name"=>'phone',
    'order'=>'true'
    ], 
    [
    "name"=>'address',
    'order'=>'true'
    ], 
    [
    "name"=>'product_type',
    'order'=>'true'
    ], 
    [
    "name"=>'nid_trade',
    'order'=>'true'
    ], 
    [
    "name"=>'dealing_system',
    'order'=>'true'
    ], 
    [
    "name"=>'mobile_banking_no',
    'order'=>'true'
    ], 
    [
    "name"=>'mobile_bank_type',
    'order'=>'true'
    ],
    [
    "name"=>'mobile_bank_system',
    'order'=>'true'
    ],  
    [
    "name"=>'bank_account_no',
    'order'=>'true'
    ], 
    [
    "name"=>'bank_name',
    'order'=>'true'
    ], 
    [
    "name"=>'branch',
    'order'=>'true'
    ], 
    [
    "name"=>'status',
    'order'=>'true'
    ],
    
    ]])
@endsection
