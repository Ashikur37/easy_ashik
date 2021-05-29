@extends('layouts.admin',['headerText' => $lng->CreateLanguage])
@section('title', "$lng->CreateLanguage")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/language.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->AddLanguage }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" onsubmit="return readAll()" action="{{ route('language.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item top-info-header">
                        <div>
                            <a href="{{ route('language.index') }}" class="list-btn">{{ $lng->SeeList }}</a>
                        </div>
                        <div>
                            <input type="submit" value="{{ $lng->Save }}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex justify-content-between">
                        <div class="form-group w-100">
                            <label>{{ $lng->Name }} </label>
                            <input required name="name" type="text" class="form-control" placeholder="Enter name">
                        </div>
                        <div class="form-group ml-4">
                            <label>{{ $lng->IsActive }}</label>
                            <br>
                            <label class="ts-swich-label">
                                <input name="is_active" type="checkbox" class="switch ts-swich-input">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end mb-4 mb-md-0 search-word-wrapper">
                         <div class="data-table-search-box">
                            <input id="searchBox" type="text" placeholder="Search..." />
                        </div>
                        <div class="pl-3">
                            <select class="select2 select-wide" id="pagelen">
                                <option value="10">10</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="-1">{{ $lng->All }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="responsive-table">
                <table class="table table-striped first" id="takwa-table">
                    <thead>
                        <tr>
                            <th class="w-50">{{ $lng->Word }}</th>
                            <th>{{ $lng->Translate }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($words as $word)
                            <tr>
                                <td>{{ $word }}</td>
                                <td>
                                    <input type="text" name="{{ $word }}" class="form-control word-input" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/vendor/select2.full.min.js') }}"></script>
    <script src="{{asset('assets/admin/js/vendor/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/vendor/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(function() {
            $('.select2').select2({
                minimumResultsForSearch: -1
            });
            window.table = $("#takwa-table").DataTable({
            });
            $('#searchBox').on('keyup click', function() {
                table.search($('#searchBox').val()).draw();
            });
            $('#pagelen').on('change', function() {
                table.page.len($('#pagelen').val()).draw();
            });
            $("#pagelen").css("display", "inline-block");
        })
        function readAll() {
            table.rows().nodes().page.len(-1).draw();
            table.search("").draw();
            return true;
        }
    </script>
@endsection