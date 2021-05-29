@extends('layouts.admin',['headerText' => $lng->CustomerList])
@section('title', "$lng->CustomerList")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->CustomerList}}</a>
    </li>
@endsection
@section('style')
<link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
<link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/dataTables.bootstrap4.min.css">
@endsection
@section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="flex-item top-info-header">
                        <div class="d-flex">
                            <div class="action-wrapper">
                                @can('customer.edit')
                                   <select class="select2 mr-3 select-status-head" data-route="{{URL::to('/admin/customer/multi')}}">
                                       <option value="">{{$lng->Status}}</option>
                                   <option value="0">{{$lng->Unblock}}</option>
                                   <option value="1">{{$lng->Block}}</option>
                                   </select>
                                @endcan
                               @can('customer.destroy')
                                   <button class="trash-btn delete-button-head mr-3" data-route="{{URL::to('/admin/customer/multi')}}">
                                           {{$lng->Delete}}
                                    </button>
                               @endcan
                               </div>
                        </div>
                        <div class="d-flex ">
                            <div class="data-table-search-box">
                                <input id="searchBox" type="text" placeholder="Search..." /><span> </span>
                            </div>
                            <div class="pl-3">
                                <select class="select2 form-control" id="pagelen" >
                                    <option value="10">10</option>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                    <option value="-1">{{$lng->All}}</option>
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
                                        @canany(['customer.edit','customer.destroy'])
                                        <th>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                                <label for="checkboxPrimary0">
                                                </label>
                                            </div>
                                        </th>
                                        @endcanany
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Balance</th>
                                        @can('customer.edit')
                                        <th>Block</th>
                                        @endcan
                                        @canany(['customer.edit','customer.destroy'])
                                        <th>{{$lng->Action}}</th>
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
        @include('includes.scripts.admin.data-table', ['route' => 'customer.index','columns'=>[
            auth()->user()->can('customer.edit')||auth()->user()->can('customer.destroy')?
            [
                "name"=>'index',
                'order'=>'false'
            ]:null,
            [
                "name"=>'name',
                'order'=>'true'
            ],
            [
                "name"=>'lastname',
                'order'=>'true'
            ],
            [
                "name"=>'email',
                'order'=>'true'
            ],
            [
                "name"=>'affiliate_balance',
                'order'=>'true'
            ],
            auth()->user()->can('customer.edit')?
            [
                "name"=>'status',
                'order'=>'false'
            ]:null,
            auth()->user()->can('customer.edit')||auth()->user()->can('customer.destroy')?
            [
                "name"=>'action',
                'order'=>'false'
            ]:null,
        ]])
    @endsection
