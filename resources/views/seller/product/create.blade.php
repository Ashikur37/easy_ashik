@extends('layouts.vendor',['headerText' => $lng->AddProduct])
@section('title', "$lng->AddProduct")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.css') }}" />
    <script src="{{ asset('assets/admin/js/vendor/dropzone.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/flatpickr.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->AddProduct }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form onsubmit="return validateProduct()" method="post" action="{{ route('vendor.product_store') }}"> 
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item top-info-header border prl-5">
                        <div>
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item"><a id="general-tab" class="nav-link active" href="#tabGeneral"
                                        data-toggle="tab">{{ $lng->General }}</a></li>
                                <li class="nav-item"><a class="nav-link" id="media-tab" href="#tabMedia"
                                        data-toggle="tab">{{ $lng->Media }}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tabAdvance"
                                        data-toggle="tab">{{ $lng->Advance }}</a></li>
                            </ul>
                        </div>
                        <div>
                            <input type="submit" value="{{ $lng->Save }}" class="submit-btn" onclick="validateProduct()">
                        </div>
                    </div>
                </div>
            </div> 
            <div class="tab-content">
                <div role="tablist" class="tab-pane fade show active" id="tabGeneral">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ $lng->Name }} *</label>
                                <input required id="name" name="name" type="text" class="form-control"
                                    placeholder="{{ $lng->EnterProductName }}">
                                <span id="nameError" class="invalid-feedback d-none" role="alert">
                                    <strong> {{ $lng->ProductNameRequired }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>{{ $lng->Price }} *</label>
                                <input required id="price" step=".01" name="price" type="number" class="form-control"
                                    placeholder="{{ $lng->Price }}">
                                <span  id="priceError" class="d-none invalid-feedback" role="alert">
                                    <strong>{{ $lng->ProductPriceRequired }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>{{ $lng->PriceType }}</label>
                                <select name="price_type" id="price_type" class="select2 select2-wide">
                                    <option value="fixed"> {{ $lng->Fixed }} </option>
                                    <option value="discount"> {{ $lng->Discount }} </option>
                                </select>
                            </div>
                            <div id="discountWrapper" class="d-none">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ $lng->DiscountedPrice }}</label>
                                            <input step=".01" name="special_price" type="number" class="form-control"
                                                placeholder="{{ $lng->Price }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ $lng->DiscountType }}</label>
                                            <select name="special_price_type" class="select2 select2-wide">
                                                <option value="fixed"> {{ $lng->Fixed }} </option>
                                                <option value="percent"> {{ $lng->Percent }} </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ $lng->DiscountStart }} </label>
                                            <input name="special_price_start" type="text" class="form-control startDate"
                                                placeholder="{{ $lng->Date }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ $lng->DiscountEnd }}</label>
                                            <input name="special_price_end" class="form-control endDate"
                                                placeholder="{{ $lng->Date }}" type="text" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ $lng->Description }} </label>
                                <textarea required name="details" class="form-control" id="description" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ $lng->Brand }}</label>
                                <select class="select2 select2-wide" name="brand_id">
                                    <option value="">{{ $lng->SelectBrand }}</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{ $lng->Category }} *</label>
                                <select required name="category_id" class="select2 select2-wide" id="category">
                                    <option value="">{{ $lng->SelectCategory }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <span  id="categoryError" class="invalid-feedback d-none" role="alert">
                                    <strong> {{ $lng->CategoryRequired }}</strong>
                                </span>
                            </div>
                            <div id="sub-cat" class="form-group d-none">
                                <label>{{ $lng->SubCategory }}</label>
                                <select name="sub_category_id" class="select2 select2-wide" id="subCategory">
                                </select>
                            </div>
                            <div id="child-cat" class="form-group d-none">
                                <label>{{ $lng->ChildCategory }}</label>
                                <select name="child_category_id" class="select2 select2-wide" id="childCategory">
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label>{{ $lng->FeaturedIn }}</label>
                                <div class="icheck-primary">
                                    <input value="trending" name="trending" type="checkbox" id="checkTranding">
                                    <label for="checkTranding">{{ $lng->Trending }}
                                    </label>
                                </div>
                                <div class="icheck-primary">
                                    <input value="hot" name="hot" type="checkbox" id="checkHot">
                                    <label for="checkHot">{{ $lng->Hot }}
                                    </label>
                                </div>
                                <div class="icheck-primary">
                                    <input value="top" name="top" type="checkbox" id="checkTopRated">
                                    <label for="checkTopRated">{{ $lng->TopRated }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label>{{ $lng->HighlightIn }}</label>
                                <div class="icheck-primary">
                                    <input name="best_deal" type="checkbox" id="checkBestDeal">
                                    <label for="checkBestDeal">{{ $lng->BestDeal }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tablist" class="tab-pane fade" id="tabMedia">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>{{ $lng->Image }} (300X300) *</label>
                                <div id="imageUpload" class="dropzone">
                                </div>
                                <input type="hidden" name="image" id="image">
                                <span id="imageError" class="invalid-feedback d-none" role="alert">
                                    <strong>{{ $lng->ProductImageRequired }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>{{ $lng->Gallery }} (800X800) </label>
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
                                <label>{{ $lng->SKU }}</label>
                                <input name="sku" type="text" class="form-control" placeholder="Enter product sku">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $lng->Quantity }}</label>
                                        <input name="qty" type="text" class="form-control"
                                            placeholder="{{ $lng->Quantity }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $lng->StockAvailability }}</label>
                                        <select name="in_stock" class="select2 select2-wide">
                                            <option value="1">{{ $lng->InStock }}</option>
                                            <option value="0">{{ $lng->OutOfStock }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ $lng->Badge }}</label>
                                <select name="badge[]" class="select2 select2-wide" multiple="multiple" data-placeholder="Select Badges">
                                    @foreach ($badges as $badge)
                                        <option value="{{ $badge->id }}">{{ $badge->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{ $lng->URL }}</label>
                                <input name="slug" type="text" class="form-control" placeholder="{{ $lng->URL }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ $lng->Tag }}s</label>
                                <select name="tag[]" class="select2 select2-wide" multiple="multiple" data-placeholder="Select Tags">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{ $lng->MetaTitle }}</label>
                                <input name="meta_title" type="text" class="form-control"
                                    placeholder="Enter {{ $lng->MetaTitle }}">
                            </div>
                            <div class="form-group">
                                <label>{{ $lng->MetaDescription }}</label>
                                <textarea name="meta_description" class="form-control" id="exampleFormControlTextarea1"
                                    rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="extra-features-wrapper">
                        <div class="row">
                            <div class="col-12 feature-title">
                                <h5>{{ $lng->ProductFeatures }}</h5>
                                <i class="ri-information-line"></i>
                            </div>
                        </div>
                        <div id="attributeWrapper" class="attributeWrapper">
                            <div class="row" id="attributeRow#id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $lng->Feature }}</label>
                                        <select class="select2 select2-wide" onchange="loadAttribute(#id,this.value)"
                                            data-id="#id" name="attributes[#id][attribute_id]">
                                            <option value="">{{ $lng->SelectFeature }}</option>
                                            @foreach ($attributeSets as $attributeSet)
                                                <optgroup label="{{ $attributeSet->name }}">
                                                    @foreach ($attributeSet->attributes as $attribute)
                                                        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $lng->Value }}</label>
                                        <div class="d-flex">
                                            <select id="attribute_value#id" name="attributes[#id][values][]" class="select2 select2-wide"
                                                multiple="multiple">
                                            </select>
                                            <span class="remove-extra-feature"
                                                onclick="document.getElementById('attributeRow#id').remove()"><i
                                                    class="ri-delete-bin-line"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" id="more-attribute"
                                    class="add-extra-feature">{{ $lng->AddNew }}</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 feature-title">
                                <h5>{{ $lng->ProductColor }}</h5>
                            </div>
                        </div>
                        <div id="colorWrapper" class="colorWrapper">
                            <div class="row" id="colorRow#id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $lng->Color }}</label>
                                        <select name="color[]" class="select2 select2-wide">
                                            <option value="">{{ $lng->SelectColor }}</option>
                                            @foreach ($colors as $color)
                                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $lng->ExtraPrice }}</label>
                                        <div class='d-flex'>
                                            <input step=".01" name="color_price[]" type="number" class="form-control"
                                                placeholder="{{ $lng->ExtraPrice }}">
                                            <span class="remove-extra-feature"
                                                onclick="document.getElementById('colorRow#id').remove()"><i
                                                    class="ri-delete-bin-line"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" id="more-color" class="add-extra-feature">{{ $lng->AddNew }}</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 feature-title">
                                <h5>{{ $lng->ProductSize }}</h5>
                            </div>
                        </div>
                        <div id="sizeWrapper" class="sizeWrapper">
                            <div class="row" id="sizeRow#id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $lng->Size }}</label>
                                        <select name="size[]" class="select2-wide select2">
                                            <option value="">{{ $lng->SelectSize }}</option>
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $lng->ExtraPrice }}</label>
                                        <div class='d-flex'>
                                            <input name="size_price[]" type="number" class="form-control"
                                                placeholder="{{ $lng->ExtraPrice }}" step=".01">
                                            <span class="remove-extra-feature"
                                                onclick="document.getElementById('sizeRow#id').remove()"><i
                                                    class="ri-delete-bin-line"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" id="more-size" class="add-extra-feature">{{ $lng->AddNew }}</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 feature-title">
                                <h5>{{ $lng->ExtraOption }}</h5>
                                <i class="ri-information-line"></i>
                            </div>
                        </div>
                        <div>
                            <div class="optionWrapper" id="optionWrapper">
                                <div id="optionRow#id" class="extra-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="option[#id]">{{ $lng->Name }}</label>
                                                <input name="option[#id][name]" type="text" class="form-control"
                                                    placeholder="{{ $lng->Name }}" id="option[#id]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="item-flex">
                                                    <div>
                                                        <div class="emplabel">&nbsp;</div>
                                                        <div class="icheck-primary d-inline">
                                                            <input name="option[#id][required]" type="checkbox"
                                                                id="checkRequired#id" class="check-element">
                                                            <label for="checkRequired#id"></label>
                                                        </div>
                                                        <label for="checkRequired#id">{{ $lng->Required }} ?</label>
                                                    </div>
                                                    <span onclick="document.getElementById('optionRow#id').remove()"
                                                        class="remove-extra-feature"><i
                                                            class="ri-delete-bin-line"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="labelWrapper#id" class="extra-append-item">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ $lng->Label }}</label>
                                                    <input name="option[#id][label][]" type="text" class="form-control"
                                                        placeholder="{{ $lng->Label }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ $lng->Price }}</label>
                                                    <div class="d-flex">
                                                        <input step=".01" name="option[#id][price][]" type="number"
                                                            class="form-control" placeholder="{{$lng->Price }}">
                                                        <span onclick="this.parentElement.parentElement.parentElement.parentElement.remove();" class="remove-extra-feature"><i
                                                                class="ri-delete-bin-line"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 item-append-btn">
                                        <button data-val="#id" type="button" id="more-label#id"><i
                                                class="ri-add-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" id="more-option"
                                    class="add-extra-feature mb-0">{{ $lng->AddNew }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/vendor/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/ckeditor/ckeditor.js') }}"></script>
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
    if (!$("#category").val()) {
        $("#categoryError").removeClass("d-none");
        $("#general-tab").click();
        return false;
    }

    if (!$("#image").val()) {
        $("#media-tab").click();
        $("#imageError").removeClass("d-none");
        return false;
    }
}
$(function(){

    
    $("#price_type").on('change', function() {
        if ($(this).val() == "discount") {
            $("#discountWrapper").removeClass("d-none");
        } else {
            $("#discountWrapper").addClass("d-none");

        }
    })
    $("#btn1").on('click', function(event) {
        event.preventDefault();
        let valid = true;
        if (!$("#name").val()) {
            $("#nameError").removeClass("d-none")
            valid = false;
        } else {
            $("#nameError").addClass("d-none")
        }
        if (!$("#image").val()) {
            $("#imageError").removeClass("d-none")
            valid = false;
        } else {
            $("#imageError").addClass("d-none")
        }
        if (!$("#price").val()) {
            $("#priceError").removeClass("d-none");
            valid = false;
        } else {
            $("#priceError").addClass("d-none");
        }
        if (!$("#category").val()) {
            $("#categoryError").removeClass("d-none");
            valid = false;
        } else {
            $("#categoryError").addClass("d-none");

        }
        if (!valid) {
            return;
        }
        $("#div1").css("display", "none");
        $("#div2").css("display", "block");   
    });
    
    $("#btn2").on('click', function(event) {
        $("#div2").css("display", "none");
        $("#div1").css("display", "block");
        event.preventDefault();
    });
    $("#name").on('blur',function() {
        if (!$("#name").val()) {
            $("#nameError").removeClass("d-none")
        } else {
            $("#nameError").addClass("d-none")
        }
    })
    $("#price").on('blur',function() {
        if (!$("#price").val()) {
            $("#priceError").removeClass("d-none");
        } else {
            $("#priceError").addClass("d-none");
        }
    })
    $("#category").on('change', function() {
        if (!$("#category").val()) {
            $("#categoryError").removeClass("d-none");
        } else {
            $("#categoryError").addClass("d-none");
        }
    })
    var attributeId = 0;
    var attributeHTML = $("#attributeWrapper").html();
    $("#more-attribute").on('click', function() {
        attributeId++;
        $("#attributeWrapper").append(attributeHTML.split("#id").join(attributeId))
        $('.select2').select2();
    })
    $("#attributeWrapper").html(attributeHTML.split("#id").join('0'))
    
    var colorId = 0;
    var colorHTML = $("#colorWrapper").html();
    $("#more-color").on('click', function() {
        colorId++;
        $("#colorWrapper").append(colorHTML.split("#id").join(colorId))
        $('.select2').select2();
    })
    $("#colorWrapper").html(colorHTML.split("#id").join('0'))
    
    var sizeId = 0;
    var sizeHTML = $("#sizeWrapper").html();
    $("#more-size").on('click', function() {
        sizeId++;
        $("#sizeWrapper").append(sizeHTML.split("#id").join(sizeId))
        $('.select2').select2();
    })
    $("#sizeWrapper").html(sizeHTML.split("#id").join('0'))
    $('.select2').select2();
    var optionId = 0;
    var optionHTML = $("#optionWrapper").html();
    
    $("#more-option").on('click', function() {
        optionId++;
        $("#optionWrapper").append(optionHTML.split("#id").join(optionId))
        $("#more-label" + optionId).on('click', function() {
            labelId++;
    
            $("#labelWrapper" + $(this).data('val')).append(labelHTML.split("#id").join(
                optionId))
        })
    })
    $("#optionWrapper").html(optionHTML.split("#id").join('0'))
    var labelId = 0;
    var labelHTML = `
    <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label > ${lng["Label"] }</label>
            <input name="option[#id][label][]" type="text" class="form-control" placeholder="${lng['Label'] }">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label >${lng["Price"] }</label>
            <div class="d-flex">
                <input name="option[#id][price][]" type="number" class="form-control" placeholder="${lng['Price']}">
                <span class="remove-extra-feature" onclick="this.parentElement.parentElement.parentElement.parentElement.remove();"><i class="ri-delete-bin-line"></i></span>
            </div>
        </div>
    </div>
    </div>`;
    $("#more-label0").on('click', function() {
        labelId++;
        $("#labelWrapper" + $(this).data('val')).append(labelHTML.split("#id").join(labelId))
    })
    $("#labelWrapper").html(labelHTML.split("#id").join('0'))
    
    $("#category").on('change', function() {
        if ($(this).val() == 0) {
            return;
        }
        $("#subCategory").load(adminUrl+"/load-sub-category/" + $(this).val(),
            function(responseTxt, statusTxt, xhr) {
                $("#childCategory").html("")
    
                $("#sub-cat").removeClass("d-none"); 
            })
    })
    $("#subCategory").on('change', function() {
        $("#childCategory").load(adminUrl+"/load-child-category/" + $(this).val(),
            function(responseTxt, statusTxt, xhr) {
                $("#child-cat").removeClass("d-none");
            })
    })
    $('.select2').select2();
    var galleryImages = [];
    var imageDropzone = new Dropzone("div#imageUpload", {
        init: function() {
            this.on("success", function(file, serverFileName) {
                $("#image").val(serverFileName.name)
                setTimeout(function() {
                    $(".dz-remove").html('<i class="ri-close-line"></i>')
                    $(".dz-details").html("")
                }, 500)
                $("#imageError").addClass("d-none")

            })
            this.on("addedfile", function() {
                if ($("#image").val()) {
                    this.removeFile(this.files[0]);
                }
            });
            this.on("removedfile", function(file) {
                $.ajax({
                    url: removeURL,
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
        url: storeURL,
        maxFiles: 1
    });
    var galleryDropzone = new Dropzone("div#galleryUpload", {
        init: function() {
            this.on("success", function(file, serverFileName) {
                setTimeout(function() {
                    $(".dz-remove").html('<i class="ri-close-line"></i>')
                    $(".dz-details").html("")
                }, 500)
                galleryImages.push({
                    filename: file.name,
                    name: serverFileName.name
                })
                $("#gallery").val(
                    JSON.stringify(galleryImages.map(img => img.name))
                );
            })
            this.on("removedfile", function(file) {
                var imageName = galleryImages.filter(img => img.filename == file.name)[
                    0].name;
                $.ajax({
                    url: removeURL,
                    type: "POST",
                    data: {
                        name: imageName,
                    },
                }).done(function() {
                    galleryImages = galleryImages.filter(img => img.filename !=
                        file.name);
                    $("#gallery").val(
                        JSON.stringify(galleryImages.map(img => img.name))
                    );
                })
            })
        },
        addRemoveLinks: true,
        url: storeURL,
        maxFiles: 6
    });
    
})

        Dropzone.autoDiscover = false;
        var storeURL="{{ route('dropzone.store', ['path' => 'product']) }}";
        var removeURL="{{ route('dropzone.remove', ['path' => 'product']) }}";
        $(function() {
            editor = CKEDITOR.replace('description', {
                filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });

        })
        function loadAttribute  (id, val) {
        $("#attribute_value" + id).load(adminUrl+"/load-attribute-value/" + val);
        }
    </script>

@endsection
