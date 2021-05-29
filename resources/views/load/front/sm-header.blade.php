<a href="{{route('user.wishlist')}}"><i class="ri-heart-line"></i><span class="counter-badge">{{$wishCount}}</span></a>
<a href="{{route('compare')}}"><i class="ri-shuffle-line"></i>
    @if(Cart::instance('compare-list')->content()->count())
    <span class="counter-badge">
    {{Cart::instance('compare-list')->content()->count()}}
    </span>
    @endif
</a> 
<a href="#" class="order-track-button"><i class="ri-focus-3-line"></i></a>