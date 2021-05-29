@extends('layouts.admin',['headerText' => $lng->Profile])
@section('title', "$lng->Profile")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.css') }}" />
    <script src="{{ asset('assets/admin/js/vendor/dropzone.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#"> {{ $lng->Profile }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ URL::to('admin/update-password') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="flex-item  top-info-header">
                                <div class="align-self-start">
                                    <h4 class="mb-0">{{ $lng->ChangePassword }}</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ $lng->OldPassword }}</label>
                                <input required type="password" class="form-control" id="oldpassword" name="old_password"
                                    placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ $lng->NewPassword }}</label>
                                <input required type="password" class="form-control" id="oldpassword" name="password"
                                    placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ $lng->ConfirmNewPassword }}</label>
                                <input required type="password" class="form-control" id="oldpassword"
                                    name="password_confirmation" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="submit" value="{{ $lng->Save }}" class="submit-btn">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <form method="post" action="{{ URL::to('admin/update-profile') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="flex-item  top-info-header">
                                <div class="align-self-start">
                                    <h4 class="mb-0">{{ $lng->ChangeProfile }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ $lng->FirstName }}</label>
                                <input value="{{ auth()->user()->name }}" required type="text" class="form-control"
                                    name="name" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ $lng->LastName }}</label>
                                <input value="{{ auth()->user()->lastname }}" required type="text" class="form-control"
                                    name="lastname" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ $lng->Email }}</label>
                                <input value="{{ auth()->user()->email }}" required type="email" class="form-control"
                                    name="email" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="submit" value="{{ $lng->Save }}" class="submit-btn">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
