@extends('layouts.admin',['headerText' => $lng->LogoAndLoader])
@section('title', "$lng->LogoAndLoader")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.css') }}">
    <script src="{{ asset('assets/admin/js/vendor/dropzone.js') }}"></script>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->LogoAndLoader }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <form method="post" action="{{URL::to('/admin/logo')}}">
            @csrf
            <div class="row">
                <div class="col-md-4 col-sm-6 ">
                    <div class="form-group">
                        <label>{{ $lng->FavIcon }} </label>
                        <div id="faviconUpload" class="dropzone">
                        </div>
                        <input value="{{ $setting->favicon }}" type="hidden" name="favicon" id="favicon">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 ">
                    <div class="form-group">
                        <label>{{ $lng->HeaderLogo }} </label>
                        <div id="headerLogoUpload" class="dropzone">
                        </div>
                        <input value="{{ $setting->header_logo }}" type="hidden" name="header_logo" id="headerLogo">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 ">
                    <div class="form-group">
                        <label>{{ $lng->MailLogo }} </label>
                        <div id="mailLogoUpload" class="dropzone">
                        </div>
                        <input value="{{ $setting->mail_logo }}" type="hidden" name="mail_logo" id="mailLogo">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        <label>{{ $lng->InvoiceLogo }}</label>
                        <div id="invoiceUpload" class="dropzone">
                        </div>
                        <input value="{{ $setting->invoice_logo }}" type="hidden" name="invoice_logo" id="invoice">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        <label>{{ $lng->AdminLogo }} </label>
                        <div id="adminLogoUpload" class="dropzone">
                        </div>
                        <input value="{{ $setting->admin_logo }}" type="hidden" name="admin_logo" id="adminLogo">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        <label>{{ $lng->SiteLoader }} </label>
                        <div id="siteLoaderUpload" class="dropzone">
                        </div>
                        <input value="{{ $setting->site_loader }}" type="hidden" name="site_loader" id="siteLoader">
                    </div>
                </div>
                <div class="col-12 text-center mt-3">
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
            //favicon dropzone
        var faviconDropzone = new Dropzone("div#faviconUpload", {
            init: function () {
                this.on("success", function (file, serverFileName) {
                    
                    $("#favicon").val(serverFileName.name)
                    setTimeout(function(){
                        $(".dz-remove").html('<i class="ri-close-line"></i>')
                        $(".dz-details").html("")
                    },500)
                })
                this.on("removedfile", function (file) {
                    $.ajax({
                        url: "{{route('dropzone.remove', ['path'=>'banner' ])}}",
                        type: "POST",
                        data: {
                            name: $("#favicon").val(),
                        },
                    }).done(function() {
                        $("#favicon").val("");
                    })
                })
            },
              addRemoveLinks: true,
              url: "{{route('dropzone.store', ['path'=>'banner' ])}}",
              maxFiles: 1
              });
              @if($setting->favicon)
                let favIconFile = { name: "{{$setting->favicon}}" };
                faviconDropzone.emit("addedfile", favIconFile);
              faviconDropzone.createThumbnailFromUrl(favIconFile, "{{URL::to('/')}}/images/banner/{{$setting->favicon}}");
              faviconDropzone.emit("complete",favIconFile);
              @endif
            //header logo dropzone
        var headerLogoDropzone = new Dropzone("div#headerLogoUpload", {
            init: function () {
                this.on("success", function (file, serverFileName) {
                    
                    $("#headerLogo").val(serverFileName.name)
                    setTimeout(function(){
                        $(".dz-remove").html('<i class="ri-close-line"></i>')
                        $(".dz-details").html("")
                    },500)
                })
                this.on("removedfile", function (file) {
                    $.ajax({
                        url: "{{route('dropzone.remove', ['path'=>'banner' ])}}",
                        type: "POST",
                        data: {
                            name: $("#headerLogo").val(),
                        },
                    }).done(function() {
                        $("#headerLogo").val("");
                    })
                })
            },
              addRemoveLinks: true,
              url: "{{route('dropzone.store', ['path'=>'banner' ])}}",
              maxFiles: 1
              });
              @if($setting->header_logo)
                let headerLogoFile = { name: "{{$setting->header_logo}}" };
                headerLogoDropzone.emit("addedfile", headerLogoFile);
                headerLogoDropzone.createThumbnailFromUrl(headerLogoFile, "{{URL::to('/')}}/images/banner/{{$setting->header_logo}}");
                headerLogoDropzone.emit("complete",headerLogoFile);
              @endif

    
            //mail logo
            var mailLogoDropzone = new Dropzone("div#mailLogoUpload", {
            init: function () {
                this.on("success", function (file, serverFileName) {
                    
                    $("#mailLogo").val(serverFileName.name)
                    setTimeout(function(){
                        $(".dz-remove").html('<i class="ri-close-line"></i>')
                        $(".dz-details").html("")
                    },500)
                })
                this.on("removedfile", function (file) {
                    $.ajax({
                        url: "{{route('dropzone.remove', ['path'=>'banner' ])}}",
                        type: "POST",
                        data: {
                            name: $("#mailLogo").val(),
                        },
                    }).done(function() {
                        $("#mailLogo").val("");
                    })
                })
            },
              addRemoveLinks: true,
              url: "{{route('dropzone.store', ['path'=>'banner' ])}}",
              maxFiles: 1
              });
              @if($setting->mail_logo)
                let mailLogoFile = { name: "{{$setting->mail_logo}}" };
                mailLogoDropzone.emit("addedfile", mailLogoFile);
                mailLogoDropzone.createThumbnailFromUrl(mailLogoFile, "{{URL::to('/')}}/images/banner/{{$setting->mail_logo}}");
                mailLogoDropzone.emit("complete",mailLogoFile);
              @endif
    
            //invoice logo
            var invoiceDropzone = new Dropzone("div#invoiceUpload", {
            init: function () {
                this.on("success", function (file, serverFileName) {
                    
                    $("#invoice").val(serverFileName.name)
                    setTimeout(function(){
                        $(".dz-remove").html('<i class="ri-close-line"></i>')
                        $(".dz-details").html("")
                    },500)
                })
                this.on("removedfile", function (file) {
                    $.ajax({
                        url: "{{route('dropzone.remove', ['path'=>'banner' ])}}",
                        type: "POST",
                        data: {
                            name: $("#invoice").val(),
                        },
                    }).done(function() {
                        $("#invoice").val("");
                    })
                })
            },
              addRemoveLinks: true,
              url: "{{route('dropzone.store', ['path'=>'banner' ])}}",
              maxFiles: 1
              });
              @if($setting->invoice_logo)
                let invoiceLogoFile = { name: "{{$setting->invoice_logo}}" };
                invoiceDropzone.emit("addedfile", invoiceLogoFile);
                invoiceDropzone.createThumbnailFromUrl(invoiceLogoFile, "{{URL::to('/')}}/images/banner/{{$setting->invoice_logo}}");
                invoiceDropzone.emit("complete",invoiceLogoFile);
              @endif
    
            //admin logo
            var adminLogoDropzone = new Dropzone("div#adminLogoUpload", {
            init: function () {
                this.on("success", function (file, serverFileName) {
                    
                    $("#adminLogo").val(serverFileName.name)
                    setTimeout(function(){
                        $(".dz-remove").html('<i class="ri-close-line"></i>')
                        $(".dz-details").html("")
                    },500)
                })
                this.on("removedfile", function (file) {
                    $.ajax({
                        url: "{{route('dropzone.remove', ['path'=>'banner' ])}}",
                        type: "POST",
                        data: {
                            name: $("#adminLogo").val(),
                        },
                    }).done(function() {
                        $("#adminLogo").val("");
                    })
                })
            },
              addRemoveLinks: true,
              url: "{{route('dropzone.store', ['path'=>'banner' ])}}",
              maxFiles: 1
              });
              @if($setting->admin_logo)
                let adminLogoFile = { name: "{{$setting->admin_logo}}" };
                adminLogoDropzone.emit("addedfile", adminLogoFile);
                adminLogoDropzone.createThumbnailFromUrl(adminLogoFile, "{{URL::to('/')}}/images/banner/{{$setting->admin_logo}}");
                adminLogoDropzone.emit("complete",adminLogoFile);
              @endif
                      //site loader
            var siteLoaderDropzone = new Dropzone("div#siteLoaderUpload", {
            init: function () {
                this.on("success", function (file, serverFileName) {
                    
                    $("#siteLoader").val(serverFileName.name)
                    setTimeout(function(){
                        $(".dz-remove").html('<i class="ri-close-line"></i>')
                        $(".dz-details").html("")
                    },500)
                })
                this.on("removedfile", function (file) {
                    $.ajax({
                        url: "{{route('dropzone.remove', ['path'=>'banner' ])}}",
                        type: "POST",
                        data: {
                            name: $("#siteLoader").val(),
                        },
                    }).done(function() {
                        $("#siteLoader").val("");
                    })
                })
            },
              addRemoveLinks: true,
              url: "{{route('dropzone.store', ['path'=>'banner' ])}}",
              maxFiles: 1
              });
              @if($setting->site_loader)
                let siteLoaderFile = { name: "{{$setting->site_loader}}" };
                siteLoaderDropzone.emit("addedfile", siteLoaderFile);
                siteLoaderDropzone.createThumbnailFromUrl(siteLoaderFile, "{{URL::to('/')}}/images/banner/{{$setting->site_loader}}");
                siteLoaderDropzone.emit("complete",siteLoaderFile);
              @endif
              setTimeout(function(){
                        $(".dz-remove").html('<i class="ri-close-line"></i>')
                        $(".dz-details").html("")
                    },500)
    
    })
    </script>
@endsection
