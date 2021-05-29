@extends('layouts.admin',['headerText' => $lng->AddPage])
@section('title', "$lng->CreatePage")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->AddPage }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ route('page.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="{{ route('page.index') }}" class="list-btn">{{ $lng->SeeList }}</a>
                        </div>
                        <div>
                            <input type="submit" value="{{ $lng->Save }}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->Name }} <span>*</span></label>
                        <input name="name" type="text" class="form-control" placeholder="Enter name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex">
                        <div class="form-group w-100">
                            <label>{{ $lng->Slug }} <span>*</span></label>
                            <input name="slug" type="text" class="form-control w-100" placeholder="Enter slug">
                        </div>
                        <div class="ml-4 show-link-wrapper">
                            <label>{{ $lng->ShowLink }}</label>
                            <br>
                            <label class="ts-swich-label">
                                <input name="active" type="checkbox" class="switch ts-swich-input">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>{{ $lng->Body }} <span>*</span></label>
                        <textarea name="body" class="form-control" id="description" rows="4"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function() {
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        });
    </script>
@endsection
