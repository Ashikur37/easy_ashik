@extends('layouts.admin',['headerText' => $lng->EditFeature])
@section('title', "$lng->EditFeature") 
@section('style')
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
    <a href="{{route('attribute.edit',$attribute->id)}}">{{$lng->EditFeature}}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form   method="post" action="{{route('attribute.update',$attribute->id)}}"  >
           @csrf
           @method('patch')
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
            <div class="mt-3 row"> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->FeatureSet}} <span>*</span></label>
                        <select name="attribute_set_id" class="select2 form-control">
                            @foreach($attributeSets as $attributeSet)
                                <option
                                {{$attribute->attribute_set_id==$attributeSet->id?"selected":""}}
                                value="{{$attributeSet->id}}">{{$attributeSet->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Name}} <span>*</span></label>
                    <input value="{{$attribute->name}}" name="name" required type="text" class="form-control" placeholder="Enter feature set name">
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
                        <select required  name="value[]" class="tag2" multiple="multiple" data-placeholder="Create value">
                            @foreach($values as $value)
                        <option selected value="{{$value}}">{{$value}}</option>
                            @endforeach
                          </select>
                          <input type="hidden"  name="remove[]" id="removeVal">
                           
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
<script src="{{asset('assets/admin/js/vendor/select2.full.min.js')}}"></script>
<script src="{{asset('assets/admin/js/page/attribute.js')}}"></script>
<script>
    $(function() {
        $('.tag2').on('select2:unselect', function (e) {           
            $.ajax({url: "{{URL::to('/admin/attribute/remove-value')}}/{{$attribute->id}}/"+e.params.data.text, success: function(result){
            }});
        });
    });
</script>
@endsection