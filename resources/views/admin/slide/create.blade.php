@extends('layouts.admin',['headerText' => $lng->AddSlider])
@section('title', "$lng->AddSlider") 
@section('style')
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/dropzone.css"/> 
  <script src="{{asset('assets/admin/js/vendor/dropzone.js')}}"></script>
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->AddSlider}}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form onsubmit="return validateSlide()" method="post" action="{{route('slide.store')}}"  >
           @csrf
           <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header">
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
                        <label >{{$lng->Image}}* </label>
                        <span class="preferred-size d-inline">({{$lng->PreferedSize}}: 860 X 530 Pixel)</span>
                        <div id="imageUpload" class="dropzone">                    
                        </div>
                        <input type="hidden" name="image" id="image">
                        <span id="imageError" class="invalid-feedback d-none" role="alert">
                            <strong>{{ $lng->Required }}</strong>
                        </span>
                    </div>
                     
                    <div class="form-group">
                        <label >{{$lng->ButtonText}} <span>*</span></label>
                        <input type="text" name="button_text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label >{{$lng->CallToActionUrl}}</label>
                        <input  name="call_to_action_url" required type="text" class="form-control" placeholder="{{$lng->CallToActionUrl}}">
                    </div>
                     <div class="form-group">
                        <label >{{$lng->OpenLink}} </label>
                        <select name="open_in_new_window" class="select2 form-control">
                            <option value="1">{{$lng->NewWindow}}</option>
                            <option value="0">{{$lng->CurrentWindow}}</option>
                        </select>
                    </div>  
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Title}} </label>
                        <input value="{{ old('title') }}" name="title" required type="text" class="form-control" placeholder="{{$lng->Title}}">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="d-block">{{$lng->TitleColor}} </label>               
                        <input  name="title_color"  type="color" class="ts-color-pickr">
                    </div>
                    <div class="form-group">
                        <label >{{$lng->SubTitle}} </label>
                        <input placeholder="{{$lng->SubTitle}}" name="body" class="form-control">
                    </div>
                     <div class="form-group">
                        <label class="d-block">{{$lng->SubTitle}}{{$lng->Color}} </label>            
                        <input  name="color" type="color" class="ts-color-pickr">
                    </div>         
                    <div class="form-group">
                        <label >{{$lng->Direction}}</label>
                        <select name="direction" class="select2 form-control">
                            <option value="1">{{$lng->LeftToRight}}</option>
                            <option value="0">{{$lng->RightToLeft}}</option>
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

})
function validateSlide() {
    if(!$("#image").val()){
        $("#imageError").removeClass("d-none");
        return false;
    }
}
</script>
@endsection
