@extends('layouts.admin',['headerText' => $lng->EditFlashSale])
@section('title', "$lng->EditFlashSale")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->EditFlashSale}}</a>
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
        <form method="post" action="{{route('flash-sale.update',$flashSale->id)}}"  >
            @method('patch')
           @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item top-info-header">
                        <div>
                            <a href="{{route('flash-sale.index')}}" class="list-btn">{{$lng->SeeList}}</a>
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
                        <input required value="{{ $flashSale->title }}" name="title" type="text" class="form-control" placeholder="{{$lng->Title}}">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                     <div class="form-group">
                        <label >{{$lng->EndDate}}</label>
                        <input value="{{$flashSale->end}}" required name="end" type="text" class="form-control startDate" placeholder="{{$lng->EndDate}}">
                    </div>
                </div>            
                  <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Image}} </label>
                        <div id="imageUpload" class="dropzone"></div>
                        <input value="{{$flashSale->image}}" type="hidden" name="image" id="image">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div> 
            </div>
            @foreach($flashSale->products as $flashProduct)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group permission-wrapper d-none">
                        <label >{{$lng->Product}} </label>
                        <select required  name="product[]" class="select2 select2-wide" data-placeholder="{{$lng->SelectProducts}}"  >
                            <option value="">{{$lng->SelectProducts}}</option>
                            @foreach($products as $product)
                                <option {{$flashProduct->product_id==$product->id?'selected':''}} value="{{$product->id}}">#{{$product->id}} {{$product->name}} --{{$product->getSpecialPriceCurrency()}}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"  >
                        <label >{{$lng->Price}} </label>
                    <input value="{{$flashProduct->price}}" required type="number" name="price[]" class="form-control" placeholder="{{$lng->Price}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"  >
                        <label >{{$lng->Quantity}} </label>
                        <div class="d-flex">
                            <div class="w-100"><input value="{{$flashProduct->qty}}" required type="number" name="qty[]" class="form-control" placeholder="{{$lng->Quantity}}"></div>
                            <span class="remove-extra-feature" onclick="removeProductRow(this,{{$flashProduct->id}})"><i class="ri-delete-bin-line"></i><span>
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
                    url: "{{route('dropzone.remove', ['path'=>'flash-sale' ])}}",
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
          url: "{{route('dropzone.store', ['path'=>'flash-sale' ])}}",
          maxFiles: 1
          });
          let imageFile = { name: "{{$flashSale->image}}" };
          imageDropzone.emit("addedfile", imageFile);
          imageDropzone.createThumbnailFromUrl(imageFile, "{{URL::to('/')}}/images/flash-sale/{{$flashSale->image}}");
          setTimeout(function(){
                    $(".dz-remove").html('<i class="ri-close-line"></i>')
                    $(".dz-details").html("")
            },500)
          imageDropzone.emit("complete",imageFile);

})
function removeProductRow(el,id=null){
    el.parentElement.parentElement.parentElement.parentElement.remove()
    if(id){
        $.get("{{URL::to('/admin/remove-flash-product')}}/"+id, function(data, status){
    });
    }
}
</script>
@endsection
