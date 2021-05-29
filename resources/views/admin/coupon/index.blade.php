@extends('layouts.admin',['headerText' => $lng->CouponList])
@section('title', "$lng->CouponList")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->CouponList}}</a>
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
                            <div>
                                @can('coupon.create')
                                <a href="{{route('coupon.create')}}" class="submit-btn mr-3">
                                    {{$lng->Add}}
                                </a>
                                @endcan
                            </div>
                            <div class="action-wrapper">
                                @can('coupon.edit')
                                <select class="select2 mr-3 select-status-head" data-route="{{URL::to('/admin/coupon/multi')}}">
                                    <option value="">{{$lng->Status}}</option>
                                    <option value="1">{{$lng->Enabled}}</option>
                                    <option value="0">{{$lng->Disabled}}</option>
                                </select>
                                @endcan
                                @can('coupon.destroy')
                                <button class="trash-btn delete-button-head mr-3" data-route="{{URL::to('/admin/coupon/multi')}}">
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
                                    <option value="-1">All</option>
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
                                        @canany(['coupon.edit','coupon.destroy'])
                                        <th>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                                <label for="checkboxPrimary0">
                                                </label>
                                            </div> 
                                        </th>
                                        @endcanany
                                        <th>{{$lng->CouponCode}}</th>
                                        <th>{{$lng->Amount}}</th>
                                    <th>{{$lng->Limit}}</th>
                                        <th>{{$lng->Min}}</th>
                                        <th>{{$lng->Max}}</th>
                                        <th>{{$lng->Start}}</th>
                                        <th>{{$lng->End}}</th>
                                        @can('coupon.edit')
                                        <th>{{$lng->Status}}</th>
                                        @endcan
                                        @canany(['coupon.edit','coupon.destroy'])
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
        @include('includes.scripts.admin.data-table', ['route' => 'coupon.index','columns'=>[
            auth()->user()->can('coupon.edit')||auth()->user()->can('coupon.destroy')?
            [
                "name"=>'index',
                'order'=>'false'
            ]:null,
            [
                "name"=>'code',
                'order'=>'false'
            ],
            [
                "name"=>'amount',
                'order'=>'false'
            ],
            [
                "name"=>'limit',
                'order'=>'false'
            ],
            [
                "name"=>'min',
                'order'=>'false'
            ],
            [
                "name"=>'max',
                'order'=>'false'
            ],
            [
                "name"=>'start',
                'order'=>'false'
            ],
            [
                "name"=>'end',
                'order'=>'false'
            ],
            auth()->user()->can('coupon.edit')?
            [
                "name"=>'status',
                'order'=>'false'
            ]:null,
            auth()->user()->can('coupon.edit')||auth()->user()->can('coupon.destroy')?
            [
                "name"=>'action',
                'order'=>'false'
            ]:null,
        ]])
    @endsection