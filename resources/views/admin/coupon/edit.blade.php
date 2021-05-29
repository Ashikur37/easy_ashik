@extends('layouts.admin',['headerText' => $lng->EditCoupon])
@section('title', "$lng->EditCoupon")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->EditCoupon}}</a>
    </li>
@endsection
@section('style')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/flatpickr.css">
@endsection
@section('content')
    <div class="container-fluid">
        <form   method="post" action="{{route('coupon.update',$coupon->id)}}">
           @csrf
           @method('patch')
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
                        <input value="{{$coupon->code}}" name="code" required type="text" class="form-control" placeholder="Enter code">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->DiscountAmount}}</label>
                        <input value="{{$coupon->amount}}" name="amount" required type="text" class="form-control" placeholder="{{$lng->DiscountAmount}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->DiscountType}} <span>*</span></label>
                        <select name="is_percent" class="select2 form-control">
                            <option value="1">{{$lng->Percent}}</option>
                            <option {{$coupon->is_percent==0?'selected':''}} value="0"> {{$lng->Fixed}} </label>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Product}} </label>
                        <select id="product_option" name="all_product" class="select2 form-control">
                            <option value="1">{{$lng->All}}</option>
                            <option {{$coupon->all_product==0?'selected':''}} value="0">Selected</option>
                        </select>
                    </div>
                </div>
            </div>
          <div id="product-wrapper"
          @if($coupon->all_product==1) 
          class="d-none"
          @endif
           >
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label >{{$lng->Product}} </label>
                        <select  name="product[]" class="select2 form-control" multiple="multiple" data-placeholder="{{$lng->Products}}">
                           @foreach($products as $product)
                        <option {{in_array($product->id,$couponProducts)?'selected':''}} value="{{$product->id}}">{{$product->name}}</option>
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
                    <input value="{{$coupon->start}}" name="start" type="text" class="form-control startDate" placeholder="Enter date" id="startDate">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group"> 
                    <label >{{$lng->EndDate}}</label>
                <input value="{{$coupon->end}}" name="end" class="form-control startDate" placeholder="{{$lng->EndDate}}" type="text" id="endDate"
                        autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label >{{$lng->MinimumAmount}} </label>
                    <input value="{{$coupon->min}}" name="min" type="text" class="form-control" placeholder="{{$lng->MinimumAmount}}" id="startDate">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label >{{$lng->MaximumAmount}}</label>
                    <input value="{{$coupon->max}}" name="max" class="form-control" placeholder="{{$lng->MaximumAmount}}" type="text" id="endDate"
                        autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label >{{$lng->Limit}}</label>
                    <input value="{{$coupon->limit=='-1'?'':$coupon->limit}}" name="limit" type="number" class="form-control" placeholder="{{$lng->Limit}}" id="startDate">
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