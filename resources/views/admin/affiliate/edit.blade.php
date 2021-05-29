@extends('layouts.admin',['headerText' => $lng->Affiliation])
@section('title', "$lng->Edit $lng->Affiliation")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->Edit }} {{ $lng->Affiliation }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ route('affiliate.update', 1) }}">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <h4 class="mb-0">{{ $lng->Edit }} {{ $lng->Affiliation }}</h4>
                        </div>
                        <div>
                            <input type="submit" value="{{ $lng->Save }}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>{{ $lng->GlobalPercent }}*</label>
                        <input type="number" name="global_affiliate_percent"
                            value="{{ $setting->global_affiliate_percent }}" class="form-control">
                    </div>
                </div>
            </div>
            @foreach ($affiliateProducts as $percentage => $prods)
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ $lng->Percent }} *</label>
                            <input value="{{ $percentage }}" type="number" name="percent[{{ $loop->index }}]" id=""
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>{{ $lng->Products }} *</label>
                            <div class="d-flex">
                                <div class="select-wrapper w-100 d-none">
                                    <select class="select2 form-control" name="product[{{ $loop->index }}][]" multiple="multiple"
                                        data-placeholder="Products">
                                        @foreach ($products as $product)
                                            <option @if (in_array($product->id, $prods->pluck('product_id')->toArray())) selected @endif value="{{ $product->id }}">
                                                {{ Str::limit($product->name,30) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="remove-extra-feature" onclick="removeProductRow(this)"><i
                                        class="ri-delete-bin-line"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div id="productWrapper">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ $lng->Percent }} *</label>
                            <input type="number" name="percent[-1000]" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>{{ $lng->Products }} *</label>
                            <div class="d-flex">
                                <div class="select-wrapper w-100 d-none">
                                    <select class="select2 form-control" name="product[-1000][]" multiple="multiple"
                                        data-placeholder="Products">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ Str::limit($product->name,30) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="remove-extra-feature" onclick="removeProductRow(this)"><i
                                        class="ri-delete-bin-line"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="more-product" class="add-extra-feature ml-0">
                {{ $lng->AddNew }}
            </button>
        </form>
    </div>
@endsection
@section('script')
<script src="{{ asset('assets/admin/js/vendor/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/page/affiliate.js') }}"></script>
@endsection
