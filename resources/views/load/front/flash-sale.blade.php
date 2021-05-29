@foreach($products as $product)
    <div class="col-lg-3 col-md-4 col-6 mb-5 {{$loop->even?'sm-pl':'sm-pr'}}">
      @include('common.product.style1') 
    </div>
 @endforeach