@extends('layouts.front')
@section('title', "$lng->Maintenance")
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/page/maintenence.css">
@endsection
@section('content')
<div class="maintenence-page">
    <div class="mentenence-message">
        <div class="container">
            <div class="row">
                <div class="col-12"> {!!$setting->maintenance_text!!}</div>
            </div>
        </div>
    </div>
    <div class="contact-us">
       <div class="container">
            <h3 class="header-title">{{$lng->ContactUs}}</h3>
            <div class="contact-form">
                <form method="POST" action="{{route('contact.submit')}}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">{{$lng->Name}} *</label>
                                <input required name="name" type="text" class="form-control" id="name" placeholder="{{$lng->Name}}" />
                            </div>
                            <div class="form-group">
                                <label for="email">{{$lng->Email}} *</label>
                                <input required name="email" type="email" class="form-control" id="email" placeholder="{{$lng->Email}}" />
                            </div>
                            <div class="form-group">
                                <label for="subject">{{$lng->Subject}}</label>
                                <input required name="subject" type="text" class="form-control" id="subject" placeholder="{{$lng->Subject}}" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text__area__wrapper">
                                <div class="form-group">
                                    <label for="message">{{$lng->Message}} *</label>
                                    <textarea required name="message" cols="100" class="form-control" id="message" rows="3"></textarea>
                                </div>
                                <button class="ri-send-plane-fill paper__icon" aria-label="Submit">
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>        
        </div>
    </div>    
</div>
@endsection