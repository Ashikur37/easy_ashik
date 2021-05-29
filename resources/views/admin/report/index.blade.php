@extends('layouts.admin',['headerText' => $lng->Report])
@section('title', "$lng->Report")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->Report }}</a>
    </li>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/page/report.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/flatpickr.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header">
                    <div class="d-flex">
                        <div>
                            <h4 class="mb-0">
                                {{ request()->type == 'sale' ? 'Sales Report' : '' }}
                                {{ request()->type == 'order' ? 'Customer Order Report' : '' }}
                                {{ request()->type == 'product' ? 'Product Reporrt' : '' }}
                                {{ request()->type == 'coupon' ? 'Coupon Report' : '' }}
                                {{ request()->type == 'payment-gateway' ? 'Payment Gateway Report' : '' }}
                                {{ request()->type == 'page' ? 'Page Report' : '' }}
                            </h4>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div>
                            <span class="default-btn aside-report">
                                {{ $lng->Filters }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-table">
                    <div class="table-responsive">
                        <table class="table table-striped first">
                            @if (!request()->type || request()->type == 'order')
                                <thead>
                                    <tr>
                                        <th>{{ $lng->Name }}</th>
                                        <th>{{ $lng->Email }}</th>
                                        <th>
                                            {{ $lng->Group }}
                                        </th>
                                        <th>{{ $lng->Order }}</th>
                                        <th>{{ $lng->Product }}</th>
                                        <th>{{ $lng->Total }}</th>
                                        <th>{{ $lng->Discount }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->customer_first_name . ' ' . $order->customer_last_name }}</td>
                                            <td>{{ $order->customer_email }}</td>
                                            <td>
                                                {{ $order->customer_id ? 'Registered' : 'Guest' }}
                                            </td>
                                            <td>{{ $order->no_order }}</td>
                                            <td>{{ $order->product_count }}</td>
                                            <td>{{ App\Model\Product::currencyPriceRate($order->total) }}</td>
                                            <td>{{ App\Model\Product::currencyPriceRate($order->discount) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            @elseif(request()->type&&request()->type=='sale')
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>{{ $lng->Order }}</th>
                                        <th>
                                            {{ $lng->Product }}
                                        </th>
                                        <th>{{ $lng->Shipping }}</th>
                                        <th>{{ $lng->Discount }}</th>
                                        <th>{{ $lng->Tax }}</th>
                                        <th>{{ $lng->Total }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->created_at }}</td>
                                            <td>
                                                {{ $order->no_order }}
                                            </td>
                                            <td>{{ $order->product_count }}</td>
                                            <td>{{ App\Model\Product::currencyPriceRate($order->shipping_cost) }}</td>
                                            <td>{{ App\Model\Product::currencyPriceRate($order->discount) }}</td>
                                            <td>{{ App\Model\Product::currencyPriceRate($order->tax) }}</td>
                                            <td>{{ App\Model\Product::currencyPriceRate($order->total) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @elseif(request()->type&&request()->type=='product')
                                <thead>
                                    <tr>
                                        <th>{{ $lng->Product }}</th>
                                        <th>
                                            {{ $lng->Order }}
                                        </th>
                                        <th>{{ $lng->Quantity }}</th>
                                        <th>{{ $lng->Total }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->order_count }}</td>
                                            <td>{{ $product->sold }}</td>
                                            <td>{{ App\Model\Product::currencyPriceRate($product->total) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @elseif(request()->type&&request()->type=='coupon')
                                <thead>
                                    <tr>
                                        <th>{{ $lng->CouponCode }}</th>
                                        <th>{{ $lng->Start }}</th>
                                        <th>{{ $lng->End }}</th>
                                        <th>
                                            {{ $lng->Limit }}
                                        </th>
                                        <th>{{ $lng->Used }}</th>

                                        <th>{{ $lng->Discount }}</th>
                                        <th>{{ $lng->Total }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $coupon)
                                        <tr>
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ $coupon->start }}</td>
                                            <td>{{ $coupon->end }}</td>
                                            <td>{{ $coupon->limit }}</td>
                                            <td>{{ $coupon->order_count }}</td>
                                            <td>{{ App\Model\Product::currencyPriceRate($coupon->discount) }}</td>
                                            <td>{{ App\Model\Product::currencyPriceRate($coupon->total) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @elseif(request()->type&&request()->type=='payment-gateway')
                                <thead>
                                    <tr>
                                        <th>{{ $lng->Method }}</th>
                                        <th>{{ $lng->Order }}</th>
                                        <th>{{ $lng->Discount }}</th>
                                        <th>
                                            {{ $lng->Total }}
                                        </th>
                                        <th>{{ $lng->Paid }}</th>

                                        <th>{{ $lng->Unpaid }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gateways as $gateway)
                                        <tr>
                                            <td>{{ $gateway->payment_method }}</td>
                                            <td>{{ $gateway->order_count }}</td>
                                            <td>{{ App\Model\Product::currencyPriceRate($gateway->discount) }}</td>
                                            <td>{{ App\Model\Product::currencyPriceRate($gateway->total) }}</td>
                                            <td>{{ App\Model\Product::currencyPriceRate($gateway->paid) }}</td>
                                            <td>{{ App\Model\Product::currencyPriceRate($gateway->unpaid) }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            @elseif(request()->type&&request()->type=='page')
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>{{ $lng->Total }}</th>
                                        <th>{{ $lng->New }}</th>
                                        <th>
                                            {{ $lng->Unique }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pages as $page)
                                        <tr>
                                            <td>{{ $page->visit_date }}</td>
                                            <td>{{ $page->visits }}</td>
                                            <td>{{ $page->new_visitors }}</td>
                                            <td>{{ $page->unique_visitor }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                        {!! $links !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- filter option --}}
    <section class="report-filter-wrapper">
        <div class="header">
            <h4><span> {{ $lng->Filters }}</span></h4>
            <div class="aside-report-closer"><i class="ri-close-fill"></i></div>
        </div>
        <form action="{{ route('report.index') }}" method="GET">
            <div class="report-filter-content">
                <div class="form-group">
                    <label>{{ $lng->ReportType }} </label>
                    <select id="type" required name="type" class="select2 select2-wide">
                        <option value="">{{ $lng->SelectRreport }}</option>
                        <option value="sale">{{ $lng->Sales }}</option>
                        <option value="order">{{ $lng->CustomerOrder }}</option>
                        <option value="product">{{ $lng->Product }}</option>
                        <option value="coupon"> {{ $lng->Coupon }}</option>
                        <option value="payment-gateway">{{ $lng->PaymentGateway }}</option>
                        <option value="page">{{ $lng->PageView }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>{{ $lng->StartDate }}</label>
                    <input name="start" type="text" class="form-control startDate" placeholder="{{ $lng->Date }}">
                </div>
                <div class="form-group">
                    <label>{{ $lng->EndDate }}</label>
                    <input name="end" type="text" class="form-control endDate" placeholder="{{ $lng->Date }}">
                </div>
                <div id="extra-field"></div>
            </div>
            <div class="report-filter-action">
                <button class="apply-btn">
                    {{ $lng->Apply }}
                </button>
            </div>
        </form>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/admin/js/vendor/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2({
                minimumResultsForSearch: -1
            });
        })
        //aside report section
        $(document).on('click', '.aside-report', {}, function(e) {
            e.preventDefault();
            $('.report-filter-wrapper').addClass('is-active');
            $('.body-overlay').addClass('is-visible');

        });
        $(document).on('click', '.aside-report-closer', {}, function(e) {
            e.preventDefault();
            $('.report-filter-wrapper').removeClass('is-active');
            $('.body-overlay').removeClass('is-visible');
        });

        $('.body-overlay').on('click', function() {
            $(this).removeClass('is-visible');
            $('.report-filter-wrapper').removeClass('is-active');
        });

        $("#type").on('change', function() {
            $("#extra-field").html('');
            if ($(this).val() == "sale" || $(this).val() == "order") {
                $("#extra-field").html(`
                <div class="form-group">
                    <label >{{ $lng->Order }} Status</label>
                    <select  name="order_status" class="select2 select2-wide report-select">
                            <option value="">Select Status</option>
                            <option value="0">Pending</option>
                            <option value="1">Processing</option>
                            <option value="2">On Hold</option>
                            <option value="3">Completed</option>
                            <option value="4">On Delivery</option>
                            <option value="5">Refunded</option>
                            <option value="6">Canceled</option>
                    </select>
                </div>
                <div class="form-group">
                    <label >Payment Status</label>
                    <select  name="payment_status" class="select2 select2-wide report-select">
                            <option value="">Payment Status</option>
                            <option value="0">Unpaid</option>
                            <option value="1">Paid</option>
                    </select>
                </div>
                `)
                $('.report-select').select2({
                    minimumResultsForSearch: -1
                });
            }
        })
    </script>
@endsection
