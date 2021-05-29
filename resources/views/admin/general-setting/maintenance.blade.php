@extends('layouts.admin',['headerText' => $lng->Maintenance])
@section('title', "$lng->Maintenance")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/static.css">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->Maintenance }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="social-link row">
            <div class="col-12">
                <form action="{{ URL::to('/admin/maintenance') }}" method="post">
                    @csrf
                    <div class="row">        
                        <div class="col-12">
                            <div class="form-group">    
                                <label>Maintenance Mood</label>
                                <div class="d-flex align-items-center justify-content-between featured-status">
                                    <label class="mt-2">Status</label>
                                    <label class="ts-swich-label">
                                        <input {{ $setting->is_maintenance ? 'checked' : '' }} name="is_maintenance"
                                            type="checkbox" class="switch ts-swich-input" value="#">
                                        <span class="ts-swich-body"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ $lng->MaintenancePageText }}</label>
                                <textarea name="maintenance_text" rows="8" class="form-control mr-4"
                                    id="description"></textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-3 text-center">
                            <button class="submit-btn">{{ $lng->Save }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
            CKEDITOR.on("instanceReady", function(event) {
                CKEDITOR.instances['description'].insertHtml(`{!!  $setting->maintenance_text !!}`);
            });
        });
    </script>
@endsection
