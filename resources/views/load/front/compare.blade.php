@foreach ($items as $item)
    <div class="single-product">
        <i data-row="{{ $item->rowId }}" class="ri-close-line close__icon compare-remove"></i>
        <a href="{{ route('front-product.show', App\Model\Product::find($item->id)->slug) }}">
            <img src="{{ asset('images/product/') }}/{{ $item->options->image }}" alt="product image" />
        </a>
        <div class="title gray same-height">
            {{ html_entity_decode(Str::limit(trim(strip_tags($item->options->name)), 30, '...')) }}
        </div>
        <div class="desc">
            {{ html_entity_decode(Str::limit(trim(strip_tags($item->options->details)), 120, '...')) }}
        </div>
        <div class="rating gray same-height">
            <div class="ratings">
                <div class="empty-stars"></div>
                <div class="full-stars" style="width:{{ $item->options->rating* 20 }}%"></div>
            </div>
        </div>
        <div class="price same-height">৳{{ App\Model\Product::currencyPriceRate($item->price) }}</div>

        <div
            class="availability gray same-height {{ App\Model\Product::find($item->id)->inStock() ? '' : 'out-of-stock' }}">
            {{ App\Model\Product::find($item->id)->inStock() ? "$lng->InStock" : "$lng->OutOfStock" }}</div>
        <div class="size same-height">
            @if ($item->options->sizes->count() == 0)
                -
            @endif
            @foreach ($item->options->sizes as $size)
                {{ App\Model\Size::find($size->size_id)->name }}
            @endforeach
        </div>
        <div class="color gray same-height">
            @if ($item->options->colors->count() == 0)
                -
            @endif
            @foreach ($item->options->colors as $color)
                {{ App\Model\Color::find($color->color_id)->name }}
            @endforeach
        </div>
        <div class="brand same-height">{{ $item->options->brand ? $item->options->brand->name : '' }}</div>
        <div class="actions gray same-height">
            <span
                class="{{ in_array($item->id, $wishProducts) ? 'active' : '' }} add__wishlist favourite-item ri-heart-line"
                data-url="{{ route('wishlist.add') }}" data-id="{{ $item->id }}" title="" data-toggle="tooltip"
                data-placement="top" data-original-title="{{ $lng->WishList }}"></span>
            @if (count(App\Model\Product::find($item->id)->options) != 0)
                <a href="{{ route('front-product.show', App\Model\Product::find($item->id)->slug) }}"
                    data-toggle="tooltip" data-placement="top" data-original-title="{{ $lng->SeeOptions }}"><i
                        class="ri-shopping-bag-line"></i></a>
            @else
                <span data-url="{{ route('cart.add') }}" data-id="{{ $item->id }}" class="add__cart wish-btn" title=""
                    data-toggle="tooltip" data-placement="top" data-original-title="{{ $lng->AddToCart }}">
                    <i class="ri-shopping-bag-line"></i>
                </span>
            @endif
        </div>
    </div>
@endforeach
