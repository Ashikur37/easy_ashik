@extends('layouts.admin',['headerText' => $lng->Add." ".$lng->Feature])
@section('title', "$lng->Add"." "." $lng->Feature") 
@section('style')
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="{{route('attribute.create',1)}}">{{$lng->Add}} {{$lng->Feature}}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form   method="post" action="{{route('attribute.store')}}"  >
           @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="{{route('attribute.index')}}" class="list-btn">{{$lng->SeeList}}</a>
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
                        <label >{{$lng->FeatureSet}} <span>*</span></label>
                        <select name="attribute_set_id" class="select2 form-control">
                            @foreach($attributeSets as $attributeSet)
                                <option value="{{$attributeSet->id}}">{{$attributeSet->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Name}} <span>*</span></label>
                        <input value="{{ old('name') }}" name="name" required type="text" class="form-control" placeholder="Enter feature set name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
               
                <div class="col-md-12 select-wrapper d-none">
                    <div class="form-group">
                        <label >{{$lng->Value}} <span>*</span></label>
                        <select required  name="value[]" class="tag2" multiple="multiple" data-placeholder="Create value" >
                          </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
<script src="{{asset('assets/admin/js/vendor/select2.full.min.js')}}"></script>
<script src="{{asset('assets/admin/js/page/attribute.js')}}"></script>
@endsection