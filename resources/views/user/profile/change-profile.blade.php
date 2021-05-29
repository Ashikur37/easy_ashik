@extends('layouts.user')
@section('title', "Change Profile")
@section('pageStyle')
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/dropzone.css"/> 
@endsection
@section('content')
<div class="user-panel-content-wrapper">
    <div class="main-content-wrapper changepassword-container">
        <h4 class="section-title">Update Profile</h4>
        <form action="{{route('user.update-profile')}}" method="POST" class="changePassword-form">
            @csrf         
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="oldpassword">First Name</label>
                        <input value="{{auth()->user()->name}}" required type="text" class="form-control" id="oldpassword" name="name" placeholder="" />
                    </div>
                </div>  
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="password">Last Name</label>
                        <input value="{{auth()->user()->lastname}}" required type="text" class="form-control" id="password" name="lastname" placeholder="" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="confirmpassword">Email</label>
                        <input value="{{auth()->user()->email}}" required type="email" class="form-control" id="confirmpassword" name="email" placeholder="" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="confirmpassword">Phone</label>
                        <input value="{{auth()->user()->contact_number}}" required type="text" class="form-control" id="confirmpassword" name="contact_number" placeholder="" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="confirmpassword">Date Of Birth</label>
                        <input value="{{auth()->user()->dob}}" required type="date" class="form-control" id="confirmpassword" name="dob" placeholder="" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="confirmpassword">Gender</label>
                        <input {{auth()->user()->gender=="male"?"checked":""}} value="male" required type="radio" class="form-control" id="confirmpassword" name="gender" placeholder="" />Male
                        <input {{auth()->user()->gender=="female"?"checked":""}} value="female" required type="radio" class="form-control" id="confirmpassword" name="gender" placeholder="" />Female
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                      <div class="form-group">
                        <label for="">Profile Image </label>
                        <div id="imageUpload" class="dropzone">
                        </div>
                        <input type="hidden" name="image" id="image">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    </div>
                    </div>
            <div class="form-group mb-10">
                <input class="default-btn" type="submit" value="{{$lng->Save}}">
            </div>
        </form>
    </div>
</div>
@endsection


@section('pageScripts')
<script src="{{asset('assets/admin/js/vendor/select2.full.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/dropzone.js')}}"></script>
<script>
    Dropzone.autoDiscover = false;
    $(function() {
      
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
                    url: "{{route('dropzone.remove', ['path'=>'user' ])}}",
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
          url: "{{route('dropzone.store', ['path'=>'user' ])}}",
          maxFiles: 1
          });

          
    })
</script>
@endsection