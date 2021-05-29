@section('title', "$lng->EmailSetting")
@extends('layouts.admin',['headerText' => $lng->EmailSetting])
@section('title', "$lng->EmailSetting")
@section('title', "$lng->GroupEmail")
@section('style')
<link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->EmailSetting}}</a>
    </li>
@endsection 
@section('content')  
<div class="container-fluid">
<form method="post" action="{{URL::to('admin/email-config')}}">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header">
                    <div>
                        <a href="{{URL::to('/admin/group-email')}}" class="list-btn">
                                {{$lng->Send}} {{$lng->Email}}
                        </a>
                    </div>
                    <div>
                        <input type="submit" value="{{$lng->Save}}" class="submit-btn">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">    
                    <label >{{$lng->EmailFeature}}</label>
                    <div class="d-flex align-items-center justify-content-between featured-status">
                        <label class="mt-2">{{$lng->Status}}</label>
                        <label class="ts-swich-label">
                            <input {{$emailSetting->is_active?'checked':''}}  name="is_active" type="checkbox" class="switch ts-swich-input" >
                            <span class="ts-swich-body"></span>
                        </label>
                    </div>
                </div> 
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label >{{$lng->MailHost}} <span>*</span></label>
                   <input value="{{$emailSetting->smtp_host}}" required  name="smtp_host" type="text" class="form-control" placeholder="{{$lng->MailHost}}">
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label >{{$lng->MailUsername}} <span>*</span></label>
                <input required value="{{$emailSetting->smtp_user}}"  name="smtp_user" type="text" class="form-control" placeholder="{{$lng->EnterUsername}}">
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label >{{$lng->MailPassword}} <span>*</span></label>
                   <input value="{{$emailSetting->smtp_pass}}" required   name="smtp_pass" type="password" class="form-control" placeholder="{{$lng->MailPassword}}">
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label >{{$lng->MailPort}} <span>*</span></label>
                   <input value="{{$emailSetting->smtp_port}}" required   name="smtp_port" type="text" class="form-control" placeholder="{{$lng->MailPort}}t">
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label >{{$lng->MailFromAddress}} <span>*</span></label>
                   <input value="{{$emailSetting->from_email}}" required   name="from_email" type="text" class="form-control" placeholder="{{$lng->MailFromAddress}}">
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label >{{$lng->MailFromName}} <span>*</span></label>
                   <input value="{{$emailSetting->from_name}}" required name="from_name" type="text" class="form-control" placeholder="{{$lng->MailFromName}}">
                </div>
            </div> 
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label >{{$lng->MailEncryption}} <span>*</span></label>
                   <select name="mail_encryption" class="select2 form-control">
                       <option {{$emailSetting->mail_encryption=='tls'?'selected':''}} value="tls">TLS</option>
                       <option {{$emailSetting->mail_encryption=='ssl'?'selected':''}} value="ssl">SSL</option>
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
    $(function() {
        $('.select2').select2({
        minimumResultsForSearch: -1
        });
    })
</script>
@endsection