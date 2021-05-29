@extends('layouts.admin',['headerText' => $lng->PopupWindow])
@section('title', "$lng->PopupWindow")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/static.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.css') }}">
    <script src="{{ asset('assets/admin/js/vendor/dropzone.js') }}"></script>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->PopupWindow }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="social-link row">
            <div class="col-12">
                <form action="{{ URL::to('admin/popup-window') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="flex-item">
                                        <h5>{{ $lng->Newsletter }}</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>{{ $lng->Title }}</label>                                      
                                        <input name="news_letter_sub_title" value="{{ $setting->news_letter_sub_title }}"
                                            class="form-control" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $lng->Image }} </label>
                                        <div id="newsLetterImageUpload" class="dropzone">
                                        </div>
                                        <input value="{{ $setting->news_letter_image }}" type="hidden"
                                            name="news_letter_image" id="newsLetterImage">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4 mt-md-0">
                            <div class="card">
                                <div class="card-header">
                                    <div class="flex-item">
                                        <h5>{{ $lng->CookieBar }}</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>{{ $lng->CookieBarMessage }}</label>
                                        <input name="cookie_message" value="{{ $setting->cookie_message }}"
                                            class="form-control" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $lng->CookieButtonText }}</label>
                                        <input name="cookie_button" value="{{ $setting->cookie_button }}"
                                            class="form-control" type="text">
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
<script>
    Dropzone.autoDiscover = false;
    $(function() {
              //admin logo
              var newsLetterImageDropzone = new Dropzone("div#newsLetterImageUpload", {
          init: function () {
              this.on("success", function (file, serverFileName) {
                  
                  $("#newsLetterImage").val(serverFileName.name)
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
                          name: $("#newsLetterImage").val(),
                      },
                  }).done(function() {
                      $("#newsLetterImage").val("");
                  })
              })
          },
            addRemoveLinks: true,
            url: "{{route('dropzone.store', ['path'=>'banner' ])}}",
            maxFiles: 1
            });
            @if($setting->news_letter_image)
              let newsLetterImageFile = { name: "{{$setting->news_letter_image}}" };
              newsLetterImageDropzone.emit("addedfile", newsLetterImageFile);
              newsLetterImageDropzone.createThumbnailFromUrl(newsLetterImageFile, "{{URL::to('/')}}/images/banner/{{$setting->news_letter_image}}");
              newsLetterImageDropzone.emit("complete",newsLetterImageFile);
            @endif
            setTimeout(function(){
                  $(".dz-remove").html('<i class="ri-close-line"></i>')
                  $(".dz-details").html("")
              },500)
    });
</script>
@endsection
