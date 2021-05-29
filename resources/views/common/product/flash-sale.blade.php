<div>
    <div
        class="item-inner cart-item-{{ $product->product->id }} {{ array_key_exists($product->product->id, $cartProducts) ? 'in-cart' : '' }}">
        <div class="item-img-badge">
            <a href="{{ route('front-product.show', $product->product->slug) }}" class="item-img">
                <img alt="{{ Str::limit($product->product->name, 50) }}"
                    src="{{ asset('/') }}images/product/{{ $product->product->image }}">
            </a>
            <div class="item-badge-wrapper">
                @foreach ($product->product->productBadges as $badge)
                    <span style="background-color:{{ $badge->background }};color:{{ $badge->color }};"
                        class="item-badge">{{ $badge->name }}</span>
                @endforeach
            </div>
            <span class="{{ in_array($product->product->id, $wishProducts) ? 'active' : '' }} add__wishlist ri-heart-fill"
                data-url="{{ route('wishlist.add') }}" data-id="{{ $product->product->id }}"></span>
            @if (!$product->product->inStock())
                <span class="stockout-btn">{{ $lng->OutOfStock }}</span>
            @endif
        </div>
        <div
            class="item-content cart-item-{{ $product->product->id }} {{ array_key_exists($product->product->id, $cartProducts) ? 'in-cart' : '' }}">
            <div class="item-price-ratings">
                <div class="item-price">
                    <span class="new-price">{{ App\Model\Product::currencyPrice($product->product->price) }}</span>
                    @if ($product->product->actualPrice() != $product->product->price)
                        <span
                            class="old-price">{{ App\Model\Product::currencyPrice($product->product->actualPrice()) }}</span>
                    @endif
                </div>
                <div class="ratings">
                    <div class="empty-stars"></div>
                    <div class="full-stars" style="width:{{ $product->product->rating * 20 }}%"></div>
                </div>
            </div>
            <div class="item-title">
                <a
                    href="{{ route('front-product.show', $product->product->slug) }}">{{ Str::limit($product->product->name, 50) }}</a>
            </div>
            <div
                class="item-action cart-item-{{ $product->product->id }} {{ array_key_exists($product->product->id, $cartProducts) ? 'in-cart' : '' }}">
                <ul>
                    <li class="cart-button-wrapper-{{ $product->product->id }} @if (!(count($product->product->
                        options) == 0 && count($product->product->colors) == 0 && count($product->product->sizes) == 0) ||
                        !$product->product->inStock()) w-100 @endif">
                        @if (!$product->product->inStock())
                            <span class="sold-out-btn">{{ $lng->SoldOut }}</span>
                        @elseif(count($product->product->options)==0&&count($product->product->colors)==0&&count($product->product->sizes)==0)
                            @if (array_key_exists($product->product->id, $cartProducts))
                                <div class="product-count item-count">
                                    <div class="btn-minus" data-id="{{ $product->product->id }}"
                                        data-row="{{ $cartProducts[$product->product->id]['rowId'] }}">
                                        <button aria-label="substract" type="button" class="counter">
                                            <i class="ri-subtract-line"></i>
                                        </button>
                                    </div>
                                    <input type="text" readonly
                                        class="counter-field qty-{{ $cartProducts[$product->product->id]['rowId'] }}"
                                        value="{{ $cartProducts[$product->product->id]['qty'] }}">
                                    <div class="btn-plus" data-row="{{ $cartProducts[$product->product->id]['rowId'] }}">
                                        <button aria-label="addition" type="button" class="counter counter-plus">
                                            <i class="ri-add-line"></i>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <span data-url="{{ route('cart.add') }}" data-id="{{ $product->product->id }}"
                                    class="add__cart">
                                    {{ $lng->AddToCart }}
                                </span>
                            @endif
                        @else
                            <span class="see-option-btn">
                                <a
                                    href="{{ route('front-product.show', $product->product->slug) }}">{{ $lng->SeeOptions }}</a>
                            </span>
                        @endif
                    </li>
                    @if (count($product->product->options) == 0 && count($product->product->colors) == 0 && count($product->product->sizes) == 0 && $product->product->inStock())
                        <li>
                            @if (count($product->product->options) == 0 && count($product->product->colors) == 0 && count($product->product->sizes) == 0 && $product->product->inStock())
                                <span data-url="{{ route('cart.add') }}" data-id="{{ $product->product->id }}"
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
