@extends('layouts.front')
@section('title', "$lng->Contact")
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/page/contact.css">
@endsection
@section('content')
<div class="contact-us-page white-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h2 class="header-title white-bg">{{$lng->ContactUs}}</h2>
            </div>
        </div>
    </div>
    <div class="contact-us-body">
        <div class="container">
           <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="contact-form white-bg">
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
                    <div class="contact-info white-bg">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-wrapper">
                                    <div class="info-icon">
                                        <i class="ri-map-pin-line icon"></i>
                                    </div>
                                    <div class="info-desc">
                                        <span class="info-title">{{$lng->Address}}</span>
                                        <p>{{$setting->address2}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-wrapper">
                                    <div class="info-icon">
                                        <i class="ri-mail-line icon"></i>
                                    </div>
                                    <div class="info-desc">
                                        <span class="info-title">{{$lng->Email}}</span>
                                        <p>
                                            <a href="mailto:{{$setting->mail1}}">{{$setting->mail1}}</a>
                                            <br />
                                            <a href="mailto:{{$setting->mail2}}">{{$setting->mail2}}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-wrapper">
                                    <div class="info-icon">
                                        <i class="ri-phone-fill icon"></i>
                                    </div>
                                    <div class="info-desc">
                                        <span class="info-title">{{$lng->CallUs}}</span>
                                        <p>
                                            <a href="tel:{{$setting->phone1}}">
                                                {{$setting->phone1}}
                                            </a>
                                            <br />
                                            <a href="tel:{{$setting->phone2}}">
                                                {{$setting->phone2}}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>        
           </div>
        </div>
    </div>
</div>
@if($setting->is_map)
<div class="white-bg mb-20 sm-mb-10">
    <div class="container ">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="location">
                <h2 class="header-title">{{$lng->OurLocation}}</h2>      
                    <iframe title="Google Map" src="https://maps.google.com/maps?q={{$setting->lat}},{{$setting->lon}}&z=15&output=embed" height="400"></iframe>
                </div>
            </div>
        </div>    
    </div>
</div>
@endif
@endsection