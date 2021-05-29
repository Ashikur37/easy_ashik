@foreach($category->trendingProducts as $product )
<div class="col-lg-2 col-md-4 col-6 mb-30 sm-mb-15 {{$loop->even?'sm-pl':'sm-pr'}}">
    @include('common.product.style1')
</div>
@endforeach  