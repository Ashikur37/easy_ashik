@extends('layouts.admin',['headerText' => $lng->TwoColumnBanner])
@section('title', "$lng->TwoColumnBanner")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.css') }}">
    <script src="{{ asset('assets/admin/js/vendor/dropzone.js') }}"></script>
    

@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->TwoColumnBanner }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ URL::to('/admin/full-width-banner') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{ $lng->Banner1 }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mb-0">{{ $lng->BannerImage }} </label>
                                        <span class="preferred-size">({{ $lng->PreferedSize }}:1110 X 400 Pixel)
                                        </span>
                                        <div id="banner1Upload" class="dropzone">
                                        </div>
                                        <input value="{{ $setting->full_width_banner_image }}" type="hidden"
                                            name="full_width_banner_image" id="banner1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-4">
                                        <label for="slider-banner1-url">{{ $lng->CallToActionUrl }}</label>
                                        <input type="text" class="form-control" name="full_width_banner_url"
                                            value="{{ $setting->full_width_banner_url }}" id="slider-banner1-url">
                                    </div>
                                    <div class="form-group mt-3">
                                        <div class="icheck-primary">
                                            <input {{ $setting->full_width_banner_new_window ? 'checked' : '' }}
                                                name="full_width_banner_new_window" type="checkbox"
                                                id="slider-banner1-checkbox">
                                            <label for="slider-banner1-checkbox">{{ $lng->OpenInNewWindow }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{ $lng->Banner2 }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mb-0">{{ $lng->BannerImage }} </label>
                                        <span class="preferred-size">({{ $lng->PreferedSize }}:1110 X 400 Pixel)
                                        </span>
                                        <div id="banner2Upload" class="dropzone">
                                        </div>
                                        <input value="{{ $setting->full_width_banner_2_image }}" type="hidden"
                                            name="full_width_banner_2_image" id="banner2">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-4">
                                        <label for="slider-banner1-url">{{ $lng->CallToActionUrl }}</label>
                                        <input type="text" class="form-control" name="full_width_banner_2_url"
                                            value="{{ $setting->full_width_banner_2_url }}" id="slider-banner2-url">
                                    </div>
                                    <div class="form-group mt-3">
                                        <div class="icheck-primary">
                                            <input {{ $setting->full_width_banner_2_new_window ? 'checked' : '' }}
                                                name="full_width_banner_2_new_window" type="checkbox"
                                                id="slider-banner2-checkbox">
                                            <label for="slider-banner2-checkbox">{{ $lng->OpenInNewWindow }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mt-4">
                    <button class="submit-btn">{{ $lng->Save }}</button>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/admin/js/vendor/select2.full.min.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;
        $(function() {
            var banner1Dropzone = new Dropzone("div#banner1Upload", {
                init: function() {
                    this.on("success", function(file, serverFileName) {

                        $("#banner1").val(serverFileName.name)
                        setTimeout(function() {
                            $(".dz-remove").html('<i class="ri-close-line"></i>')
                            $(".dz-details").html("")
                        }, 500)
                    })
                    this.on("removedfile", function(file) {
                        $.ajax({
                            url: "{{ route('dropzone.remove', ['path' => 'banner']) }}",
                            type: "POST",
                            data: {
                                name: $("#banner1").val(),
                            },
                        }).done(function() {
                            $("#banner1").val("");
                        })
                    })
                },
                addRemoveLinks: true,
                url: "{{ route('dropzone.store', ['path' => 'banner']) }}",
                maxFiles: 1
            });

            @if($setting->full_width_banner_image)
            let banner1File = { name: "{{$setting->full_width_banner_image}}" };
            banner1Dropzone.emit("addedfile", banner1File);
            banner1Dropzone.createThumbnailFromUrl(banner1File, "{{URL::to('/')}}/images/banner/{{$setting->full_width_banner_image}}");
            banner1Dropzone.emit("complete",banner1File);
            @endif


            var banner2Dropzone = new Dropzone("div#banner2Upload", {
                init: function() {
                    this.on("success", function(file, serverFileName) {

                        $("#banner2").val(serverFileName.name)
                        setTimeout(function() {
                            $(".dz-remove").html('<i class="ri-close-line"></i>')
                            $(".dz-details").html("")
                        }, 500)
                    })
                    this.on("removedfile", function(file) {
                        $.ajax({
                            url: "{{ route('dropzone.remove', ['path' => 'banner']) }}",
                            type: "POST",
                            data: {
                                name: $("#banner2").val(),
                            },
                        }).done(function() {
                            $("#banner2").val("");
                        })
                    })
                },
                addRemoveLinks: true,
                url: "{{ route('dropzone.store', ['path' => 'banner']) }}",
                maxFiles: 1
            });

            @if($setting->full_width_banner_2_image)
            let banner2File = { name: "{{$setting->full_width_banner_2_image}}" };
            banner2Dropzone.emit("addedfile", banner2File);
            banner2Dropzone.createThumbnailFromUrl(banner2File, "{{URL::to('/')}}/images/banner/{{$setting->full_width_banner_2_image}}");
            banner2Dropzone.emit("complete",banner2File);
            @endif



            setTimeout(function() {
                $(".dz-remove").html('<i class="ri-close-line"></i>')
                $(".dz-details").html("")
            }, 500)

        })

    </script>
@endsection
