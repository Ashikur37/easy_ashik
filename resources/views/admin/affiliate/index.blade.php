@extends('layouts.admin',['headerText' => $lng->Affiliation])
@section('title', "$lng->Affiliation")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/dataTables.bootstrap4.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="{{ route('affiliate.index', 1) }}">{{ $lng->Affiliation }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header">
                    <div class="d-flex">
                        @can('affiliate.edit')
                            <a href="{{ route('affiliate.edit', 1) }}" class="submit-btn mr-3">
                                {{ $lng->Edit }} {{ $lng->Affiliation }}
                            </a>
                        @endcan
                        <div class="action-wrapper">
                            @can('affiliate.edit')
                                <select class="select2 mr-3 select-status-head"
                                    data-route="{{ URL::to('/admin/affiliate/multi') }}">
                                    <option value="">{{ $lng->Status }}</option>
                                    <option value="1">{{ $lng->Enabled }}</option>
                                    <option value="0">{{ $lng->Disabled }}</option>
                                </select>
                            @endcan
                            @can('affiliate.edit')
                                <button class="trash-btn delete-button-head mr-3"
                                    data-route="{{ URL::to('/admin/affiliate/multi') }}">
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
                                    @canany(['affiliate.edit','affiliate.destroy'])
                                    <th>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                            <label for="checkboxPrimary0">
                                            </label>
                                        </div>
                                    </th>
                                    @endcanany
                                    <th>{{ $lng->Name }}</th>
                                    <th>{{ $lng->Image }}</th>
                                    <th>
                                        {{ $lng->Percentage }}
                                    </th>
                                    @can('affiliate.edit')
                                        <th>{{ $lng->Status }}</th>
                                        <th>{{ $lng->Action }}</th>
                                        @endif
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
        @include('includes.scripts.admin.data-table', ['route' => 'affiliate.index','columns'=>[
        auth()->user()->can('affiliate.edit')||auth()->user()->can('affiliate.destroy')?
        [
        "name"=>'index',
        'order'=>'false'
        ]:null,

        [
        "name"=>'product_name',
        'order'=>'true'
        ],
        [
        "name"=>'image',
        'order'=>'false'
        ],
        [
        "name"=>'percentage',
        'order'=>'true'
        ],
        auth()->user()->can('affiliate.edit')?
        [
        "name"=>'status',
        'order'=>'false'
        ]:null,
        auth()->user()->can('affiliate.edit')||auth()->user()->can('affiliate.destroy')?
        [
        "name"=>'action',
        'order'=>'false'
        ]:null,
        ]])
    @endsection
