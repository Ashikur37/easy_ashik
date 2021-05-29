@extends('layouts.admin',['headerText' => $lng->ReviewList])
@section('title', "$lng->ReviewList")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/dataTables.bootstrap4.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->ReviewList}}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header">
                    <div class="d-flex">
                        <div class="action-wrapper">
                            <select class="select2 mr-3 select-status-head"
                                data-route="{{ URL::to('/admin/review/multi') }}">
                                <option value="">{{ $lng->Status }}</option>
                                <option value="1">{{ $lng->Enabled }}</option>
                                <option value="0">{{ $lng->Disabled }}</option>
                            </select>
                            <button class="trash-btn delete-button-head mr-3"
                                data-route="{{ URL::to('/admin/review/multi') }}">
                                {{ $lng->Delete }}
                            </button>
                        </div>
                    </div>
                    <div class="d-flex ">
                        <div class="data-table-search-box">
                            <input id="searchBox" type="text" placeholder="{{ $lng->Search }}" /><span> </span>
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
                                    <th>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                            <label for="checkboxPrimary0">
                                            </label>
                                        </div>
                                    </th>
                                    <th>{{ $lng->Product }}</th>
                                    <th>{{ $lng->User }}</th>
                                    <th>{{ $lng->Comment }}</th>
                                    <th>{{ $lng->Rating }}</th>
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
    @include('includes.scripts.admin.data-table', ['route' => 'review.index','columns'=>[
    [
    "name"=>'index',
    'order'=>'false'
    ],
    [
    "name"=>'product.name',
    'order'=>'true'
    ],
    [
    "name"=>'user.name',
    'order'=>'true'
    ],
    [
    "name"=>'comment',
    'order'=>'true'
    ],
    [
    "name"=>'rating',
    'order'=>'true'
    ],
    [
    "name"=>'is_approved',
    'order'=>'false'
    ],
    [
    "name"=>'created_at',
    'order'=>'true'
    ],
    [
    "name"=>'action',
    'order'=>'false'
    ],
    ]])
@endsection
