@extends('layouts.admin',['headerText' => $lng->AddFlashSale])
@section('title', "$lng->AddFlashSale")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->AddFlashSale }}</a>
    </li>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/flatpickr.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.css') }}" />
    <script src="{{ asset('assets/admin/js/vendor/dropzone.js') }}"></script>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ route('flash-sale.store') }}" onsubmit="return validateFlashSale()">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item top-info-header">
                        <div>
                            <a href="{{ route('flash-sale.index') }}" class="list-btn">{{ $lng->SeeList }}</a>
                        </div>
                        <div>
                            <input type="submit" value="{{ $lng->Save }}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->Title }} </label>
                        <input required value="{{ old('title') }}" name="title" type="text" class="form-control"
                            placeholder="{{ $lng->Title }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ $lng->EndDate }}<span id="endDateError" class="invalid-feedback d-none"
                                role="alert">
                                <strong> {{ $lng->Required }}</strong>
                            </span></label>
                        <input required name="end" type="text" class="form-control startDate"
                            placeholder="{{ $lng->EndDate }}" id="end-date">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->Image }} </label>
                        <div id="imageUpload" class="dropzone">
                        </div>
                        <input type="hidden" name="image" id="image">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div id="product-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group permission-wrapper d-none">
                            <label>{{ $lng->Product }} </label>
                            <select required name="product[]" class="select2 select2-wide" data-placeholder="{{ $lng->SelectProducts }}">
                                <option value="">{{ $lng->SelectProducts }}</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">#{{ $product->id }} {{ $product->name }}
                                        {{ $product->name }} ({{ $product->getSpecialPriceCurrency() }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ $lng->Price }} </label>
                            <input required type="number" name="price[]" class="form-control"
                                placeholder="{{ $lng->Price }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ $lng->Quantity }} </label>
                            <div class="d-flex">
                               <div class="w-100"><input required type="number" name="qty[]" class="form-control"
                                    placeholder="{{ $lng->Quantity }}"></div>
                                <span class="remove-extra-feature" onclick="removeProductRow(this)"><i
                                        class="ri-delete-bin-line"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="moreProduct" class="add-extra-feature ml-0">{{ $lng->AddMore }}</button>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/vendor/select2.full.min.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;
        $(function() {
            var productHTML = document.getElementById("product-wrapper").innerHTML;
            $("#moreProduct").on('click', function() {
                $("#product-wrapper").append(productHTML);
                $(".permission-wrapper").removeClass("d-none");
                $('.select2').select2();
            });
            $(".permission-wrapper").removeClass("d-none");
            $('.select2').select2();
            var imageDropzone = new Dropzone("div#imageUpload", {
                init: function() {
                    this.on("success", function(file, serverFileName) {
                        $("#image").val(serverFileName.name)
                        setTimeout(function() {
                            $(".dz-remove").html('<i class="ri-close-line"></i>')
                            $(".dz-details").html("")
                        }, 500)
                    })
                    this.on("removedfile", function(file) {
                        $.ajax({
                            url: "{{ route('dropzone.remove', ['path' => 'flash-sale']) }}",
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
                url: "{{ route('dropzone.store', ['path' => 'flash-sale']) }}",
                maxFiles: 1
            });

        })

        function removeProductRow(el) {
            el.parentElement.parentElement.parentElement.parentElement.remove()
        }

        function validateFlashSale() {
            if (!$("#end-date").val()) {
                $("#endDateError").removeClass("d-none");
                return false;
            }
        }
    </script>
@endsection
