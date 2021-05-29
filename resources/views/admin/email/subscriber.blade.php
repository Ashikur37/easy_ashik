@extends('layouts.admin',['headerText' => $lng->SubscriberList])
@section('title', "$lng->SubscriberList")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->SubscriberList}}</a>
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
                        <div>
                            <a href="{{URL::to('/admin/group-email')}}" class="list-btn mr-3 lg-list-btn">
                                {{$lng->Send}} {{$lng->Email}}
                            </a>
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
                                        <th>{{$lng->Email}}</th>
                                        <th>{{$lng->IP}}</th>
                                        <th>{{$lng->LastEmail}}</th>
                                        <th>{{$lng->TotalSent}}</th>
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
        @include('includes.scripts.admin.subscribe-table', ['route' => 'admin/subscriber','columns'=>[

            [
                "name"=>'email',
                'order'=>'true'
            ],
            [
                "name"=>'ip',
                'order'=>'true'
            ],
            [
                "name"=>'last_email',
                'order'=>'true'
            ],
            [
                "name"=>'mail_count',
                'order'=>'true'
            ],

        ]])
    @endsection