@extends('layouts.admin',['headerText' => $lng->PaymentMethodImage])
@section('title', "$lng->PaymentMethodImage")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/static.css">
    <script src="{{ asset('assets/admin/js/vendor/dropzone.js') }}"></script>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->PaymentMethodImage }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="POST" action="{{ URL::to('admin/payment-image') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->PaymentMethodImage }}</label>
                        <div id="bannerUpload" class="dropzone"></div>
                        <input name="payment_image" value="{{ $setting->payment_image }}" type="hidden" id="banner">
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

            @if($setting->payment_image)
            let bannerFile = { name: "{{$setting->payment_image}}" };
            bannerDropzone.emit("addedfile", bannerFile);
            bannerDropzone.createThumbnailFromUrl(bannerFile, "{{URL::to('/')}}/images/banner/{{$setting->payment_image}}");
            bannerDropzone.emit("complete",bannerFile);
            @endif

            setTimeout(function() {
                $(".dz-remove").html('<i class="ri-close-line"></i>')
                $(".dz-details").html("")
            }, 500)
        })

    </script>
@endsection
