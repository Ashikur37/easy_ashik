@extends('layouts.admin',['headerText' => $lng->AddPaymentGateway])
@section('title', "$lng->AddPaymentGateway")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->AddPaymentGateway }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ route('payment-gateway.store') }}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="{{ route('payment-gateway.index') }}" class="list-btn">{{ $lng->SeeList }}</a>
                        </div>
                        <div>
                            <input type="submit" value="{{ $lng->Save }}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label>{{ $lng->Name }} </label>
                        <input required name="title" type="text" class="form-control" placeholder="{{ $lng->Name }}">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label>{{ $lng->Details }} </label>
                        <input  name="details" class="form-control">
                    </div>
                </div>
            </div>
            <h4 class="mb-3">{{ $lng->AdditionalFields }}</h4>
            <div id="additionalHtml">
                <div class="row" id="additional#id">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>{{ $lng->Title }} </label>
                            <input required name="ad_title[]" type="text" class="form-control"
                                placeholder="{{ $lng->Title }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>{{ $lng->Details }} </label>
                            <div class="d-flex">
                                <input required name="ad_details[]" class="form-control" placeholder="{{ $lng->Details }}">
                                <span class="remove-extra-feature"
                                    onclick="document.getElementById('additional#id').remove()">
                                    <i class="ri-delete-bin-line"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="button" id="more-additional" class="add-extra-feature ml-0">{{ $lng->AddNew }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function() {
            var additionalId = 0;
            var additionalHTML = $("#additionalHtml").html();
            $("#more-additional").on('click', function() {
                additionalId++;
                $("#additionalHtml").append(additionalHTML.split("#id").join(additionalId))
            })
            $("#additionalHtml").html(attributeHTML.split("#id").join('0'))
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        });
    </script>
@endsection
