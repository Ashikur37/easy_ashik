@extends('layouts.admin',['headerText' => $lng->SizeList])
@section('title', "$lng->SizeList")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->SizeList }}</a>
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
                        <div>
                            @can('size.create')
                                <a href="{{ route('size.create') }}" class="submit-btn mr-3">
                                    {{ $lng->Add }}
                                </a>
                            @endcan
                        </div>
                        <div class="action-wrapper">
                            @can('size.destroy')
                                <button class="trash-btn delete-button-head mr-3"
                                    data-route="{{ URL::to('/admin/size/multi') }}">
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
                                    @canany(['size.edit','size.destroy'])
                                    <th>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                            <label for="checkboxPrimary0">
                                            </label>
                                        </div>
                                    </th>
                                    @endcanany
                                    <th>{{ $lng->Name }}</th>
                                    @canany(['size.edit','size.destroy'])
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
    @include('includes.scripts.admin.data-table', ['route' => 'size.index','columns'=>[
    auth()->user()->can('size.edit')||auth()->user()->can('size.destroy')?
    [
    "name"=>'index',
    'order'=>'false'
    ]:null,
    [
    "name"=>'name',
    'order'=>'true'
    ],
    auth()->user()->can('size.edit')||auth()->user()->can('size.destroy')?
    [
    "name"=>'action',
    'order'=>'false'
    ]:null,
    ]])
@endsection
