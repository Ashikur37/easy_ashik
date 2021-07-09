@if ($products->count() == 0)
    <span class="noresults">{{ $lng->NoResultFound }}</span>
@else
    @foreach ($products as $product)
        <div class="suggested-products-info">
            <div class="product-title">
                <a href="{{ route('front-product.show', $product->slug) }}">{!!
                    App\Model\Product::highlight(Str::limit($product->name, 60, '..'), $key) !!}
                    <br>
                    <span class="product-price">৳{{ App\Model\Product::currencyPrice($product->price) }}</span>
                </a>
            </div>
            <div class="product-img">
                <a href="{{ route('front-product.show', $product->slug) }}">
                    <img src="{{ asset('images/product/' . $product->image) }}" alt="{{ $product->name }}">
                </a>
            </div>
        </div>
    @endforeach
    <div class="total-suggested-product">
        <a class="search-all" href="#">{{ $lng->SeeAll }} {{ $count }} {{ $lng->Results }}
        </a>
    </div>
@endif
