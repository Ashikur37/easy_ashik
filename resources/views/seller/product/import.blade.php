@extends('layouts.vendor',['headerText' => "Import Product"])
@section('title', "Import Product")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.css') }}" />
    <script src="{{ asset('assets/admin/js/vendor/dropzone.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/flatpickr.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">Import Product</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <a download style="float:right" class="btn btn-warning" href="{{URL::to('/sample.csv')}}"> Sample</a>

            <form action="{{URL::to('/vendor/product-import')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">CSV file</label>
                    <input type="file" class="form-control-file" name="file">

                </div>
                <button class="btn btn-success">Import</button>
            </form>
    </div>
@endsection
