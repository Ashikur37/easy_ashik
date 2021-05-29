@extends('layouts.admin',['headerText' => $lng->EditFeatureSet])
@section('title', "$lng->EditFeatureSet")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="{{route('attribute-set.edit',$attributeSet->id)}}">{{$lng->EditFeatureSet}}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form   method="post" action="{{route('attribute-set.update',$attributeSet->id)}}"  >
           @csrf
           @method('patch')
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="{{route('attribute-set.index')}}" class="list-btn">{{$lng->SeeList}}</a>
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
                        <label >{{$lng->Name}} <span>*</span></label>
                        <input value="{{$attributeSet->name}}" name="name" required type="text" class="form-control" placeholder="Enter feature name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div> 
        </form>
    </div>
@endsection

