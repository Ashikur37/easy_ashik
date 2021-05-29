@extends('layouts.admin',['headerText' => "Campaign List"])
@section('title', "Campaign List")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">Campaign List</a>
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
                        @can('campaign.create')
                        <a href="{{route('campaign.create')}}" class="submit-btn mr-3">
                            {{$lng->Add}}
                        </a>
                        @endcan
                    </div>
                    <div class="action-wrapper">
                        @can('campaign.destroy')
                        <button class="trash-btn delete-button-head mr-3" data-route="{{URL::to('/admin/campaign/multi')}}">
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
                            @canany(['campaign.edit','campaign.destroy'])
                                <th>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                        <label for="checkboxPrimary0">
                                        </label>
                                    </div>
                                </th>
                                 @endcanany
                                <th>{{$lng->Image}}</th>
                                <th>{{$lng->Title}}</th>
                                @can('campaign.edit')
                                <th>{{$lng->Status}}</th>
                                @endcan
                                @canany(['campaign.edit','campaign.destroy'])
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
@include('includes.scripts.admin.data-table', ['route' => 'campaign.index','columns'=>[
    auth()->user()->can('campaign.edit')||auth()->user()->can('campaign.destroy')?
[
"name"=>'index',
'order'=>'false'
]:null,
[
"name"=>'image',
'order'=>'true'
],

[
"name"=>'title',
'order'=>'true'
],
[
"name"=>'status',
'order'=>'false'
],
auth()->user()->can('campaign.edit')||auth()->user()->can('campaign.destroy')?
[
"name"=>'action',
'order'=>'false'
]:null,
]])
@endsection
