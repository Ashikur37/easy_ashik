@extends('layouts.admin',['headerText' => $lng->CreateBrand])
@section('title', "$lng->CreateBrand")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.css') }}" />
    <script src="{{asset('assets/admin/js/vendor/dropzone.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->CreateBrand }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ route('brand.store') }}" onsubmit="return validateForm()">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="{{ route('brand.index') }}" class="list-btn">{{ $lng->SeeList }}</a>
                        </div>
                        <div>
                            <input type="submit" value="{{ $lng->Save }}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ $lng->Name }} <span>*</span></label>
                        <input value="{{ old('name') }}" name="name" required type="text" class="form-control"
                            placeholder="{{ $lng->EnterBrandName }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ $lng->URL }} </label>
                        <input value="{{ old('slug') }}" name="slug" required type="text" class="form-control"
                            placeholder="Enter url">
                        @error('slug')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ $lng->Status }} </label>
                        <select name="status" class="select2 form-control">
                            <option value="1">{{ $lng->Enabled }}</option>
                            <option value="0">{{ $lng->Disabled }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ $lng->MetaTitle }} </label>
                        <input value="{{ old('meta_title') }}" name="meta_title" type="text" class="form-control"
                            placeholder="Enter {{ $lng->MetaTitle }}">
                        @error('meta_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">{{ $lng->Logo }}* (60x200)</label>
                        <div id="logoUpload" class="dropzone">
                        </div>
                        <input type="hidden" name="logo" id="logo">
                        <span  id="logoError" class="invalid-feedback d-none" role="alert">
                            <strong>{{ $lng->Logo }} {{ $lng->Required }}</strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">{{ $lng->Banner }} (1110x300)</label>
                        <div id="bannerUpload" class="dropzone">
                        </div>
                        <input type="hidden" name="banner" id="banner">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ $lng->MetaDescription }} </label>
                        <textarea name="meta_description" class="form-control" rows="8"></textarea>
                        @error('meta_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/admin/js/vendor/select2.full.min.js')}}"></script>
    <script>
        function validateForm() {
            if (!$("#logo").val()) {
                $("#logoError").removeClass("d-none")
                return false;
            }
            return true;
        }
        Dropzone.autoDiscover = false;
        $(function() {
            $('.select2').select2({
                minimumResultsForSearch: -1
            });
            var logoDropzone = new Dropzone("div#logoUpload", {
                init: function() {
                    this.on("success", function(file, serverFileName) {
                        $("#logo").val(serverFileName.name)
                    })
                    this.on("addedfile", function() {
                        if ($("#logo").val()) {
                            this.removeFile(this.files[0]);
                        }
                    });
                    this.on("removedfile", function(file) {
                        $.ajax({
                            url: "{{ route('dropzone.remove', ['path' => 'brand']) }}",
                            type: "POST",
                            data: {
                                name: $("#logo").val(),
                            },
                        }).done(function() {
                            $("#logo").val("");
                        })
                    })
                },
                addRemoveLinks: true,
                url: "{{ route('dropzone.store', ['path' => 'brand']) }}",
                maxFiles: 1
            });

            var bannerDropzone = new Dropzone("div#bannerUpload", {
                init: function() {
                    this.on("success", function(file, serverFileName) {
                        $("#banner").val(serverFileName.name)
                    })
                    this.on("addedfile", function() {
                        if ($("#banner").val()) {
                            this.removeFile(this.files[0]);
                        }
                    });
                    this.on("removedfile", function(file) {
                        $.ajax({
                            url: "{{ route('dropzone.remove', ['path' => 'brand']) }}",
                            type: "POST",
                            data: {
                                name: $("#banner").val(),
                            },
                        }).done(function() {
                            $("#banner").val("");
                        })
                    })
                },
                addRemoveLinks: true,
                url: "{{ route('dropzone.store', ['path' => 'brand']) }}",
                maxFiles: 1
            });
        })
    </script>
@endsection
