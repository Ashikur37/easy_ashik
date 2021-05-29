@extends('layouts.admin',['headerText' => $lng->LanguageList])
@section('title', "$lng->LanguageList")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/language.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->LanguageList }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header">
                    <div class="d-flex">
                        <div>
                            @can('faq.edit')
                                <a href="{{ route('language.create') }}" class="submit-btn mr-3">
                                    {{ $lng->Add }}
                                </a>
                            @endcan
                        </div>
                        <div class="action-wrapper">
                            @can('language.edit')
                                <select class="select2 mr-3 select-status-head"
                                    data-route="{{ URL::to('/admin/language/multi') }}">
                                    <option value="">{{ $lng->Status }}</option>
                                    <option value="1">{{ $lng->Enabled }}</option>
                                    <option value="0">{{ $lng->Disabled }}</option>
                                </select>
                            @endcan
                            @can('language.destroy')
                                <button class="trash-btn delete-button-head mr-3"
                                    data-route="{{ URL::to('/admin/language/multi') }}">
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
                            <select class="select2" id="pagelen">
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
                                    @canany(['language.edit','language.destroy'])
                                    <th>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                            <label for="checkboxPrimary0">
                                            </label>
                                        </div>
                                    </th>
                                    @endcanany
                                    <th>{{ $lng->Name }}</th>
                                    @can('language.edit')
                                        <th> {{ $lng->Active }} </th>
                                    @endcan
                                    @canany(['language.edit','language.destroy'])
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
    @include('includes.scripts.admin.data-table', ['route' => 'language.index','columns'=>[
    auth()->user()->can('language.edit')||auth()->user()->can('language.destroy')?
    [
    "name"=>'index',
    'order'=>'false'
    ]:null,
    [
    "name"=>'name',
    'order'=>'true'
    ],
    auth()->user()->can('language.edit')?
    [
    "name"=>'status',
    'order'=>'false'
    ]:null,
    auth()->user()->can('language.edit')||auth()->user()->can('language.destroy')?
    [
    "name"=>'action',
    'order'=>'false'
    ]:null,
    ]])
@endsection
