@extends('layouts.admin',['headerText' => $lng->GroupEmail])
@section('title', "$lng->GroupEmail")
@section('style')
<link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->GroupEmail}}</a>
    </li>
@endsection 
@section('content') 
<div class="container-fluid">
<form method="post" action="{{URL::to('/admin/send-email')}}"  >
       @csrf
        <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header">
                    <div>
                        <a href="{{URL::to('admin/subscriber')}}" class="list-btn">
                            {{$lng->SubscriberList}} 
                        </a>  
                    </div>
                    <div>
                        <input type="submit" value="Send" class="submit-btn">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label >{{$lng->Group}} <span>*</span></label>
                    <select name="group"  class="select2 form-control">
                    <option value="subscriber">{{$lng->Subscriber}}</option>
                        <option value="customer">{{$lng->Customer}}</option>
                        <option value="user">{{$lng->User}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label >{{$lng->Subject}} <span>*</span></label>
                    <input type="text" class="form-control" placeholder="Enter subject" required name="subject">
                </div>
                <div class="form-group">
                    <label >{{$lng->Body}} <span>*</span></label>
                    <textarea required name="body"   class="form-control" id="description"
                    rows="4"></textarea>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script src="{{asset('assets/admin/js/vendor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/select2.full.min.js')}}"></script>
<script>
    $(function() {
        $('.select2').select2({
        minimumResultsForSearch: -1
        });
        CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
        });
    })
</script>
@endsection