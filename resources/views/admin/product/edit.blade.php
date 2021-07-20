@extends('layouts.admin',['headerText' => $lng->EditProduct])
@section('title', "$lng->EditProduct") 
@section('style')
 <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/dropzone.css"/> 
 <script src="{{asset('assets/admin/js/vendor/dropzone.js')}}"></script>
 <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
 <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/flatpickr.css">
 @endsection
 @section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->EditProduct }}</a>
    </li>
@endsection 
@section('content')
<div class="container-fluid">
<form onsubmit="return validateProduct()" method="post" action="{{route('product.update',$product->id)}}">
    @method('patch')
    @csrf
        <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header border prl-5">
                    <div>
                        <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item"><a id="general-tab" class="nav-link active" href="#tabGeneral" data-toggle="tab">{{$lng->General}}</a></li> 
                        <li class="nav-item"><a class="nav-link" id="media-tab" href="#tabMedia" data-toggle="tab">{{$lng->Media}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tabAdvance" data-toggle="tab">{{$lng->Advance}}</a></li>
                        </ul>
                    </div>
                   <div>
                        <input type="submit" value="{{$lng->Save}}" class="submit-btn">
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div role="tablist" class="tab-pane fade show active" id="tabGeneral">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >{{$lng->Name}} *</label>
                        <input id="name" value="{{$product->name}}"  name="name" type="text" class="form-control" placeholder="{{$lng->EnterProductName}}">
                        <span id="nameError" class="invalid-feedback d-none" role="alert">
                            <strong> {{ $lng->ProductNameRequired }}</strong>
                        </span>
                        </div>                                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >{{$lng->Price }} *</label>
                                <input id="price" step=".01" value="{{$product->actualPrice()}}" name="price" type="number" class="form-control" placeholder="{{ $lng->Price }}">
                                <span  id="priceError" class="d-none invalid-feedback" role="alert">
                                    <strong>{{ $lng->ProductPriceRequired }}</strong>
                                </span>
                                </div>
                                <div class="form-group">
                                <label>Cashback</label>
                                <input value="{{$product->cashback}}"   step=".01" name="cashback" type="number" class="form-control"
                                    placeholder="Cashback">
                                
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >{{$lng->PriceType }} </label>
                                    <select name="price_type" id="price_type" class="select2 select2-wide">
                                        <option {{$product->price_type=='fixed'?'selected':''}} value="fixed"> {{$lng->Fixed}} </option>
                                        <option {{$product->price_type=='discount'?'selected':''}} value="discount"> {{$lng->Discount}} </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="discountWrapper" class="d-none">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >{{$lng->DiscountedPrice }}</label>
                                    <input step=".01" value="{{$product->special_price}}" name="special_price" type="number" class="form-control" placeholder="{{$lng->Discount}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >{{$lng->DiscountType}}</label>
                                        <select name="special_price_type" class="select2 select2-wide">
                                            <option value="fixed" {{$product->special_price_type=='fixed'?'selected':''}}> {{$lng->Fixed}} </option>
                                            <option value="percent" {{$product->special_price_type=='percent'?'selected':''}}> {{$lng->Percent}} </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >{{$lng->DiscountStart }}</label>
                                    <input value="{{$product->special_price_start}}" name="special_price_start" type="text" class="form-control startDate" placeholder="{{$lng->StartDate}}"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label> {{$lng->DiscountEnd }}</label>
                                    <input value="{{$product->special_price_end}}" name="special_price_end" class="form-control endDate" placeholder="{{$lng->EndDate}}" type="text"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label >{{$lng->Description}}</label>
                            <textarea  name="details"  class="form-control" id="description"
                                rows="4"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{$lng->Brand}}</label>
                            <select class="select2 select2-wide" name="brand_id">
                                <option value="">{{$lng->SelectBrand}}</option>
                                @foreach($brands as $brand)
                                    <option {{$brand->id==$product->brand_id?'selected':''}} value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Shops</label>
                            <select class="select2 select2-wide" name="shop_id">
                                <option value="">Select Shop</option>
                                @foreach ($shops as $shop)
                                    <option {{$shop->id==$product->shop_id?'selected':''}} value="{{ $shop->id }}">{{ $shop->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >{{$lng->Category}} *</label>
                            <select required name="category_id" class="select2 select2-wide" id="category">
                                <option value="">{{$lng->SelectCategory}}</option>
                                @foreach($categories as $category)
                                    <option {{$category->id==$product->category_id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >{{$lng->SubCategory}}</label>
                            <select name="sub_category_id" class="select2 select2-wide" id="subCategory">
                                <option value="">{{$lng->SubCategory}}</option>
                                @foreach($product->category->subCategories as $subCategory)
                                <option {{$subCategory->id==$product->sub_category_id?'selected':''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($product->subCategory)
                        <div class="form-group">
                            <label >{{$lng->ChildCategory}}</label>
                            <select name="child_category_id" class="select2 select2-wide" id="childCategory">
                                <option value="">{{$lng->ChildCategory}}</option>
                                    @foreach($product->subCategory->childCategories as $childCategory)
                                        <option  {{$childCategory->id==$product->child_category_id?'selected':''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="form-group mt-3">
                            <label >{{$lng->FeaturedIn}}</label>
                            <div class="icheck-primary">
                                <input {{$product->is_trending?"checked":""}} value="trending" name="trending" type="checkbox" id="checkTranding">
                                <label for="checkTranding">{{$lng->Trending}}
                                </label>
                            </div>
                            <div class="icheck-primary">
                                <input {{$product->is_hot?"checked":""}} value="hot" name="hot" type="checkbox" id="checkHot">
                                <label for="checkHot">{{$lng->Hot}}
                                </label>
                            </div>
                            <div class="icheck-primary">
                                <input {{$product->is_top?"checked":""}} value="top" name="top" type="checkbox" id="checkTopRated">
                                <label for="checkTopRated">{{$lng->TopRated}}
                                </label>
                            </div>

                            <div class="icheck-primary">
                                <input {{$product->is_cod?"checked":""}} value="1" name="is_cod" type="checkbox" id="checkCod">
                                <label for="checkCod">COD
                                </label>
                            </div>
                            <div class="icheck-primary">
                                <input  {{$product->advance_delivery_charge?"checked":""}}value="1" name="advance_delivery_charge" type="checkbox" id="advanceDelivery">
                                <label for="advanceDelivery">Advance Delivery Charge
                                </label>
                            </div>
                            <div class="icheck-primary">
                                <input {{$product->is_offer?"checked":""}} value="1" name="is_offer" type="checkbox" id="isOffer">
                                <label for="isOffer">Offer Product
                                </label>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label >{{$lng->HighlightIn}}</label>
                            <div class="icheck-primary">
                                <input {{$product->best_deal?"checked":""}}  name="best_deal" type="checkbox" id="checkBestDeal">
                                <label for="checkBestDeal">{{$lng->BestDeal}}
                                </label>
                            </div>
                        </div> 
                        <div class="form-group mt-3">
                            <label>Inside Dhaka charge</label>
                                <input name="inside_charge" type="number" class="form-control" value="{{$product->inside_charge}}">
                              
                            </div>
                            <div class="form-group mt-3">
                                <label>Outside Dhaka charge</label>
                                    <input name="outside_charge" type="number" class="form-control" value="{{$product->outside_charge}}">
                                  
                                </div>
                        </div>                   
                    </div>
                </div>
            </div>
             <div role="tablist" class="tab-pane fade" id="tabMedia">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label >{{$lng->Image }} (300X300) *</label>
                            <div id="imageUpload" class="dropzone">
                            </div>
                            <input  type="hidden" name="image" id="image">
                            <span id="imageError" class="invalid-feedback d-none" role="alert">
                                <strong>{{ $lng->ProductImageRequired }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label >{{$lng->Gallery }} (800X800) </label>
                            <div id="galleryUpload" class="dropzone">
                            </div>
                            <input type="hidden" name="gallery" id="gallery">
                        </div>
                    </div>
                </div>
            </div>
             <div role="tablist" class="tab-pane fade" id="tabAdvance">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label >{{$lng->SKU}}</label> 
                    <input value="{{$product->sku}}" name="sku" type="text" class="form-control" placeholder="Enter product sku">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label >{{$lng->Quantity}}</label>
                                <input value="{{$product->qty}}" name="qty" type="text" class="form-control" placeholder="{{$lng->EnterProductName}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >{{$lng->StockAvailability}}</label>
                                <select  name="in_stock" class="select2 select2-wide">
                                    <option {{$product->in_stock==1?'selected':''}} value="1">In stock</option>
                                    <option {{$product->in_stock==0?'selected':''}} value="0">{{$lng->OutOfStock}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label >{{$lng->Badge}}</label>
                            <select  name="badge[]" class="select2 select2-wide" multiple="multiple" data-placeholder="{{$lng->Badge}}">
                                @foreach($badges as $badge)
                                        <option
                                        @if (in_array($badge->id, $productBadges))
                                    selected
                                @endif
                                        value="{{$badge->id}}">{{$badge->name}}</option>
                                @endforeach
                          </select>
                    </div>
                    <div class="form-group">
                        <label >{{$lng->URL}}</label>
                        <input value="{{$product->slug}}" name="slug" type="text" class="form-control" placeholder="{{$lng->URL}}">
                    </div>
                </div>
                <div class="col-md-6">                
                    <div class="form-group">
                        <label >{{$lng->Tag}}s</label>
                        <select name="tag[]" class="select2 select2-wide" multiple="multiple" data-placeholder="{{$lng->Tags}}">
                            @foreach($tags as $tag)
                                    <option 
                                    @if (in_array($tag->id, $productTags))
                                selected
                            @endif
                                    value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label >{{$lng->MetaTitle}}</label>
                        <input value="{{$product->meta_title}}" name="meta_title" type="text" class="form-control" placeholder=" {{$lng->MetaTitle}}">
                    </div>
                    <div class="form-group">
                        <label >{{$lng->MetaDescription}}</label>
                        <textarea name="meta_description" class="form-control" id="exampleFormControlTextarea1"
                            rows="4">{{$product->meta_description}}</textarea>
                    </div>
                </div>
            </div>
            <div class="extra-features-wrapper">
                <div class="row">
                    <div class="col-12 feature-title">
                        <h5>{{$lng->ProductFeatures}}</h5>
                    </div>
                </div>
                <div class="attributeWrapper">
                @foreach($product->attributes as $productAttribute)
                <div class="row" id="attributeRow{{$productAttribute->id}}">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >{{$lng->Feature}}</label>
                                <select onchange="loadAttribute({{$productAttribute->id}},this.value)" data-id="{{$productAttribute->id}}" name="attributes[{{$productAttribute->id}}][attribute_id]" class="select2 select2-wide">
                                    <option value="">{{$lng->SelectFeature}}</option>
                                    @foreach($attributeSets as $attributeSet)
                                        <optgroup label="{{$attributeSet->name}}">
                                            @foreach($attributeSet->attributes as $attribute)
                                                <option
                                                @if($productAttribute->attribute_id==$attribute->id)
                                                    selected
                                                @endif
                                                value="{{$attribute->id}}">{{$attribute->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>                            
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Value</label>
                                <div class="d-flex">
                                    <select id="attribute_value{{$productAttribute->id}}"  name="attributes[{{$productAttribute->id}}][values][]" class="select2 select2-wide" multiple="multiple" data-placeholder="{{$lng->Badge}}">
                                        @foreach($productAttribute->attribute->values as $value)
                                            <option
                                            @if (in_array($value->id, $productAttribute->valuesArray()->toArray()))
                                            selected
                                            @endif
                                            value="{{$value->id}}">{{$value->value}}</option>
                                        @endforeach
                                    </select>
                                    <span onclick="document.getElementById('attributeRow{{$productAttribute->id}}').remove()"
                                    class="remove-extra-feature"><i class="ri-delete-bin-line"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                   <div id="attributeWrapper" class="attributeWrapper">
                        <div class="row" id="attributeRow#id">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >{{$lng->Feature}}</label>
                                    <select onchange="loadAttribute(#id,this.value)" data-id="#id" name="attributes[#id][attribute_id]" class="select2 select2-wide">
                                        <option value="">{{$lng->SelectFeature}}</option>
                                        @foreach($attributeSets as $attributeSet)
                                            <optgroup label="{{$attributeSet->name}}">
                                                @foreach($attributeSet->attributes as $attribute)
                                                    <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >{{$lng->Value}}</label>
                                    <div class="d-flex">
                                        <select id="attribute_value#id" name="attributes[#id][values][]" class="select2 select2-wide" multiple="multiple" data-placeholder="">
                                        </select>
                                        <span class="remove-extra-feature" onclick="document.getElementById('attributeRow#id').remove()"><i class="ri-delete-bin-line"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" id="more-attribute" class="add-extra-feature">{{$lng->AddNew}}</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 feature-title">
                            <h5>{{$lng->ProductColor}}</h5>
                        </div>
                    </div>
                    @php($i=50)
                    <div class="colorWrapper">
                        @foreach($product->colors as $producColor)
                    @php($i++)
                    <div class="row" id="colorRow{{$i}}">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Color</label>
                                <select  name="color[]" class="select2 select2-wide">
                                <option value="">{{$lng->SelectColor}}</option>
                                    @foreach($colors as $color)
                                        <option
                                        {{$color->id==$producColor->color_id?'selected':''}}
                                        value="{{$color->id}}">{{$color->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                            
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >{{$lng->ExtraPrice}}</label>
                                 <div class="d-flex">
                                    <input value="{{$producColor->price}}" name="color_price[]" type="text" class="form-control" placeholder="0">
                                    <span onclick="document.getElementById('colorRow{{$i}}').remove()"
                                    class="remove-extra-feature"><i class="ri-delete-bin-line"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                   <div id="colorWrapper" class="colorWrapper">
                        <div class="row" id="colorRow#id">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label >{{$lng->Color}}</label>
                                    <select  name="color[]" class="select2 select2-wide">
                                    <option value="">{{$lng->SelectColor}}</option>
                                        @foreach($colors as $color)
                                            <option value="{{$color->id}}">{{$color->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >{{$lng->ExtraPrice}}</label>
                                     <div class="d-flex">
                                         <input name="color_price[]" type="text" class="form-control" placeholder="0">
                                         <span onclick="document.getElementById('colorRow#id').remove()"
                                        class="remove-extra-feature"><i class="ri-delete-bin-line"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" id="more-color" class="add-extra-feature">{{$lng->AddNew}}</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 feature-title">
                            <h5>{{$lng->ProductSize}}</h5>
                        </div>
                    </div>
                    @php($i=50)
                    <div class="sizeWrapper">
                        @foreach($product->sizes as $producSize)
                        @php($i++)
                        <div class="row" id="sizeRow{{$i}}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Size</label>
                                    <select  name="size[]" class="select2 select2-wide">
                                    <option value="">{{$lng->SelectSize}}</option>
                                        @foreach($sizes as $size)
                                            <option
                                            {{$size->id==$producSize->size_id?'selected':''}}
                                            value="{{$size->id}}">{{$size->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >{{$lng->ExtraPrice}}</label>
                                    <div class="d-flex">
                                        <input value="{{$producSize->price}}" name="size_price[]" type="text" class="form-control" placeholder="0">
                                        <span onclick="document.getElementById('sizeRow{{$i}}').remove()"
                                    class="remove-extra-feature"><i class="ri-delete-bin-line"></i></span>
                                    </div>
                                </div>
                            </div>                   
                        </div>
                        @endforeach
                    </div>

                   <div id="sizeWrapper" class="sizeWrapper">
                        <div class="row" id="sizeRow#id">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >{{$lng->Size}}</label>
                                    <select  name="size[]" class="select2 select2-wide">
                                    <option value="">{{$lng->SelectSize}}</option>
                                        @foreach($sizes as $size)
                                            <option value="{{$size->id}}">{{$size->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >{{$lng->ExtraPrice}}</label>
                                    <div class="d-flex">
                                        <input name="size_price[]" type="text" class="form-control" placeholder="0">
                                        <span onclick="document.getElementById('sizeRow#id').remove()"
                                         class="remove-extra-feature"><i class="ri-delete-bin-line"></i></span>
                                    </div>
                                </div>
                            </div>                     
                        </div>
                   </div>
                    <div class="row">
                        <div class="col-12">
                        <button type="button" id="more-size" class="add-extra-feature">{{$lng->AddNew}}</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 feature-title">
                            <h5>{{$lng->ExtraOption}}</h5>
                        </div>
                    </div>
                       <div class="optionWrapper">
                        @foreach($product->options as $option)
                        <div  id="optionRow{{$option->option_id}}" class="extra-item">                      
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >{{$lng->Name}}</label>
                                        <input value="{{$option->option->name}}" name="option[{{$option->option_id}}][name]" type="text" class=" form-control" placeholder="{{$lng->Name}}">                                  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="item-flex">
                                            <div>
                                                <div class="emplabel">&nbsp;</div>
                                                <div class="icheck-primary d-inline">
                                                    <input {{$option->option->required==1?'checked':''}} name="option[{{$option->option_id}}][required]" type="checkbox" id="checkboxPrimary{{$option->option_id}}" class="check-element">
                                                    <label for="checkboxPrimary{{$option->option_id}}"></label>
                                                </div>
                                                <label for="checkboxPrimary{{$option->option_id}}">Required</label> 
                                            </div> 
                                            <span onclick="removeOption({{$option->option_id}})"
                                            class="remove-extra-feature"><i class="ri-delete-bin-line"></i>
                                            </span>
                                        </div>                               
                                    </div>
                                </div>
                            </div>
                            <div id="labelWrapper{{$option->option->id}}" class="extra-append-item">
                                @foreach($option->option->values as $value)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label >{{$lng->Label}}</label>
                                        <input value="{{$value->label}}" name="option[{{$option->option_id}}][label][]" type="text" class="form-control" placeholder="{{$lng->Label}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label >{{$lng->ExtraPrice}}</label>
                                            <div class="d-flex">
                                                <input value="{{$value->price}}" name="option[{{$option->option_id}}][price][]" type="text" class="form-control" placeholder="0">
                                                <span onclick="removeLabelRow(this,{{$value->id}})"
                                                class="remove-extra-feature"><i class="ri-delete-bin-line"></i></span>
                                            </div> 
                                        </div>
                                    </div>                               
                                </div>
                                @endforeach
                            </div>
                            <div class="col-12 item-append-btn">
                                <button onclick="addLabel({{$option->option->id}},{{$option->option_id}})"  type="button" id="more-label{{$option->option->id}}"><i class="ri-add-line"></i></button>
                            </div>
                       </div>
                        @endforeach
                       </div>
                        <div class="optionWrapper" id="optionWrapper">
                           <div id="optionRow#id" class="extra-item">                       
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label >{{$lng->Name}}</label>
                                            <input name="option[#id][name]" type="text" class="form-control" placeholder="{{$lng->Name}}"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="item-flex">
                                                <div>
                                                    <div class="emplabel">&nbsp;</div>
                                                    <div class="icheck-primary d-inline">
                                                        <input  name="option[#id][required]" type="checkbox" id="checkRequired#id" class=" check-element">
                                                        <label for="checkRequired#id"></label>
                                                    </div>
                                                    <label for="checkRequired#id">{{$lng->Required}}</label>
                                                 </div>
                                                <span onclick="document.getElementById('optionRow#id').remove()" class="remove-extra-feature"><i class="ri-delete-bin-line"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="labelWrapper#id" class="extra-append-item">
                                    <div class="row" >
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label >{{$lng->Label}}</label>
                                                <input name="option[#id][label][]" type="text" class="form-control" placeholder="{{$lng->Label}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >{{$lng->ExtraPrice}}</label>
                                                 <div class="d-flex">
                                                    <input name="option[#id][price][]" type="text" class="form-control" placeholder="0">
                                                    <span onclick="removeLabelRow(this)"
                                                     class="remove-extra-feature"><i class="ri-delete-bin-line"></i></span>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 item-append-btn">
                                <button data-val="#id" type="button" id="more-label#id"><i class="ri-add-line"></i></button>
                                </div>
                           </div>
                        </div>                    
                    <div class="row">
                        <div class="col">
                        <button type="button" id="more-option" class="add-extra-feature mb-0">{{$lng->AddNew}}</button>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script src="{{asset('assets/admin/js/vendor/select2.full.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/ckeditor/ckeditor.js')}}"></script>
<script>
    "use strict";
    function validateProduct() {
    if (!$("#name").val()) {
        $("#nameError").removeClass("d-none")
        $("#general-tab").click();
        return false;
    }
    if (!$("#price").val()) {
        $("#priceError").removeClass("d-none");
        $("#general-tab").click();
        return false;
    }

    if (!$("#image").val()) {
        $("#media-tab").click();
        $("#imageError").removeClass("d-none");
        return false;
    }
}
Dropzone.autoDiscover = false;
$(function() { 
    var attributeId=-100;
    var attributeHTML=$("#attributeWrapper").html();
    $("#more-attribute").on('click',function(){
        attributeId++;
        $("#attributeWrapper").append(attributeHTML.split("#id").join(attributeId))
        $('.select2').select2();
    })
    $("#attributeWrapper").html(attributeHTML.split("#id").join('0'))
    var colorId=-100;
    var colorHTML=$("#colorWrapper").html();
    $("#more-color").on('click',function(){
        colorId++;
        $("#colorWrapper").append(colorHTML.split("#id").join(colorId))
        $('.select2').select2();
    })
    $("#colorWrapper").html(colorHTML.split("#id").join('0'))
    var sizeId=-100;
    var sizeHTML=$("#sizeWrapper").html();
    $("#more-size").on('click',function(){
        sizeId++;
        $("#sizeWrapper").append(sizeHTML.split("#id").join(sizeId))
        $('.select2').select2();
    })
    $("#sizeWrapper").html(sizeHTML.split("#id").join('0'))

    var optionId=-100;
    var optionHTML=$("#optionWrapper").html();    
    $("#more-option").on('click',function(){
        optionId++;
        $("#optionWrapper").append(optionHTML.split("#id").join(optionId))
        $("#more-label"+optionId).on('click',function(){
        labelId++;
      
        $("#labelWrapper"+$(this).data('val')).append(labelHTML.split("#id").join(optionId))
        })
    })
    $("#optionWrapper").html(optionHTML.split("#id").join('0'))
    var labelId=-100;
    var labelHTML=`<div class="row" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{$lng->Label}}</label>
                            <input name="option[#id][label][]" type="text" class="form-control" placeholder="{{$lng->Label}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{$lng->ExtraPrice}}</label>
                            <div class="d-flex">
                            <input name="option[#id][price][]" type="text" class="form-control" placeholder="0">
                            <span onclick="removeLabelRow(this)"
                            class="remove-extra-feature"><i class="ri-delete-bin-line"></i></span>
                            </div>
                        </div>
                    </div> 
                </div>`;
    $("#more-label0").on('click',function(){
        labelId++;
        $("#labelWrapper"+$(this).data('val')).append(labelHTML.split("#id").join(labelId))
    })
    $("#labelWrapper").html(labelHTML.split("#id").join('0'))
    $("#category").on('change',function(){
        if($(this).val()==0){
            return;
        }
        $("#subCategory").load("{{URL::to('/admin/load-sub-category')}}/"+$(this).val(), function(responseTxt, statusTxt, xhr){          
            $("#childCategory").html("")          
        })      
    })
    $("#subCategory").on('change',function(){
        $("#childCategory").load("{{URL::to('/admin/load-child-category')}}/"+$(this).val(), function(responseTxt, statusTxt, xhr){       
        })      
    })
        $('.select2').select2();
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.on("instanceReady", function(event)
{
    CKEDITOR.instances['description'].insertHtml(`{!!$product->details!!}`);
});
 
   var galleryImages=[];
    var imageDropzone = new Dropzone("div#imageUpload", {
        init: function () {
            this.on("success", function (file, serverFileName) {
                setTimeout(function(){
                            $(".dz-remove").html('<i class="ri-close-line"></i>')
                            $(".dz-details").html("")
                        },500)
                $("#image").val(serverFileName.name)
            })
            this.on("addedfile", function() {
                if ($("#image").val()){
                    this.removeFile(this.files[0]);
                }
                });
            this.on("removedfile", function (file) {
                $.ajax({
                    url: "{{route('dropzone.remove', ['path'=>'product' ])}}",
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
          url: "{{route('dropzone.store', ['path'=>'product' ])}}",
          maxFiles: 1
          });

          let imageFile = { name: "{{$product->image}}" };
          imageDropzone.emit("addedfile", imageFile);
          setTimeout(function(){
                            $(".dz-remove").html('<i class="ri-close-line"></i>')
                            $(".dz-details").html("")
                        },500)
          imageDropzone.createThumbnailFromUrl(imageFile, "{{URL::to('/')}}/images/product/{{$product->image}}");
          imageDropzone.emit("complete",imageFile);
          $("#image").val("{{$product->image}}")
          var galleryDropzone = new Dropzone("div#galleryUpload", {
        init: function () {
            this.on("success", function (file, serverFileName) {
                setTimeout(function(){
                    $(".dz-remove").html('<i class="ri-close-line"></i>')
                    $(".dz-details").html("")
                },500)
                galleryImages.push({
                    filename:file.name,
                    name:serverFileName.name
                })
                $("#gallery").val(
                        JSON.stringify(galleryImages.map(img=>img.name))
                    );
            })
            this.on("removedfile", function (file) {
                var imageName=galleryImages.filter(img=>img.filename==file.name)[0].name;
                $.ajax({
                    url: "{{route('dropzone.remove', ['path'=>'product' ])}}",
                    type: "POST",
                    data: {
                        name: imageName,
                    },
                }).done(function() {
                    galleryImages=galleryImages.filter(img=>img.filename!=file.name);
                    $("#gallery").val(
                        JSON.stringify(galleryImages.map(img=>img.name))
                    );                 
                })
            })
        },
          addRemoveLinks: true,
          url: "{{route('dropzone.store', ['path'=>'product' ])}}",
          maxFiles: 6
          });
          @foreach($product->images as $image)
          var galleryFile = { name: "{{$image->image}}" };
          galleryDropzone.emit("addedfile", galleryFile);
          setTimeout(function(){
                            $(".dz-remove").html('<i class="ri-close-line"></i>')
                            $(".dz-details").html("")
                        },500)
          galleryDropzone.createThumbnailFromUrl(galleryFile, "{{URL::to('/')}}/images/product/{{$image->image}}");
          galleryDropzone.emit("complete",galleryFile);
          galleryImages.push({
                    filename:'{{$image->image}}',
                    name:'{{$image->image}}'
                })
          @endforeach
          $("#gallery").val(
                        JSON.stringify(galleryImages.map(img=>img.name))
                    );
          $("#price_type").on('change',function(){
              if($(this).val()=="discount"){
                  $("#discountWrapper").removeClass("d-none");
              }
              else{
                $("#discountWrapper").addClass("d-none");
              }
          });
          @if($product->price_type=='discount')
          $("#discountWrapper").removeClass("d-none");
          @endif
          $("#btn1").on('click',function (event) {
            $("#div1").css("display", "none");
            $("#div2").css("display", "block");
            event.preventDefault();
        });

        $("#btn2").on('click',function (event) {
            $("#div2").css("display", "none");
            $("#div1").css("display", "block");
            event.preventDefault();
        });
})
@if($product->is_active==0)
document.getElementsByClassName("switch-selection")[0].style.backgroundColor = "#ff446a"
@endif

function loadAttribute (id,val){
    $("#attribute_value"+id).load("{{URL::to('/admin/load-attribute-value')}}/"+val);
}
function removeLabelRow(el,id=null) {
    el.parentElement.parentElement.parentElement.parentElement.remove();
    if(id){
        $.get("{{URL::to('/admin/remove-option-value')}}/"+id, function(data, status){
  });
    }
}
function removeOption(id){
    document.getElementById('optionRow'+id).remove();
    $.get("{{URL::to('/admin/remove-option')}}/{{$product->id}}/"+id, function(data, status){
  });
}
function addLabel(id,optionId){
    var labelHTML=`<div class="row" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>label</label>
                            <input name="option[#id][label][]" type="text" class="form-control" placeholder="Enter price">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{$lng->Price}}</label>
                            <div class="d-flex">
                                <input name="option[#id][price][]" type="text" class="form-control" placeholder="Enter price">
                            <span onclick="removeLabelRow(this)"
                            class="remove-extra-feature"><i class="ri-delete-bin-line"></i></span>
                            </div>
                        </div>
                    </div>
                </div>`
      $("#labelWrapper"+id).append(labelHTML.split("#id").join(optionId))
      $('.select2').select2({
        minimumResultsForSearch: -1
    });
  }
</script>
@endsection