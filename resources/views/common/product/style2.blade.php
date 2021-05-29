<div class="list-item-inner">
    <div class="item-img-badge">
        <a href="{{ route('front-product.show', $product->slug) }}" class="item-img">
            <img alt="{{ Str::limit($product->name, 50, ' ...') }}"
                src="{{ asset('/') }}images/product/{{ $product->image }}">
        </a>
        <div class="item-badge-wrapper">
            @foreach ($product->productBadges as $badge)
                <span style="background-color:{{ $badge->background }};color:{{ $badge->color }};"
                    class="item-badge">{{ $badge->name }}</span>
            @endforeach
        </div>
    </div>
    <div class="p-20 pl-0 item-content">
        <div class="item-content-left">
            <div class="item-brand-ratings">
                @if ($product->brand)
                    <div class="item-brand"><span>{{ $product->brand ? $product->brand->name : '' }}</span></div>
                @endif
                <div class="ratings">
                    <div class="empty-stars"></div>
                    <div class="full-stars" style="width:{{ $product->rating * 20 }}%"></div>
                </div>
            </div>
            <div class="d-md-none d-flex align-items-sm-center">
                <span class="item-price">{{ App\Model\Product::currencyPrice($product->price) }}</span>
                @if ($product->actualPrice() != $product->price)
                    <div class="item-old-price">
                        <span>{{ App\Model\Product::currencyPrice($product->actualPrice()) }}</span>
                    </div>
                @endif
            </div>
            <div class="item-title">
                <a
                    href="{{ route('front-product.show', $product->slug) }}">{{ Str::limit(strip_tags($product->name), 50) }}</a>
            </div>

            <div class="item-details">
                <a
                    href="{{ route('front-product.show', $product->slug) }}">{{ html_entity_decode(Str::limit(strip_tags($product->details), 50)) }}</a>
            </div>

            <div class="d-none d-md-block">

                <ul class="item-action">
                    <li>
                        @if (!$product->inStock())
                            <span title="{{ $lng->SoldOut }}" data-toggle="tooltip" data-placement="top">
                                <i class="ri-shopping-cart-line"></i>
                            </span>
                        @elseif(count($product->options)==0&&count($product->colors)==0&&count($product->sizes)==0)
                            <span data-url="{{ route('cart.add') }}" data-id="{{ $product->id }}" class="buy-btn"
                                title="{{ $lng->BuyNow }}" data-toggle="tooltip" data-placement="top">
                                <i class="ri-shopping-cart-line"></i>
                            </span>
                        @else
                            <span title="{{ $lng->SeeOptions }}" data-toggle="tooltip" data-placement="top">
                                <a href="{{ route('front-product.show', $product->slug) }}">
                                    <i class="ri-shopping-cart-line"></i>
                                </a>
                            </span>
                        @endif
                    </li>
                    <li>
                        <span data-url="{{ route('compare.add') }}" data-id="{{ $product->id }}" class="add-to-compare"
                            title="Compare" data-toggle="tooltip" data-placement="top">
                            <i class="ri-shuffle-line"></i>
                        </span>
                    </li>
                    <li>
                        <span data-url="{{ route('wishlist.add') }}" data-id="{{ $product->id }}"
                            class="add__wishlist {{ in_array($product->id, $wishProducts) ? 'active' : '' }}"
                            title="wishlist" data-toggle="tooltip" data-placement="top">
                            <i class="ri-heart-line"></i>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="item-lg-content-right">
            <div class="item-content">
                <div class="item-price-wrapper">
                    <span class="item-price">{{ App\Model\Product::currencyPrice($product->price) }}</span>
                    @if ($product->actualPrice() != $product->price)
                        <div class="item-old-price">
                            <span>{{ App\Model\Product::currencyPrice($product->actualPrice()) }}</span>
                        </div>
                    @endif
                </div>
                @if (!$product->inStock())
                    <span class="list-stockout-btn">{{ $lng->OutOfStock }}</span>
                @elseif(count($product->options)==0&&count($product->colors)==0&&count($product->sizes)==0)
                    <div class="cart-button-wrapper-{{ $product->id }}">
                        @if (array_key_exists($product->id, $cartProducts))
                            <div class="product-count list-item-count">
                                <div class="btn-minus" data-id="{{ $product->id }}"
                                    data-row="{{ $cartProducts[$product->id]['rowId'] }}">
                                    <button type="button" class="counter">
                                        <span><i class="ri-subtract-line"></i></span>
                                    </button>
                                </div>
                                <input type="text" class="counter-field qty-{{ $cartProducts[$product->id]['rowId'] }}"
                                    value="{{ $cartProducts[$product->id]['qty'] }}">
                                <div class="btn-plus" data-row="{{ $cartProducts[$product->id]['rowId'] }}">
                                    <button type="button" class="counter counter-plus">
                                        <span><i class="ri-add-line"></i></span>
                                    </button>
                                </div>
                            </div>
                        @else
                            <span data-url="{{ route('cart.add') }}" data-id="{{ $product->id }}" class="add__cart">
                                {{ $lng->AddToCart }}
                            </span>
                        @endif
                    </div>
                @else
                    <a href="{{ route('front-product.show', $product->slug) }}"
                        class="see-option-btn">{{ $lng->SeeOptions }}</a>
                @endif
            </div>
        </div>
        <div class="d-md-none item-sm-content-right">
            @if (!$product->inStock())
                <span title="{{ $lng->SoldOut }}" data-toggle="tooltip" data-placement="top">
                    <i class="ri-shopping-cart-line"></i>
                </span>
            @elseif(count($product->options)==0&&count($product->colors)==0&&count($product->sizes)==0)
                <span data-url="{{ route('cart.add') }}" data-id="{{ $product->id }}" class="buy-btn"
                    title="{{ $lng->BuyNow }}" data-toggle="tooltip" data-placement="top">
                    <i class="ri-shopping-cart-line"></i>
                </span>
            @else
                <span title="{{ $lng->SeeOptions }}" data-toggle="tooltip" data-placement="top">
                    <a href="{{ route('front-product.show', $product->slug) }}">
                        <i class="ri-shopping-cart-line"></i>
                    </a>
                </span>
            @endif
            <span data-url="{{ route('compare.add') }}" data-id="{{ $product->id }}" class="add-to-compare">
                <i class="ri-shuffle-line"></i>
            </span>
            <span data-url="{{ route('wishlist.add') }}" data-id="{{ $product->id }}"
                class="add__wishlist {{ in_array($product->id, $wishProducts) ? 'active' : '' }}">
                <i class="ri-heart-line"></i>
            </span>
        </div>
    </div>
</div>
