@extends('layouts.admin',['headerText' => $lng->FeatureSet])
@section('title', "$lng->FeatureSet")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="{{route('attribute-set.index')}}">{{$lng->FeatureSet}}</a>
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
                                <a href="{{route('attribute-set.create')}}" class="submit-btn mr-3">
                                    {{$lng->Add}}
                                </a>
                            </div>
                            <div class="action-wrapper">
                                @can('attribute-set.destroy')
                                    <button class="trash-btn delete-button-head" data-route="{{URL::to('/admin/attribute-set/multi')}}">
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
                                        <th>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                                <label for="checkboxPrimary0">
                                                </label>
                                            </div> 
                                        </th>
                                        <th>{{$lng->Name}}</th>
                                        <th>{{$lng->Action}}</th>
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
        @include('includes.scripts.admin.data-table', ['route' => 'attribute-set.index','columns'=>[
            auth()->user()->can('attribute-set.edit')||auth()->user()->can('attribute-set.destroy')?
            [
                "name"=>'index',
                'order'=>'false'
            ]:null,
            [
                "name"=>'name',
                'order'=>'true'
            ],
            auth()->user()->can('attribute-set.edit')||auth()->user()->can('attribute-set.destroy')?
            [
                "name"=>'action',
                'order'=>'false'
            ]:null,
        ]])
    @endsection