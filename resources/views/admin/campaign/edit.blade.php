@extends('layouts.admin',['headerText' => "Edit Campaign"])
@section('title', "Edit Campaign")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">Edit Campaign</a>
    </li>
@endsection
@section('style')
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/flatpickr.css">
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/dropzone.css"/> 
  <script src="{{asset('assets/admin/js/vendor/dropzone.js')}}"></script>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{route('campaign.update',$campaign->id)}}"  >
            @method('patch')
           @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item top-info-header">
                        <div>
                            <a href="{{route('campaign.index')}}" class="list-btn">{{$lng->SeeList}}</a>
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
                        <label >{{$lng->Title}} </label>
                        <input required value="{{ $campaign->title }}" name="title" type="text" class="form-control" placeholder="{{$lng->Title}}">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                     
                </div>            
                  <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Image}} </label>
                        <div id="imageUpload" class="dropzone"></div>
                        <input value="{{$campaign->image}}" type="hidden" name="image" id="image">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div> 
            </div>
            @foreach($campaign->products as $campaignProduct)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group permission-wrapper d-none">
                        <label >{{$lng->Product}} </label>
                        <select required  name="product[]" class="select2 select2-wide" data-placeholder="{{$lng->SelectProducts}}"  >
                            <option value="">{{$lng->SelectProducts}}</option>
                            @foreach($products as $product)
                                <option {{$campaignProduct->product_id==$product->id?'selected':''}} value="{{$product->id}}">#{{$product->id}} {{$product->name}} --{{$product->getSpecialPriceCurrency()}}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"  >
                        <label >{{$lng->Price}} </label>
                    <input value="{{$campaignProduct->price}}" required type="number" name="price[]" class="form-control" placeholder="{{$lng->Price}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"  >
                        <label >{{$lng->Quantity}} </label>
                        <div class="d-flex">
                            <div class="w-100"><input value="{{$campaignProduct->qty}}" required type="number" name="qty[]" class="form-control" placeholder="{{$lng->Quantity}}"></div>
                            <span class="remove-extra-feature" onclick="removeProductRow(this,{{$campaignProduct->id}})"><i class="ri-delete-bin-line"></i><span>
                        </div>
                    </div>                
                </div>              
            </div>
            @endforeach
            <div id="product-wrapper-html" class="d-none">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group permission-wrapper d-none">
                            <label >{{$lng->Product}} </label>
                            <select require  name="product[]" class="select2 select2-wide" data-placeholder="Select product" placeholder="{{$lng->Product}}">
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">#{{$product->id}} {{$product->name}} --{{$product->getSpecialPriceCurrency()}}</option>
                                    @endforeach
                              </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"  >
                            <label >{{$lng->Price}} </label>
                            <input require type="number" name="price[]" class="form-control" placeholder="{{$lng->Price}}">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group"  >
                            <label >{{$lng->Quantity}}  </label>
                            <div class="d-flex">
                                <div class="w-100"><input require type="number" name="qty[]" class="form-control" placeholder="{{$lng->Quantity}} "></div>
                                <span class="remove-extra-feature" onclick="removeProductRow(this)"><i class="ri-delete-bin-line"></i></span>
                            </div>
                        </div>  
                    </div>   
                </div>
            </div>
           <div id="product-wrapper">
           </div>
        <button type="button" id="moreProduct" class="add-extra-feature ml-0">{{$lng->AddMore}}</button>
        </form>
    </div>
@endsection
@section('script')
<script src="{{asset('assets/admin/js/vendor/select2.full.min.js')}}"></script>
<script>
    Dropzone.autoDiscover = false;
    $(function() {
    var productHTML=document.getElementById("product-wrapper-html").innerHTML.split('require').join('required');
    $("#moreProduct").on('click',function(){
        $("#product-wrapper").append(productHTML);
        $(".permission-wrapper").removeClass("d-none");
        $('.select2').select2();
    });
    $(".permission-wrapper").removeClass("d-none");
    $('.select2').select2();
    var imageDropzone = new Dropzone("div#imageUpload", {
        init: function () {
            this.on("success", function (file, serverFileName) {
                $("#image").val(serverFileName.name)
                    setTimeout(function(){
                        $(".dz-remove").html('<i class="ri-close-line"></i>')
                        $(".dz-details").html("")
                    },500)
            })
            this.on("removedfile", function (file) {
                $.ajax({
                    url: "{{route('dropzone.remove', ['path'=>'campaign' ])}}",
                    type: "POST",
                    data: {
                        name: $("#image").val(),
                    },
                }).done(function() {
                    $("#image").val("");

                })
            })
        },
          addRemoveLinks: true,
          url: "{{route('dropzone.store', ['path'=>'campaign' ])}}",
          maxFiles: 1
          });
          let imageFile = { name: "{{$campaign->image}}" };
          imageDropzone.emit("addedfile", imageFile);
          imageDropzone.createThumbnailFromUrl(imageFile, "{{URL::to('/')}}/images/campaign/{{$campaign->image}}");
          setTimeout(function(){
                    $(".dz-remove").html('<i class="ri-close-line"></i>')
                    $(".dz-details").html("")
            },500)
          imageDropzone.emit("complete",imageFile);

})
function removeProductRow(el,id=null){
    el.parentElement.parentElement.parentElement.parentElement.remove()
    if(id){
        $.get("{{URL::to('/admin/remove-campaign-product')}}/"+id, function(data, status){
    });
    }
}
</script>
@endsection
