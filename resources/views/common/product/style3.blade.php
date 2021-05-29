<div
    class="item-inner formet_2 cart-item-{{ $product->product->id }} {{ array_key_exists($product->product->id, $cartProducts) ? 'in-cart' : '' }}">
    <div class="item-img-badge">
        <a href="{{ route('front-product.show', $product->product->slug) }}" class="item-img">
            <img alt="{{ Str::limit($product->product->name, 50) }}" src="{{ asset('/') }}images/product/{{ $product->product->image }}">
        </a>
        {{-- <div class="item-badge-wrapper">
            @foreach ($product->product->productBadges as $badge)
                <span style="background-color:{{ $badge->background }};color:{{ $badge->color }};"
                    class="item-badge">{{ $badge->name }}</span>
            @endforeach
        </div> --}}
        <span class="{{ in_array($product->product->id, $wishProducts) ? 'active' : '' }} add__wishlist ri-heart-fill"
            data-url="{{ route('wishlist.add') }}" data-id="{{ $product->product->id }}"></span>
        {{-- @if (!$product->product->inStock())
            <span class="stockout-btn">{{ $lng->OutOfStock }}</span>
        @endif --}}
    </div>
    <div class="item-content cart-item-{{ $product->product->id }} {{ array_key_exists($product->product->id, $cartProducts) ? 'in-cart' : '' }}">
        <div class="item-price-ratings">
            <div class="item-price">
                <span class="new-price">{{ App\Model\Product::currencyPrice($product->product->price) }}</span>
                @if ($product->product->actualPrice() != $product->product->price)
                    <span class="old-price">{{ App\Model\Product::currencyPrice($product->product->actualPrice()) }}</span>
                @endif
            </div>
        </div>
        <div class="item-title">
            <a href="{{ route('front-product.show', $product->product->slug) }}">{{ Str::limit($product->product->name, 50) }}</a>
        </div>
    </div>
</div>
