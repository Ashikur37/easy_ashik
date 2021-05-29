@extends('layouts.admin',['headerText' => $lng->EditChildCategory])
@section('title', "$lng->EditChildCategory") 
@section('style')
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/dropzone.css"/> 
  <script src="{{asset('assets/admin/js/vendor/dropzone.js')}}"></script>
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->EditChildCategory}}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form   method="post" action="{{route('child-category.update',$childCategory->id)}}">
           @csrf
           @method('patch')
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="{{route('child-category.index')}}" class="list-btn">{{$lng->SeeList}}</a>
                        </div>
                       <div>
                            <input type="submit" value="{{$lng->Save}}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label >{{$lng->Name}} <span>*</span></label>
                        <input  value="{{ $childCategory->name }}" name="name" required type="text" class="form-control" placeholder="{{$lng->Name}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >{{$lng->Category}} </label>
                        <select id="category_id"  name="category_id" class="select2 form-control">
                                @foreach($categories as $category)
                                 <option
                                 @if($category_id==$category->id)
                                        selected
                                 @endif
                                 value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label >{{$lng->SubCategory}} </label>
                        <select id="sub_category_id" class="select2 form-control" name="sub_category_id">
                            @foreach($subCategories as $subCategory)
                            <option
                            @if($childCategory->sub_category_id==$subCategory->id)
                                        selected
                                 @endif
                            value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label >{{$lng->Status}} </label>
                        <select name="status" class="select2 form-control">
                            <option {{$childCategory->status==1?"selected":""}} value="1">Enabled</option>
                            <option {{$childCategory->status==0?"selected":""}} value="0">{{$lng->Disabled}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label >{{$lng->URL}} </label>
                        <input  value="{{ $childCategory->slug }}" name="slug"  type="text" class="form-control" placeholder="Enter url">
                        @error('slug')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label >{{$lng->ChildCategoryImage}} </label>
                        <div id="imageUpload" class="dropzone">
                        </div>
                        <input value="{{$childCategory->image}}" type="hidden" name="image" id="image">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label >{{$lng->ChildCategoryBanner}} </label>
                        <div id="bannerUpload" class="dropzone">
                        </div>
                        <input value="{{$childCategory->banner}}" type="hidden" name="banner" id="banner">
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
        });;
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
                    url: "{{route('dropzone.remove', ['path'=>'category' ])}}",
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
          url: "{{route('dropzone.store', ['path'=>'category' ])}}",
          maxFiles: 1
          });
          let imageFile = { name: "{{$childCategory->image}}" };
          imageDropzone.emit("addedfile", imageFile);
          imageDropzone.createThumbnailFromUrl(imageFile, "{{URL::to('/')}}/images/category/{{$childCategory->image}}");
                    setTimeout(function(){
                    $(".dz-remove").html('<i class="ri-close-line"></i>')
                    $(".dz-details").html("")
                },500)
          imageDropzone.emit("complete",imageFile);
          var bannerDropzone = new Dropzone("div#bannerUpload", {
        init: function () {
            this.on("success", function (file, serverFileName) {
                $("#banner").val(serverFileName.name)
                setTimeout(function(){
                    $(".dz-remove").html('<i class="ri-close-line"></i>')
                    $(".dz-details").html("")
                },500)
            })
            this.on("removedfile", function (file) {
                $.ajax({
                    url: "{{route('dropzone.remove', ['path'=>'category' ])}}",
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
          url: "{{route('dropzone.store', ['path'=>'category' ])}}",
          maxFiles: 1
          });
          @if($childCategory->banner)
            let bannerFile = { name: "{{$childCategory->banner}}" };
          bannerDropzone.emit("addedfile", bannerFile);
          bannerDropzone.createThumbnailFromUrl(bannerFile, "{{URL::to('/')}}/images/category/{{$childCategory->banner}}");
                    setTimeout(function(){
                        $(".dz-remove").html('<i class="ri-close-line"></i>')
                        $(".dz-details").html("")
                    },500)
          bannerDropzone.emit("complete",bannerFile);
          @endif    
    })
    $("#category_id").on('change',function(){
        $("#sub_category_id").load("{{URL::to('/admin/load-sub-category')}}/"+$(this).val(), function(responseTxt, statusTxt, xhr){})       
    })
    
</script>
@endsection

