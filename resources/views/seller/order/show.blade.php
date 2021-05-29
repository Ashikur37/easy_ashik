@extends('layouts.vendor',['headerText' => $lng->ViewOrder])
@section('title', "$lng->Order")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->ViewOrder }}</a>
    </li>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/order-show.css">
@endsection
@section('content')

    <div class="container-fluid">
        <div class="single__order__page">
            <div class="main-content-wrapper order-details">
                <h4 class="section-title">
                    {{ $lng->OrderDetails }}
                    <a href="{{ URL::to('vendor/order/print/' . $order->id) }}" target="_blank">
                        <i class="ri-printer-fill"></i>
                    </a>
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
                                <div class="info-value">
                                    {!! $order->getStatusDropDown('select2 select2-wide', 'status-dropdown') !!}
                                </div>
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
                                            {{ $additional->paymentGatewayAdditional->title }} {{ $additional->value }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->PaymentStatus }}</div>
                                <div class="info-value">
                                    <select id="payment-status-dropdown" class="select2">
                                        <option value="0" {{ $order->payment_status == 0 ? 'selected' : '' }}>
                                            {{ $lng->Unpaid }}</option>
                                        <option value="1" {{ $order->payment_status == 1 ? 'selected' : '' }}>
                                            {{ $lng->Paid }}</option>
                                    </select>
                                </div>
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
                                <div class="info-value">{{ App\Model\Product::currencyPriceRate($order->discount) }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->Tax }}</div>
                                <div class="info-value">{{ App\Model\Product::currencyPriceRate($order->tax) }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->SubTotal }}</div>
                                <div class="info-value">{{ App\Model\Product::currencyPriceRate($order->total) }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->Shipping }}</div>
                                <div class="info-value">{{ App\Model\Product::currencyPriceRate($order->shipping_cost) }}
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">{{ $lng->GrandTotal }}</div>
                                <div class="info-value grand-total">
                                    {{ App\Model\Product::currencyPriceRate($order->shipping_cost + $order->total) }}</div>
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
                                <div class="info-label">{{ $order->billing_first_name}}
                                </div>
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
            <div class="product-info-table mrl-10 mt-20">
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
                                                {!! $item->options->size ? "<span> $lng->Size : " . $item->options->size .
                                                    '</span>' : '' !!}
                                                {!! $item->options->color ? "<span> $lng->Color : " .
                                                    $item->options->colorName . '</span>' : '' !!}
                                                @foreach ($item->options->options as $key => $value)
                                                    <span>{{ $key }}: {{ $value }}</span>
                                                @endforeach
                                            </span>
                                        </p>
                                    </div>
                                </td>
                                <td><span>{{ App\Model\Product::currencyPriceRate($item->price) }}</span></td>
                                <td><span>{{ $item->qty }}</span></td>
                                <td><span>{{ App\Model\Product::currencyPriceRate($item->subtotal) }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="product-table-md">
                    @foreach ($items as $item)
                    @if(\App\Model\Product::find($item->id)->user_id==auth()->user()->id)
                        <div class="md-product-row">
                            <div class="product-img">
                                <img src="{{ asset('images/product/') }}/{{ $item->options->image }}" alt="product-image">
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
                                    {!! $item->options->size ? '<span> $lng->Size :' . $item->options->size . '</span>' : ''
                                    !!}
                                    {!! $item->options->size ? '<span> $lng->Color :' . $item->options->color . '</span>' :
                                    '' !!}
                                    @foreach ($item->options->options as $key => $value)
                                        <span>{{ $key }}:{{ $value }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/admin/js/vendor/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2({
                minimumResultsForSearch: -1
            });
            $("#status-dropdown").on('change', function() {
                $.ajax({
                    url: "{{ URL::to('/admin/order/status/' . $order->id) }}/" + $(this).val(),
                    type: 'GET',
                }).always(function(data) {
                    toastr.success('{{ $lng->OrderUpdatedSuccessfully }}')
                })
            })
            $("#payment-status-dropdown").on('change', function() {
                $.ajax({
                    url: "{{ URL::to('/admin/order/payment-status/' . $order->id) }}/" + $(this)
                        .val(),
                    type: 'GET',
                }).always(function(data) {
                    toastr.success('{{ $lng->OrderUpdatedSuccessfully }}')
                })
            })
        })
    </script>
@endsection
