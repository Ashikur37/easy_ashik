<div>
    <div
        class="item-inner cart-item-{{ $product->id }} {{ array_key_exists($product->id, $cartProducts) ? 'in-cart' : '' }}">
        <div class="item-img-badge">
            <a href="{{ route('front-product.show', $product->slug) }}" class="item-img">
                <img alt="{{ Str::limit($product->name, 50) }}"
                    src="{{ asset('/') }}images/product/{{ $product->image }}">
            </a>
            <div class="item-badge-wrapper">
                @foreach ($product->productBadges as $badge)
                    <span style="background-color:{{ $badge->background }};color:{{ $badge->color }};"
                        class="item-badge">{{ $badge->name }}</span>
                @endforeach
            </div>
            <span class="{{ in_array($product->id, $wishProducts) ? 'active' : '' }} add__wishlist ri-heart-fill"
                data-url="{{ route('wishlist.add') }}" data-id="{{ $product->id }}"></span>
            @if (!$product->inStock())
                <span class="stockout-btn">{{ $lng->OutOfStock }}</span>
            @endif
        </div>
        <div
            class="item-content cart-item-{{ $product->id }} {{ array_key_exists($product->id, $cartProducts) ? 'in-cart' : '' }}">
            <div class="item-price-ratings">
                <div class="item-price">
                    <span class="new-price">৳{{ App\Model\Product::currencyPrice($product->price) }}</span>
                    @if ($product->actualPrice() != $product->price)
                        <span
                            class="old-price">৳{{ App\Model\Product::currencyPrice($product->actualPrice()) }}</span>
                    @endif
                </div>
                <div class="ratings">
                    <div class="empty-stars"></div>
                    <div class="full-stars" style="width:{{ $product->rating * 20 }}%"></div>
                </div>
            </div>
            <div class="item-title">
                <a
                    href="{{ route('front-product.show', $product->slug) }}">{{ Str::limit($product->name, 50) }}</a>
            </div>
            <div
                class="item-action cart-item-{{ $product->id }} {{ array_key_exists($product->id, $cartProducts) ? 'in-cart' : '' }}">
                <ul>
                    <li class="cart-button-wrapper-{{ $product->id }} @if (!(count($product->
                        options) == 0 && count($product->colors) == 0 && count($product->sizes) == 0) ||
                        !$product->inStock()) w-100 @endif">
                        @if (!$product->inStock())
                            <span class="sold-out-btn">{{ $lng->SoldOut }}</span>
                        @elseif(count($product->options)==0&&count($product->colors)==0&&count($product->sizes)==0)
                            @if (array_key_exists($product->id, $cartProducts))
                                <div class="product-count item-count">
                                    <div class="btn-minus" data-id="{{ $product->id }}"
                                        data-row="{{ $cartProducts[$product->id]['rowId'] }}">
                                        <button aria-label="substract" type="button" class="counter">
                                            <i class="ri-subtract-line"></i>
                                        </button>
                                    </div>
                                    <input type="text" readonly class="counter-field qty-{{ $cartProducts[$product->id]['rowId'] }}"
                                        value="{{ $cartProducts[$product->id]['qty'] }}">
                                    <div class="btn-plus" data-row="{{ $cartProducts[$product->id]['rowId'] }}">
                                        <button aria-label="addition" type="button" class="counter counter-plus">
                                            <i class="ri-add-line"></i>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <span data-url="{{ route('cart.add') }}" data-id="{{ $product->id }}"
                                    class="add__cart">
                                    {{ $lng->AddToCart }}
                                </span>
                            @endif
                        @else
                            <span class="see-option-btn">
                                <a
                                    href="{{ route('front-product.show', $product->slug) }}">{{ $lng->SeeOptions }}</a>
                            </span>
                        @endif
                    </li>
                    @if (count($product->options) == 0 && count($product->colors) == 0 && count($product->sizes) == 0 && $product->inStock())
                        <li>
                            @if (count($product->options) == 0 && count($product->colors) == 0 && count($product->sizes) == 0 && $product->inStock())
                                <span data-url="{{ route('cart.add') }}" data-id="{{ $product->id }}"
                                    class="buy-btn">
                                    <a href="#"> {{ $lng->BuyNow }}</a>
                                </span>
                            @endif
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
