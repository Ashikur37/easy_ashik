@extends('layouts.admin',['headerText' => $lng->AboutUs])
@section('title', "$lng->AboutUs")

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/static.css">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->AboutUs }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="social-link row">
            <div class="col-12">
                <form action="" method="post" action="{{ URL::to('/admin/about-us-setting') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>{{ $lng->Title }}</label>
                                        <input name="about_title" value="{{ $setting->about_title }}" class="form-control"
                                            type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $lng->Description }} </label>
                                        <textarea id="description" name="about_description" class="form-control" rows="5"
                                            id=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4 text-center">
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
                CKEDITOR.instances['description'].insertHtml(`{!!  $setting->about_description !!}`);
            });
        });

    </script>

@endsection
