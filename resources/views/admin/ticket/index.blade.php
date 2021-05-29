@extends('layouts.admin',['headerText' => $lng->TicketList])
@section('title', "$lng->TicketList")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->TicketList }}</a>
    </li>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/ticket.css">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header">
                    <div class="d-flex">
                        <div class="action-wrapper">
                            @can('ticket.edit')
                                <select class="select2 mr-3 select-status-head"
                                    data-route="{{ URL::to('/admin/ticket/multi') }}">
                                    <option value="">{{ $lng->Status }}</option>
                                    <option value="0">{{ $lng->Closed }}</option>
                                    <option value="1">{{ $lng->Open }}</option>
                                </select>
                            @endcan
                        </div>
                    </div>
                    <div class="d-flex ">
                        <div class="data-table-search-box mr-3">
                            <input id="searchBox" type="text" placeholder="Search..." /><span> </span>
                        </div>
                        <div>
                            <select id="pagelen" class="select2 form-control">
                                <option value="10">10</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
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
                                    @canany(['coupon.edit','coupon.destroy'])
                                    <th>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                            <label for="checkboxPrimary0">
                                            </label>
                                        </div>
                                    </th>
                                    @endcanany
                                    <th>{{ $lng->Customer }}</th>
                                    <th>{{ $lng->Subject }}</th>
                                    <th>{{ $lng->Created }} at</th>
                                    <th>{{ $lng->LastMessage }}</th>
                                    @can('ticket.edit')
                                        <th>{{ $lng->Status }}</th>
                                    @endcan
                                    @canany(['coupon.edit','coupon.destroy'])
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
    <div class='ticket' id="chat-box"></div>
@endsection

@section('script')
    @include('includes.scripts.admin.data-table', ['route' => 'ticket.index','columns'=>[
    auth()->user()->can('ticket.edit')||auth()->user()->can('ticket.destroy')?
    [
    "name"=>'index',
    'order'=>'false'
    ]:null,
    [
    "name"=>'user',
    'order'=>'true'
    ],
    [
    "name"=>'subject',
    'order'=>'true'
    ],
    [
    "name"=>'created_at',
    'order'=>'true'
    ],
    [
    "name"=>'last_message',
    'order'=>'true'
    ],
    auth()->user()->can('ticket.edit')?
    [
    "name"=>'status',
    'order'=>'true'
    ]:null,
    auth()->user()->can('ticket.edit')||auth()->user()->can('ticket.destroy')?
    [
    "name"=>'action',
    'order'=>'false'
    ]:null,
    ]])
    <script>
        $(function() {
            $(document).on('click', '.show-chat-btn', function() {
                let id = $(this).data('id');
                showLoader();
                $("#chat-box").load("{{ URL::to('/admin/load-ticket') }}/" + id, function() {
                    $("#chat-box").css('display', 'block');
                    setTimeout(function() {
                        $('#ticket-body').scrollTop($('#ticket-body')[0].scrollHeight);
                    }, 300)
                    hideLoader();
                });
            })
            $(document).on('submit', "form#ticket-form", {}, function(e) {
                e.preventDefault();
                showLoader();
                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: $(this).attr("action"),
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        $("#chat-box").html(data);
                        setTimeout(function() {
                            $('#ticket-body').scrollTop($('#ticket-body')[0]
                                .scrollHeight);
                        }, 300)
                        hideLoader();
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
            $(document).on('click', '.ticket-closer', {}, function() {
                $("#chat-box").css('display', 'none')
            })
        });

    </script>
@endsection
