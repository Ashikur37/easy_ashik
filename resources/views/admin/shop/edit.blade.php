@extends('layouts.admin',['headerText' => "Edit Shop"])
@section('title', "Edit Shop")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/dropzone.css" />
    <script src="{{ asset('assets/admin/js/vendor/dropzone.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/select2.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">Edit Shop</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ route('shop.update', $shop->id) }}" onsubmit="return validateForm()">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="{{ route('shop.index') }}" class="list-btn">{{ $lng->SeeList }}</a>
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
                        <input value="{{ $shop->name }}" name="name" required type="text" class="form-control"
                            placeholder="{{ $lng->Name }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Phone </label>
                        <input value="{{ $shop->phone }}" name="phone" required type="text" class="form-control"
                            placeholder="Enter url">
                        @error('phone')
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
                        <select name="is_active" class="select2 form-control">
                            <option {{ $shop->is_active == 1 ? 'selected' : '' }} value="1">Enabled</option>
                            <option {{ $shop->is_active == 0 ? 'selected' : '' }} value="0">{{ $lng->Disabled }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Location </label>
                        <input value="{{ $shop->location }}" name="location" type="text" class="form-control"
                            placeholder="Enter location">
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
                        <label for="">{{ $lng->Logo }} </label>
                        <div id="logoUpload" class="dropzone">
                        </div>
                        <input value="{{ $shop->image }}" type="hidden" name="image" id="logo">
                        <span  id="logoError" class="invalid-feedback d-none" role="alert">
                            <strong>Image{{ $lng->Required }}</strong>
                        </span>
                    </div>
                </div>
              
                
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/vendor/select2.full.min.js') }}"></script>
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
            window.logoDropzone = new Dropzone("div#logoUpload", {
                init: function() {
                    this.on("success", function(file, serverFileName) {
                        $("#logo").val(serverFileName.name)
                    })
                    this.on("removedfile", function(file) {
                        $.ajax({
                            url: "{{ route('dropzone.remove', ['path' => 'shop']) }}",
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
                url: "{{ route('dropzone.store', ['path' => 'shop']) }}",
                maxFiles: 1
            });
            let logoFile = {
                name: "{{ $shop->image }}"
            };
            logoDropzone.emit("addedfile", logoFile);
            logoDropzone.createThumbnailFromUrl(logoFile, "{{ URL::to('/') }}/images/shop/{{ $shop->image }}");
            logoDropzone.emit("complete", logoFile);

           
            setTimeout(function() {
                $(".dz-remove").html('<i class="ri-close-line"></i>')
                $(".dz-details").html("")
            }, 500)
        })

    </script>
@endsection
