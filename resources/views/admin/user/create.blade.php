@extends('layouts.admin',['headerText' => $lng->AddUser])
@section('title', "$lng->AddUser")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.css') }}" />
    <script src="{{ asset('assets/admin/js/vendor/dropzone.js') }}"></script>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->AddUser }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ route('user.store') }}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item top-info-header">
                        <div>
                            <a href="{{ route('user.index') }}" class="list-btn">{{ $lng->SeeList }}</a>
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
                        <label>{{ $lng->FirstName }} <span>*</span></label>
                        <input value="{{ old('name') }}" name="name" required type="text" class="form-control"
                            placeholder="{{ $lng->FirstName }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->LastName }} <span>*</span></label>
                        <input value="{{ old('lastname') }}" name="lastname" required type="text" class="form-control"
                            placeholder="{{ $lng->LastName }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->Email }} <span>*</span></label>
                        <input value="{{ old('email') }}" name="email" type="text" class="form-control"
                            placeholder="Enter email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->Password }} <span>*</span></label>
                        <input required name="password" required type="password" class="form-control"
                            placeholder="Enter password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->ConfirmPassword }} <span>*</span></label>
                        <input required name="password_confirmation" type="password" class="form-control"
                            placeholder="Enter confirm">
                    </div>
                </div>
                <div class="col-md-6 d-none" id="permission-wrapper">
                    <div class="form-group">
                        <label>{{ $lng->Role }} <span>*</span></label>
                        <select required name="role[]" class="select2 form-control" multiple="multiple"
                            data-placeholder="{{ $lng->Permissions }}">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->Image }} </label>
                        <div id="avatarUpload" class="dropzone">
                        </div>
                        <input type="hidden" name="avatar" id="avatar">
                    </div>
                </div>
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
            $("#permission-wrapper").removeClass("d-none");
            $('.select2').select2();
            var avatarDropzone = new Dropzone("div#avatarUpload", {
                init: function() {
                    this.on("success", function(file, serverFileName) {
                        $("#avatar").val(serverFileName.name)
                    })
                    this.on("removedfile", function(file) {
                        $.ajax({
                            url: "{{ route('dropzone.remove', ['path' => 'user']) }}",
                            type: "POST",
                            data: {
                                name: $("#avatar").val(),
                            },
                        }).done(function() {
                            $("#avatar").val("");
                        })
                    })
                },
                addRemoveLinks: true,
                url: "{{ route('dropzone.store', ['path' => 'user']) }}",
                maxFiles: 1
            });
        })

    </script>
@endsection
