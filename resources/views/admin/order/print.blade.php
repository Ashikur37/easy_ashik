<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $lng->Invoice }} {{ $order->order_number }}</title>
    <link rel="stylesheet" href="{{ asset('front/css/vendor/vendor-plugin.css') }}" />
    <link rel="stylesheet" href="{{ asset('front') }}/css/page/order-print.css">
</head>

<body onload="window.print()">
    <div class="container my-4">
        <div class="single__order__page">
            <div class="main-content-wrapper order-details">
                <div class="header-logo">
                    <img src="{{ asset('images/banner/' . $setting->invoice_logo) }}">
                </div>
                <h4 class="section-title bb-none">
                    {{ $lng->OrderDetails }}
                </h4>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="content-title">
                                {{ $lng->OrderInfo }}
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->OrderId }}</div>
                                <div class="info-value">{{ $order->order_number }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->Date }}</div>
                                <div class="info-value">
                                    {{ $order->created_at->format('d M Y, h:i a') }}
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->Status }}</div>
                                <span
                                    class="status-badge {{ $order->statusClass() }}">{{ $order->statusText() }}</span>
                            </div>
                            @if ($order->coupon)
                                <div class="info-row">
                                    <div class="info-label">{{ $lng->Coupon }}</div>
                                    <div class="info-value coupon-code">{{ $order->coupon->code }}</div>
                                </div>
                            @endif
                            <div class="info-row">
                                <div class="info-label">{{ $lng->PaymentMethod }}</div>
                                <div class="info-value">{{ $order->payment_method }}
                                    @foreach ($order->additionals as $additional)
                                        <div>
                                            {{ $additional->paymentGatewayAdditional->title }}
                                            {{ $additional->value }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->PaymentStatus }}</div>
                                <div class="info-value {{ $order->paymentStatusClass() }}">
                                    {{ $order->paymentStatusText() }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->ShippingMethod }}</div>
                                <div class="info-value">{{ $order->shipping_method }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="content-title">
                                {{ $lng->Summary }}
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->Discount }}</div>
                                <div class="info-value">৳{{ App\Model\Product::currencyPriceRate($order->discount) }}
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->Tax }}</div>
                                <div class="info-value">৳{{ App\Model\Product::currencyPriceRate($order->tax) }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->SubTotal }}</div>
                                <div class="info-value">৳{{ App\Model\Product::currencyPriceRate($order->total) }}
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->Shipping }}</div>
                                <div class="info-value">
                                    ৳{{ App\Model\Product::currencyPriceRate($order->shipping_cost) }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->GrandTotal }}</div>
                                <div class="info-value grand-total">
                                    ৳{{ App\Model\Product::currencyPriceRate($order->shipping_cost + $order->total) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content-title">
                                {{ $lng->BillingAddress }}
                            </div>
                            <div class="address-info-row">
                                <div class="info-label">
                                    {{ $order->billing_first_name }}</div>
                                <div class="info-label">{{ $order->customer_email }}</div>
                                <div class="info-label">{{ $order->customer_phone }}</div>
                                <div class="info-label">{{ $order->billing_address_1 }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($order->note)
                        <div class="row">
                            <div class="col-12">
                                <div class="content-title">
                                    {{ $lng->OrderNote }}
                                </div>
                                <div class="info-row order-note">
                                    <div class="info-label">
                                        {{ $order->note }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="product-info-table border p-10 mt-25">
                <table class="table product-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">{{ $lng->Product }}</th>
                            <th scope="col">{{ $lng->Price }}</th>
                            <th scope="col">{{ $lng->Quantity }}</th>
                            <th scope="col">{{ $lng->Total }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <div class="product-img-name">
                                        <img src="{{ asset('images/product/') }}/{{ $item->options->image }}"
                                            class="product-img" alt="product-image">
                                        <p class="mb-0">
                                            {{ Str::limit($item->name, 50) }}
                                            <span class="product-attribute">
                                                {!! $item->options->size ? "<span> $lng->Size : " . $item->options->size
                                                    . '</span>' : '' !!}
                                                {!! $item->options->color ? "<span> $lng->Color : " .
                                                    $item->options->colorName . '</span>' : '' !!}
                                                @foreach ($item->options->options as $key => $value)
                                                    <span>{{ $key }}: {{ $value }}</span>
                                                @endforeach
                                            </span>
                                        </p>
                                    </div>
                                </td>
                                <td><span>৳{{ App\Model\Product::currencyPriceRate($item->price) }}</span></td>
                                <td><span>{{ $item->qty }}</span></td>
                                <td><span>৳{{ App\Model\Product::currencyPriceRate($item->subtotal) }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="product-table-md">
                    @foreach ($items as $item)
                        <div class="md-product-row">
                            <div class="product-img">
                                <img src="{{ asset('images/product/') }}/{{ $item->options->image }}"
                                    alt="product-image">
                            </div>
                            <div class="product-desc">
                                <div class="name-qnt">
                                    <p class="mb-0">
                                        {{ Str::limit($item->name, 50) }}
                                    </p>
                                    <span class="qnt">x {{ $item->qty }}</span>
                                </div>
                                <div class="product-price">
                                    <span>{{ App\Model\Product::currencyPriceRate($item->price) }}</span>
                                    <span>{{ App\Model\Product::currencyPriceRate($item->subtotal) }}</span>
                                </div>
                                <div class="product-attributes">
                                    {!! $item->options->size ? '<span> $lng->Size :' . $item->options->size . '</span>'
                                    : '' !!}
                                    {!! $item->options->size ? '<span> $lng->Color :' . $item->options->color .
                                        '</span>' : '' !!}
                                    @foreach ($item->options->options as $key => $value)
                                        <span>{{ $key }}:{{ $value }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>

</html>
