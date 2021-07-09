<div class="row lg-cart-table">
    <div class="col">
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
                                <p class="product-total row-total-{{ $item->rowId }}">৳
                                    {{ App\Model\Product::currencyPriceRate($item->priceTotal) }}</p>
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
                                <p class="product-price">{{ App\Model\Product::currencyPriceRate($item->price) }}</p>
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

