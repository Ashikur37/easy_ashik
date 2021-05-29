<i class="ri-shopping-bag-line"></i>
@if(Cart::instance('default')->content()->count()>0)
<span class="counter-badge">{{Cart::instance('default')->content()->count()}}</span>
@endif