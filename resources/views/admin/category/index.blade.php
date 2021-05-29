@extends('layouts.admin',['headerText' => $lng->CategoryList])
@section('title', "$lng->CategoryList") 
@section('style')
<link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
<link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/dataTables.bootstrap4.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->CategoryList}}</a>
    </li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="flex-item top-info-header">
                <div class="d-flex">
                    <div>
                        @can('category.create')
                        <a href="{{route('category.create')}}" class="submit-btn mr-3">
                            {{$lng->Add}}
                        </a>
                        @endcan
                    </div>
                    <div class="action-wrapper">
                        @can('category.edit')
                        <select class="select2 mr-3 select-status-head" data-route="{{URL::to('/admin/category/multi')}}">
                            <option value="">{{$lng->Status}}</option>
                            <option value="1">{{$lng->Enabled}}</option>
                            <option value="0">{{$lng->Disabled}}</option>
                        </select>
                        @endcan
                        @can('category.destroy')
                        <button class="trash-btn delete-button-head mr-3" data-route="{{URL::to('/admin/category/multi')}}">
                                {{$lng->Delete}}
                            </button>
                        @endcan
                    </div>
                </div>             
                <div class="d-flex "> 
                     <div class="data-table-search-box">
                        <input id="searchBox" type="text" placeholder="Search..." />
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
                            @canany(['category.edit','category.destroy'])
                                <th>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                        <label for="checkboxPrimary0">
                                        </label>
                                    </div>
                                </th>
                                @endcanany
                            <th>{{$lng->Category}}</th>
                                <th>
                                    {{$lng->TotalProducts}}
                                </th>
                                @can('category.edit')
                                <th>{{$lng->Status}}</th>
                                <th>{{$lng->ShowInHomePage}}</th>
                                @endcan
                                @canany(['category.edit','category.destroy'])
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
@include('includes.scripts.admin.data-table', 
['route' => 'category.index','columns'=>[
    auth()->user()->can('category.edit')||auth()->user()->can('category.destroy')?
        [
        "name"=>'index',
        'order'=>'false'
        ]:null,
        [
        "name"=>'name',
        'order'=>'true'
        ],
        [
        "name"=>'used',
        'order'=>'true'
        ],
        auth()->user()->can('category.edit')?
        [
        "name"=>'status',
        'order'=>'false'
        ]:null,
        [
        "name"=>'is_featured',
        'order'=>'false'
        ],
        auth()->user()->can('category.edit')||auth()->user()->can('category.destroy')?
        [
        "name"=>'action',
        'order'=>'false'
        ]:null,
]])
@endsection
