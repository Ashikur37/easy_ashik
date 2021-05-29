@extends('layouts.admin',['headerText' => $lng->Error404])
@section('title', "$lng->Error404")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/static.css">
    <script src="{{ asset('assets/admin/js/vendor/dropzone.js') }}"></script>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->Error404 }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="POST" action="{{ URL::to('admin/error404') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->Error404 }} {{ $lng->Page }} {{ $lng->BannerImage }} </label>
                        <div id="bannerUpload" class="dropzone"></div>
                        <input name="banner_404" value="{{ $setting->banner_404 }}" type="hidden" id="banner">
                    </div>
                </div>
                <div class="col-12 mt-4">
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
            var bannerDropzone = new Dropzone("div#bannerUpload", {
                init: function() {
                    this.on("success", function(file, serverFileName) {

                        $("#banner").val(serverFileName.name)
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
                                name: $("#banner").val(),
                            },
                        }).done(function() {
                            $("#banner").val("");
                        })
                    })
                },
                addRemoveLinks: true,
                url: "{{ route('dropzone.store', ['path' => 'banner']) }}",
                maxFiles: 1
            });

            @if($setting->banner_404)
            let bannerFile = { name: "{{$setting->banner_404}}" };
            bannerDropzone.emit("addedfile", bannerFile);
            bannerDropzone.createThumbnailFromUrl(bannerFile, "{{URL::to('/')}}/images/banner/{{$setting->banner_404}}");
            bannerDropzone.emit("complete",bannerFile);
            @endif

            setTimeout(function() {
                $(".dz-remove").html('<i class="ri-close-line"></i>')
                $(".dz-details").html("")
            }, 500)
        })

    </script>
@endsection
