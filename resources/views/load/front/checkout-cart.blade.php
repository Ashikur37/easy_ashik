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
                <input id="coupon-input" type="text" class="form-control" placeholder="Enter Coupon">
                <div class="input-group-append">
                    <button id="coupon-apply-btn" class="sm-btn default-btn" type="button">{{ $lng->Apply }}</button>
                </div>
            </div>
        @endif
    </div>
    <div class="col-lg-6 col-md-5 col-12 ">
        <div class="checkout-process-content">
            <div class="flex-item">
                <p>{{ $lng->Discount }}</p>
                <span>{{ App\Model\Product::currencyPriceRate(Cart::discount()) }}</span>
            </div>
            <div class="flex-item">
                <p>{{ $lng->Tax }}</p>
                <span>{{ App\Model\Product::currencyPriceRate(Cart::tax()) }}</span>
            </div>
            <div class="flex-item">
                <p class="mb-md-0">{{ $lng->SubTotal }}</p>
                <span>{{ App\Model\Product::currencyPriceRate(Cart::subtotal()) }}</span>
            </div>
            <div class="sm-grand-total">
                <div class="grand-total">
                    <p class="mb-0">{{ $lng->GrandTotal }}</p>
                    <span>{{ App\Model\Product::currencyPriceRate(Cart::total()) }}</span>
                </div>
                <div>
                    @if (Session::has('coupon'))
                        <div class="applied-coupon sm-applied-coupon">
                            <span class="coupon-content">
                                <span class="coupon-name">{{ Session::get('coupon') }}"</span> {{ $lng->Applied }}<span
                                    class="coupon-closer"><i class="ri-close-line"></i></span>
                            </span>
                        </div>
                    @else
                        <button class="btn-coupon apply-coupon-trigger" type="button">{{ $lng->ApplyCoupon }}</button>
                        <div class="sm-coupon-input">
                            <div class="input-group">
                                <input id="sm-coupon-input" type="text" class="form-control" placeholder="Enter Coupon">
                                <div class="input-group-append">
                                    <button id="sm-coupon-apply-btn" class="sm-btn default-btn"
                                        type="button">{{ $lng->Apply }}</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <button class="btn-checkout default-btn">{{ $lng->Order }}</button>
            </div>
        </div>
    </div>
    <div class="col-3 lg-grand-total">
        <div class="grand-total">
            <p class="mb-4">{{ $lng->GrandTotal }}</p>
            <span class="total-price">{{ App\Model\Product::currencyPriceRate(Cart::total()) }}</span>
        </div>
        <button class="default-btn btn-checkout">{{ $lng->Order }}</button>
    </div>
</div>
