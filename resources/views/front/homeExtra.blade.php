<div class="container">
    <div class="best-deal-section p-20 pb-0 sm-pt-10 mt-20 sm-mt-10">
        <h5 class="section-header mt-6 ">
        <i class="ri-medal-line flash-icon"></i>{{ $lng->BestDeals }}</h5>
        @if (count($bestDealProducts) > 0)
            <div class="best-deal-products mt-20">
                @foreach ($bestDealProducts as $product)
                    <div class="best-deal-item mb-25">
                        <div class="best-deal-inner">
                            <img src="{{ asset('images/product/' . $product->image) }}"
                                alt=" {{ Str::limit($product->name, 20, '...') }}">
                            <div class="content-wrapper">
                                <a href="{{ route('front-product.show', $product->slug) }}">
                                    <span class="product-title">
                                        {{ Str::limit($product->name, 45) }}
                                    </span>
                                    <div class="price-cart">{{ App\Model\Product::currencyPrice($product->price) }}
                                        @if ($product->actualPrice() != $product->price)
                                            <div class="old-price">
                                                <span>{{ App\Model\Product::currencyPrice($product->actualPrice()) }}</span>
                                               
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@if ($setting->top_in_category)
    <div class="container">
        <div class="top-category-section p-20 sm-pt-10 mt-20 sm-mt-10 sm-pt-15 white-bg">
            <h5 class="section-header "><i class="ri-award-line flash-icon"></i>Top Categories </h5>
            <div class="top-in-category d-flex flex-wrap mt-20">
                @foreach ($trendCategories as $category)
                    <div class="top-in-category-item"
                        data-href="{{route('category',[$category->slug])}}">
                        <img src="{{ asset('images/category/' . $category->image) }}" alt="{{ $category->name }}">
                        <div class="category-name">
                            <span>{{ $category->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@if ($setting->is_two_column_banner_1)
    <div class="container">
        <div class="ts-banner-wrapper">
            <div class="row">
                <div class="col-md-4 col-12 prl-10 mt-20 sm-mt-10">
                    @if ($setting->two_column_banner_1_image)
                        <a aria-label="banner"
                            {{ $setting->two_column_banner_1_new_window == 1 ? 'target="_blank"' : '' }}
                            href="{{ $setting->two_column_banner_1_url }}" class="ts-banner twc-banner">
                            <img src="{{ asset('images/banner/' . $setting->two_column_banner_1_image) }}" alt="banner">
                        </a>
                    @endif
                </div>
                <div class="col-md-4 col-12 prl-10 mt-20 sm-mt-10">
                    @if ($setting->two_column_banner_2_image)
                        <a aria-label="banner"
                            {{ $setting->two_column_banner_2_new_window == 1 ? 'target="_blank"' : '' }}
                            href="{{ $setting->two_column_banner_2_url }}" class="ts-banner twc-banner">
                            <img src="{{ asset('images/banner/' . $setting->two_column_banner_2_image) }}" alt="banner">
                        </a>
                    @endif
                </div>
                 <div class="col-md-4 col-12 prl-10 mt-20 sm-mt-10">
                    @if ($setting->two_column_banner_3_image)
                        <a aria-label="banner"
                            {{ $setting->two_column_banner_3_new_window == 1 ? 'target="_blank"' : '' }}
                            href="{{ $setting->two_column_banner_3_url }}" class="ts-banner twc-banner">
                            <img src="{{ asset('images/banner/' . $setting->two_column_banner_3_image) }}" alt="banner">
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

<div class="container">
<div class="row">
<div class="col-xl-6 prl-10 sm-prl-0">
    @if ($setting->is_new_arrival)   
        <div class="new-arrival-section p-20 sm-pt-10 mt-20 sm-mt-10 white-bg">
            <div class="section-wrapper sm-prl-0">
                <h5 class="item-section-info mb-0 "><i
                        class="ri-bookmark-3-line badge-arrow"></i>{{ $lng->NewArrival }}</h5>
                <a href="{{ route('category') }}" class="see-all-product">{{ $lng->ViewAll }}
                    <i class="ri-arrow-right-line see-all-arrow"></i>
                </a>
            </div>
            <div class="d-flex flex-wrap mt-20">
                @foreach ($newProducts as $product)
                        @include('common.product.style4')
                @endforeach
            </div>
        </div> 
    @endif
</div>
    <div class="col-xl-6 prl-10 sm-prl-0">
        @if ($setting->is_best_sale)
            <div class="best-sale-section p-20 sm-pt-10 white-bg mt-20 sm-mt-10">
                 <div class="best-sale-wrapper sm-prl-0">
                    <h5 class="item-section-info mb-0"><i
                            class="ri-medal-2-line badge-arrow"></i>{{ $lng->BestSelling }}</h5>
                    <a href="{{ route('best-sale') }}" class="see-all-product">{{ $lng->ViewAll }}
                        <i class="ri-arrow-right-line see-all-arrow"></i>
                    </a>
                </div>
                <div class="d-flex flex-wrap mt-20">
                    @foreach ($bestSellProducts as $product)
                         @include('common.product.style3')    
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
</div>

@if ($setting->is_three_column_product)
    <div class="container">
        <div class="tht-section">
            <div class="row">
                <div class="col-xl-6 prl-10 sm-prl-0 mt-20 sm-mt-10">
                  <div class="p-20 sm-pt-15 white-bg pb-10">
                    <div class="column-heading">
                       <h5 class="column-title"><i class="ri-fire-line badge-arrow"></i>{{ $lng->Hot }}</h5>
                    </div>
                    <div class="trending-productss">
                        <div class="d-flex flex-wrap">
                            @foreach ($hotProducts->take(4) as $product)
                                <a href="{{ route('front-product.show', $product->slug) }}"
                                class="single-product-card">
                                    <div class="left">
                                        <img src="{{ asset('/') }}images/product/{{ $product->image }}" alt="{{ Str::limit($product->name, 50) }}"
                                            class="product-img">
                                    </div>
                                    <div class="right">
                                        <div class="product-name">
                                            {{ Str::limit($product->name, 50) }}
                                        </div>
                                        <div class="product-prices">
                                            <span
                                                class="new-price">{{ App\Model\Product::currencyPrice($product->price) }}</span>
                                            @if ($product->actualPrice() != $product->price)
                                                <span
                                                    class="old-price">{{ App\Model\Product::currencyPrice($product->actualPrice()) }}</span>
                                            @endif
                                        </div>
                                        <div class="ratings">
                                            <div class="empty-stars"></div>
                                            <div class="full-stars"
                                                style="width:{{ $product->rating * 20 }}%"></div>
                                        </div>
                                    </div>
                                </a>      
                            @endforeach
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 prl-10 sm-prl-0 mt-20 sm-mt-10">
                    <div class="p-20 sm-pt-15 white-bg pb-10">
                        <div class="column-heading">
                        <h5 class="column-title"><i class="ri-bookmark-3-line badge-arrow"></i> {{ $lng->TopRated }}</h5>
                    </div>
                    <div class="top-rated-sliders">
                        <div class="d-flex flex-wrap">
                            @foreach ($topTrendProducts->take(4) as $product)
                                <a href="{{ route('front-product.show', $product->slug) }}" class="single-product-card">
                                    <div class="left">
                                        <img src="{{ asset('/') }}images/product/{{ $product->image }}" alt="{{ Str::limit($product->name, 50) }}"
                                            class="product-img">
                                    </div>
                                    <div class="right">
                                        <div class="product-name">
                                            {{ Str::limit($product->name, 50) }}
                                        </div>
                                        <div class="product-prices">
                                            <span
                                                class="new-price">{{ App\Model\Product::currencyPrice($product->price) }}</span>
                                            @if ($product->actualPrice() != $product->price)
                                                <span
                                                    class="old-price">{{ App\Model\Product::currencyPrice($product->actualPrice()) }}</span>
                                            @endif
                                        </div>
                                        <div class="ratings">
                                            <div class="empty-stars"></div>
                                            <div class="full-stars"
                                                style="width:{{ $product->rating * 20 }}%"></div>
                                        </div>
                                    </div>
                                </a>                     
                            @endforeach
                       </div>
                    </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($setting->is_full_width_banner)
    <div class="container">
        <div class="row">
            <div class="col-md-8 prl-10 mt-20 sm-mt-10">
                <div class="ts-banner-wrapper">
                    <a {{ $setting->full_width_banner_new_window == 1 ? 'target="_blank"' : '' }}
                        href="{{ $setting->full_width_banner_url }}" class="ts-banner fw-banner">
                        @if ($setting->full_width_banner_image)
                            <img src="{{ asset('images/banner/' . $setting->full_width_banner_image) }}" alt="banner">
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-md-4 prl-10 mt-20 sm-mt-10">
                <div class="ts-banner-wrapper">
                    <a {{ $setting->full_width_banner_2_new_window == 1 ? 'target="_blank"' : '' }}
                        href="{{ $setting->full_width_banner_2_url }}" class="ts-banner fw-banner">
                        @if ($setting->full_width_banner_2_image)
                            <img src="{{ asset('images/banner/' . $setting->full_width_banner_2_image) }}" alt="banner">
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

@foreach($categories->where('is_featured',1) as $category)
    <div class="container">
        <div class="best-sale-section p-20 sm-pt-10 pb-0 mt-20 sm-mt-10 white-bg">
            <div class="section-wrapper">
                <h5 class="item-section-info mb-0">
                    <i class="ri-apps-2-line badge-arrow"></i>{{$category->name}}</h5>
                    <span class="ri-menu-line d-lg-none categoryToggler"></span>
                    <ul class="category-tab-menu">
                        @foreach ($category->subCategories->take(3) as $subCategory)
                        <li class="sub-product sub-{{$category->id}}" data-id="{{$subCategory->id}}" data-category="{{$category->id}}">
                        {{$subCategory->name}}
                        </li>
                        @endforeach
                        <li><a href="{{route('category',[$category->slug])}}" >{{$lng->All}}</a></li>
                    </ul>
            </div>
            <div class="mt-20" >
                <div class="product-slider" id="sub-wrapper{{$category->id}}">
                    @foreach ($category->products->take(8) as $product)
                        @include('common.product.style1')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach


@if ($setting->is_brands)
    <div class="container">
        <div class="shop-brand-section mt-20 sm-mt-10 white-bg">
            <div class="row">
                <div class="col">
                    <div class="top-brands-slider">
                        @foreach ($brands as $brand)
                            <div class="brand-item">
                                <div class="brand-image">
                                    <a href="{{ route('brand.product', $brand->name) }}">
                                        <img src="{{ asset('images/brand/' . $brand->logo) }}" alt="{{ $brand->name }}">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($setting->is_blog)
    <div class="container">
        <div class="blog-section p-20 pb-0 sm-pt-10 mb-20 sm-mb-10 mt-20 sm-mt-10 white-bg">
            <div class="row">
                <div class="col sm-prl-0">
                    <h5 class="section-header mb-20 pt-6"><i class="ri-pen-nib-line badge-arrow"></i>{{ $lng->FromOurBlog }}</h5>
                </div>
            </div>
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-md-3 col-sm-4 col-12 mb-20 prl-10">
                        <div class="card blog-inner">
                            <a href="{{ route('front-blog.show', $blog->slug) }}" class="blog-img">
                                <img class="card-img-top" src="{{ asset('images/blog/' . $blog->image) }}"
                                    alt="{{ $blog->title }}" />
                            </a>
                            <div class="card-body">
                                <a class="card-title" href="{{ route('front-blog.show', $blog->slug) }}">
                                    {{ Str::limit($blog->title, 40, '.') }}
                                </a>
                                <div class="blog-meta">
                                    <a href="{{ route('front-blog.show', $blog->slug) }}">{{ $blog->commentsCount() }}
                                        {{ $lng->Comments }}</a>
                                    <span class="blog-date">{{ $blog->created_at->format('d M Y') }}</span>
                                </div>
                                <p class="card-text">
                                    {{ html_entity_decode(Str::limit(trim(strip_tags($blog->details)), 90, '...')) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif