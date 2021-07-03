@extends('layouts.admin',['headerText' => $lng->HomepageOption])
@section('title', "$lng->HomepageOption")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->HomepageOption }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <section class="site-customization">
            <form method="POST" action="{{ URL::to('/admin/home-page-option') }}">
                @csrf
                <div class="row">
                    <div class="col-md-5 col-12">
                        <div class="flex-item">
                            <label class="mt-2">{{ $lng->Slider }} </label>
                            <label class="ts-swich-label">
                                <input {{ $setting->is_slider ? 'checked' : '' }} type="checkbox"
                                    class="switch ts-swich-input" name="is_slider">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                        <div class="flex-item">
                            <label class="mt-2">Offer </label>
                            <label class="ts-swich-label">
                                <input {{ $setting->is_flash_deal ? 'checked' : '' }} type="checkbox"
                                    class="switch ts-swich-input" name="is_flash_deal">
                                <span class="ts-swich-body"></span> 
                            </label>
                        </div>
                        <div class="flex-item">
                            <label class="mt-2">{{ $lng->BestSelling }} </label>
                            <label class="ts-swich-label">
                                <input {{ $setting->is_best_sale ? 'checked' : '' }} type="checkbox"
                                    class="switch ts-swich-input" name="is_best_sale">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                        <div class="flex-item">
                            <label class="mt-2">{{ $lng->TopInCategory }} </label>
                            <label class="ts-swich-label">
                                <input {{ $setting->top_in_category ? 'checked' : '' }} type="checkbox"
                                    class="switch ts-swich-input" name="top_in_category">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>

                        <div class="flex-item">
                            <label class="mt-2">{{ $lng->_3ColumnsProduct }} </label>
                            <label class="ts-swich-label">
                                <input {{ $setting->is_three_column_product ? 'checked' : '' }} type="checkbox"
                                    class="switch ts-swich-input" name="is_three_column_product">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                        <div class="flex-item">
                            <label class="mt-2">{{ $lng->NewArrival }} </label>
                            <label class="ts-swich-label">
                                <input {{ $setting->is_new_arrival ? 'checked' : '' }} type="checkbox"
                                    class="switch ts-swich-input" name="is_new_arrival">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-5 col-12 offset-md-1">
                        <div class="flex-item">
                            <label class="mt-2">{{ $lng->Brands }} </label>
                            <label class="ts-swich-label">
                                <input {{ $setting->is_brands ? 'checked' : '' }} type="checkbox"
                                    class="switch ts-swich-input" name="is_brands">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                        <div class="flex-item">
                            <label class="mt-2">{{ $lng->Blog }} </label>
                            <label class="ts-swich-label">
                                <input {{ $setting->is_blog ? 'checked' : '' }} type="checkbox"
                                    class="switch ts-swich-input" name="is_blog">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                        <div class="flex-item">
                            <label class="mt-2">{{ $lng->Services }} </label>
                            <label class="ts-swich-label">
                                <input {{ $setting->is_service ? 'checked' : '' }} type="checkbox"
                                    class="switch ts-swich-input" name="is_service">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                        <div class="flex-item">
                            <label class="mt-2">{{ $lng->TwoColumnBanner }} </label>
                            <label class="ts-swich-label">
                                <input {{ $setting->is_full_width_banner ? 'checked' : '' }} type="checkbox"
                                    class="switch ts-swich-input" name="is_full_width_banner">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                        <div class="flex-item">
                            <label class="mt-2">{{ $lng->ThreeColumnBanner }} </label>
                            <label class="ts-swich-label">
                                <input {{ $setting->is_two_column_banner_1 ? 'checked' : '' }} type="checkbox"
                                    class="switch ts-swich-input" name="is_two_column_banner_1">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                        <div class="flex-item">
                            <label class="mt-2">{{ $lng->BestDeal }} </label>
                            <label class="ts-swich-label">
                                <input {{ $setting->is_best_deal ? 'checked' : '' }} type="checkbox"
                                    class="switch ts-swich-input" name="is_best_deal">
                                <span class="ts-swich-body"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button class="submit-btn">{{ $lng->Save }}</button>
                    </div>
                </div>
            </form>
        </section>
    </div>

@endsection
