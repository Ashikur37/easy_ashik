<div
    class="item-inner cart-item-{{ $product->id }} {{ array_key_exists($product->id, $cartProducts) ? 'in-cart' : '' }} formet_2">
    <div class="item-img-badge">
        <a href="{{ route('front-product.show', $product->slug) }}" class="item-img">
            <img alt="{{ Str::limit($product->name, 50) }}" src="{{ asset('/') }}images/product/{{ $product->image }}">
        </a>
        {{-- <div class="item-badge-wrapper">
            @foreach ($product->productBadges as $badge)
                <span style="background-color:{{ $badge->background }};color:{{ $badge->color }};"
                    class="item-badge">{{ $badge->name }}</span>
            @endforeach
        </div> --}}
        <span class="{{ in_array($product->id, $wishProducts) ? 'active' : '' }} add__wishlist ri-heart-fill"
            data-url="{{ route('wishlist.add') }}" data-id="{{ $product->id }}"></span>
        {{-- @if (!$product->inStock())
            <span class="stockout-btn">{{ $lng->OutOfStock }}</span>
        @endif --}}
    </div>
    <div class="item-content cart-item-{{ $product->id }} {{ array_key_exists($product->id, $cartProducts) ? 'in-cart' : '' }}">
        <div class="item-price-ratings">
            <div class="item-price">
                <span class="new-price">৳{{ App\Model\Product::currencyPrice($product->price) }}</span>
                @if ($product->actualPrice() != $product->price)
                    <span class="old-price">৳{{ App\Model\Product::currencyPrice($product->actualPrice()) }}</span>
                @endif
            </div>
        </div>
        <div class="item-title">
            <a href="{{ route('front-product.show', $product->slug) }}">{{ Str::limit($product->name, 50) }}</a>
        </div>
        
    </div>
</div>
