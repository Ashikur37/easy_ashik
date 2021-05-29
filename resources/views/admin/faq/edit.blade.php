@extends('layouts.admin',['headerText' => $lng->EditFAQ])
@section('title', "$lng->EditFAQ")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->EditFAQ}}</a>
    </li>
@endsection 
@section('content')
    <div class="container-fluid">
        <form   method="post" action="{{route('faq.update',$faq->id)}}">
            @method('patch')
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
                        <input id="title" value="{{ $faq->title }}" name="title" required type="text" class="form-control" placeholder="Enter title">
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
                        <textarea name="details" class="form-control" rows="6">{{ $faq->details }}</textarea>
                    </div>    
                </div>
                </div>
        </form>
    </div>
@endsection



