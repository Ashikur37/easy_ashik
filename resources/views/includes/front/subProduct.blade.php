@foreach ($subCategory->products->take(8) as $product)
        @include('common.product.style1')
@endforeach