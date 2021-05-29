@extends('layouts.admin',['headerText' => $lng->AddFAQ])
@section('title', "$lng->AddFAQ")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->AddFAQ}}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{route('faq.store')}}">
           @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="{{route('faq.index')}}" class="list-btn">{{$lng->SeeList}}</a>
                        </div>
                       <div>
                            <input type="submit" value="{{$lng->Save}}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label >{{$lng->Title}} <span>*</span></label>
                        <input id="title" value="{{ old('title') }}" name="title" required type="text" class="form-control" placeholder="{{$lng->Title}}">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label >{{$lng->Body}} </label>
                        <textarea name="details" class="form-control" rows="6"></textarea>
                    </div>
                </div> 
            </div> 
        </form>
    </div>
@endsection



