<div class="row lg-cart-table">
    <div class="col-lg-10 offset-lg-1">
        <div class="cart-table">
            <table class="table scrollTable">
                <thead>
                    <tr>
                        <th class="details">{{ $lng->Product }}</th>
                        <th class="price">{{ $lng->Price }}</th>
                        <th class="qty">{{ $lng->Quantity }}</th>
                        <th class="total">{{ $lng->Total }}</th>
                        <th class="remove">{{ $lng->Remove }}</th>
                    </tr>
                </thead>
                <tbody class="custom-scrollbar">
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="cart-product">
                                    <div class="product-img">
                                        <img src="{{ asset('images/product/') }}/{{ $item->options->image }}" alt="{{ Str::limit($item->name, 50) }}">
                                    </div>
                                    <div class="product-details">
                                        <a href="#">{{ Str::limit($item->name, 50) }}</a>
                                        <div class="product-attributes">
                                            @if ($item->options->size)
                                                <span>{{ $lng->Size }} : {{ $item->options->size }}</span>
                                            @endif
                                            @if ($item->options->color)
                                                <span>{{ $lng->Color }} : {{ $item->options->colorName }}</span>
                                            @endif
                                            @foreach ($item->options->options as $key => $value)
                                                <span>{{ $key }} : {{ $value }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="product-price">৳{{ App\Model\Product::currencyPriceRate($item->price) }}</p>
                            </td>
                            <td>
                                <div class="product-count">
                                    <div class="btn-minus cart-view" data-id="{{ $item->id }}"
                                        data-row="{{ $item->rowId }}">
                                        <button type="button" class="counter">
                                            <span><i class="ri-subtract-line"></i></span>
                                        </button>
                                    </div>
                                    <input id="item-{{ $item->rowId }}" readonly type="text"
                                        class="counter-field qty-{{ $item->rowId }}" value="{{ $item->qty }}">
                                    <div class="btn-plus cart-view" data-row="{{ $item->rowId }}">
                                        <button type="button" class="counter counter-plus">
                                            <span><i class="ri-add-line"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="product-total row-total-{{ $item->rowId }}">
                                    ৳{{ App\Model\Product::currencyPriceRate($item->priceTotal) }}</p>
                            </td>
                            <td><span data-id="{{ $item->id }}" data-row="{{ $item->rowId }}"
                                    class="product-remove cart-view"><i class="ri-delete-bin-line"></i>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row sm-cart-table">
    <div class="col-12">
        <div>
            @foreach ($items as $item)
                <div class="product-info mb-20">
                    <div class="product-img">
                        <img src="{{ asset('images/product/') }}/{{ $item->options->image }}" alt="{{ Str::limit($item->name, 50) }}">
                    </div>
                    <div class="product-content-wrapper">
                        <div class="flex-item">
                            <div class="product-details">
                                <p>{{ Str::limit($item->name, 50) }}</p>
                            </div>
                            <div class="remove-item">
                                <span data-id="{{ $item->id }}" data-row="{{ $item->rowId }}"
                                    class="product-remove cart-view"><i class="ri-delete-bin-line"></i></span>
                            </div>
                        </div>
                        <div class="flex-item">
                            <div class="product-attributes">
                                <p class="product-price">৳{{ App\Model\Product::currencyPriceRate($item->price) }}</p>
                                @if ($item->options->size)
                                    <span>Size : {{ $item->options->size }}</span>
                                @endif
                                @if ($item->options->color)
                                    <span>color : {{ $item->options->colorName }}</span>
                                @endif
                                @foreach ($item->options->options as $key => $value)
                                    <span>{{ $key }} {{ $value }}</span>
                                @endforeach
                            </div>
                            <div class="product-count">
                                <div class="btn-minus" data-row="{{ $item->rowId }}">
                                    <button type="button" class="counter">
                                        <span><i class="ri-subtract-line"></i></span>
                                    </button>
                                </div>
                                <input type="text" class="counter-field qty-{{ $item->rowId }}"
                                    value="{{ $item->qty }}">
                                <div class="btn-plus" data-row="{{ $item->rowId }}">
                                    <button type="button" class="counter counter-plus">
                                        <span><i class="ri-add-line"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="row py-40">
    <div class="checkout-process col-lg-10 offset-lg-1">
        <div class="row">
            <div class="col-lg-3 col-4 lg-coupon-section">
                <h4>{{ $lng->HaveCoupon }}?</h4>
                @if (Session::has('coupon'))
                    <div class="applied-coupon">
                        <span class="coupon-content">
                            <span class="coupon-name">"{{ Session::get('coupon') }}"</span> {{ $lng->Applied }}<span
                                class="coupon-closer"><i class="ri-close-line"></i></span>
                        </span>
                    </div>
                @else
                    <div class="input-group">
                        <input id="coupon-input" type="text" class="form-control" placeholder="{{ $lng->Coupon }}">
                        <div class="input-group-append">
                            <button id="coupon-apply-btn" class="default-btn sm-btn"
                                type="button">{{ $lng->Apply }}</button>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-6 col-md-5 col-12 ">
                <div class="checkout-process-content">
                    <div class="flex-item">
                        <p>{{ $lng->Discount }}</p>
                        <span class="cart-discount">৳{{ App\Model\Product::currencyPriceRate(Cart::discount()) }}</span>
                    </div>
                    <div class="flex-item">
                        <p>{{ $lng->Tax }}</p>
                        <span class="cart-tax">৳{{ App\Model\Product::currencyPriceRate(Cart::tax()) }}</span>
                    </div>
                    <div class="flex-item">
                        <p class="mb-md-0">{{ $lng->SubTotal }}</p>
                        <span class="cart-sub-total">৳{{ App\Model\Product::currencyPriceRate(Cart::subtotal()) }}</span>
                    </div>
                    <div class="sm-grand-total">
                        <div class="grand-total">
                            <p class="mb-0">{{ $lng->GrandTotal }}</p>
                            <span
                                class="cart-grand-total">৳{{ App\Model\Product::currencyPriceRate(Cart::total()) }}</span>
                        </div>
                        <div>
                            @if (Session::has('coupon'))
                                <div class="applied-coupon sm-applied-coupon">
                                    <span class="coupon-content">
                                        <span class="coupon-name">{{ Session::get('coupon') }}"</span>
                                        {{ $lng->Applied }}<span class="coupon-closer"><i
                                                class="ri-close-line"></i></span>
                                    </span>
                                </div>
                            @else
                                <button class="btn-coupon apply-coupon-trigger"
                                    type="button">{{ $lng->ApplyCoupon }}</button>
                                <div class="sm-coupon-input">
                                    <div class="input-group">
                                        <input id="sm-coupon-input" type="text" class="form-control"
                                            placeholder="Enter Coupon">
                                        <div class="input-group-append">
                                            <button id="sm-coupon-apply-btn" class="default-btn sm-btn"
                                                type="button">{{ $lng->Apply }}</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('checkout') }}" class="btn-checkout default-btn">{{ $lng->Checkout }}</a>
                    </div>
                </div>
            </div>
            <div class="col-3 lg-grand-total">
                <div class="grand-total">
                    <p class="mb-4">{{ $lng->GrandTotal }}</p>
                    <span class="cart-grand-total">৳{{ App\Model\Product::currencyPriceRate(Cart::total()) }}</span>
                </div>
                <a href="{{ route('checkout') }}" class="btn-checkout default-btn">{{ $lng->Checkout }}</a>
            </div>
        </div>
    </div>
</div>
