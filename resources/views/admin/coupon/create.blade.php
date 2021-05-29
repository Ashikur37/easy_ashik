@extends('layouts.admin',['headerText' => $lng->AddCoupon])
@section('title', "$lng->AddCoupon")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->AddCoupon}}</a>
    </li>
@endsection
@section('style')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/flatpickr.css">
@endsection
@section('content')
    <div class="container-fluid">
        <form   method="post" action="{{route('coupon.store')}}">
           @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="{{route('coupon.index')}}" class="list-btn">{{$lng->SeeList}}</a>
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
                        <label >{{$lng->CouponCode}} <span>*</span></label>
                        <input name="code" required type="text" class="form-control" placeholder="Enter code">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->DiscountAmount}}</label>
                        <input name="amount" required type="text" class="form-control" placeholder="Enter amount">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->DiscountType}} <span>*</span></label>
                        <select name="is_percent" class="select2 form-control">
                            <option value="1">{{$lng->Percent}}</option>
                            <option value="0">{{$lng->Fixed}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Product}} </label>
                        <select id="product_option" name="all_product" class="select2 form-control">
                            <option value="1">{{$lng->All}}</option>
                            <option value="0">{{$lng->Selected}}</option>
                        </select>
                    </div>
                </div>
            </div>
          <div id="product-wrapper" class="d-none">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label >{{$lng->Product}} </label>
                    <select  name="product[]" class="select2 form-control" multiple="multiple" data-placeholder="{{$lng->SelectProducts}}">
                           @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                           @endforeach
                          </select>
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label >{{$lng->StartDate}}</label>
                    <input name="start" type="text" class="form-control startDate" placeholder="Enter date" id="startDate" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label >{{$lng->EndDate}}</label>
                    <input name="end" class="form-control startDate" placeholder="{{$lng->EndDate}}" type="text" 
                        autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label >{{$lng->MinimumAmount}} </label>
                    <input name="min" type="text" class="form-control" placeholder="{{$lng->MinimumAmount}}" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label >{{$lng->MaximumAmount}}</label>
                    <input name="max" class="form-control" placeholder="Enter {{$lng->MaximumAmount}}" type="text" id="endDate"
                        autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label >{{$lng->Limit}}</label>
                    <input name="limit" type="number" class="form-control" placeholder="{{$lng->Limit}}" >
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
@section('script')
    <!-- Select2 -->
<script src="{{asset('assets/admin/js/vendor/select2.full.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/page/coupon.js') }}"></script>
@endsection