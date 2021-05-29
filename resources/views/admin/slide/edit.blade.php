@extends('layouts.admin',['headerText' => $lng->UpdateSlider])
@section('title', "$lng->UpdateSlider") 
@section('style')
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/dropzone.css"/> 
  <script src="{{asset('assets/admin/js/vendor/dropzone.js')}}"></script>
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->UpdateSlider}}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form   method="post" action="{{route('slide.update',$slide->id)}}"  >
           @csrf
           @method('patch')
           <div class="row">
            <div class="col-12">
                <div class="flex-item  top-info-header">
                    <div>
                        <a href="{{route('slide.index')}}" class="list-btn">{{$lng->SeeList}}</a>
                    </div>
                    <div class="align-self-end">
                        <input type="submit" value="{{$lng->Save}}" class="submit-btn">
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Image}} </label>
                        <div id="imageUpload" class="dropzone">
                            
                        </div>
                    <input value="{{$slide->image}}" type="hidden" name="image" id="image">
                    </div>
                    <div class="form-group">
                        <label >{{$lng->ButtonText}} <span>*</span></label>
                        <input class="form-control" value="{{$slide->button_text}}" type="text" name="button_text" >
                    </div>
                    <div class="form-group">
                        <label >{{$lng->CallToActionUrl}}</label>
                        <input  value="{{$slide->call_to_action_url}}" name="call_to_action_url" required type="text" class="form-control" placeholder=" {{$lng->CallToActionUrl}}">
                    </div>
                    <div class="form-group">
                    <label >{{$lng->OpenLink}}</label>
                        <select name="open_in_new_window" class="select2 form-control">
                            <option value="1">{{$lng->NewWindow}}</option>
                            <option {{$slide->open_in_new_window==0?'selected':''}} value="0">{{$lng->CurrentWindow}}</option>
                        </select>
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Title}} </label>
                        <input value="{{$slide->title}}" name="title" required type="text" class="form-control" placeholder="{{$lng->Title}}">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="d-block">{{$lng->TitleColor}} </label>
                        <input name="title_color" value="{{$slide->title_color}}" type="color" class="ts-color-pickr">
                    </div>
                    <div class="form-group">
                        <label >{{$lng->SubTitle}}</label>
                        <input placeholder="{{$lng->SubTitle}}" type="text" name="body" class="form-control" value="{{$slide->body}}">
                    </div>
                    <div class="form-group">
                        <label class="d-block">{{$lng->SubTitle}}{{$lng->Color}} </label>
                        <input name="color" value="{{$slide->color}}" type="color" class="ts-color-pickr">
                    </div>
                    <div class="form-group">
                      <label >{{$lng->Direction}}</label>
                      <select name="direction" class="select2 form-control">
                          <option value="1">{{$lng->LeftToRight}}</option>
                          <option {{$slide->direction==0?'selected':''}} value="0">{{$lng->RightToLeft}}</option>
                      </select>
                    </div>
                </div>
            </div>     
        </form>
    </div>
@endsection
@section('script')
<script src="{{asset('assets/admin/js/vendor/select2.full.min.js')}}"></script>
<script>
    Dropzone.autoDiscover = false;
    $(function() {
        $('.select2').select2({
            minimumResultsForSearch: -1
        });
    var imageDropzone = new Dropzone("div#imageUpload", {
        init: function () {
            this.on("success", function (file, serverFileName) {
                $("#image").val(serverFileName.name)
                setTimeout(function(){
                    $(".dz-remove").html('<i class="ri-close-line"></i>')
                    $(".dz-details").html("")
                    },500)
            })
            this.on("removedfile", function (file) {
                $.ajax({
                    url: "{{route('dropzone.remove', ['path'=>'slider' ])}}",
                    type: "POST",
                    data: {
                        name: $("#image").val(),
                    },
                }).done(function() {
                    $("#image").val("");

                })
            })
        },
          addRemoveLinks: true,
          url: "{{route('dropzone.store', ['path'=>'slider' ])}}",
          maxFiles: 1
          });
          
            let imageFile = { name: "{{$slide->image}}" };
          imageDropzone.emit("addedfile", imageFile);
          imageDropzone.createThumbnailFromUrl(imageFile, "{{URL::to('/')}}/images/slider/{{$slide->image}}");
          setTimeout(function(){
                    $(".dz-remove").html('<i class="ri-close-line"></i>')
                    $(".dz-details").html("")
            },500)
          imageDropzone.emit("complete",imageFile);
})
</script>
@endsection
