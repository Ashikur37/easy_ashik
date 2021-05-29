<div class="cart-header">
<h4><i class="ri-shopping-basket-line"></i><span> {{Cart::instance('default')->content()->count()}} {{$lng->Items}}</span></h4>
    <div class="sidebar-cart-close"><i class="ri-close-line"></i></div>
</div>
@if(Cart::instance('default')->content()->count()==0)
<div class="empty-cart">
    <div class="empty-product">
        <svg width="100%" height="100%" viewBox="0 0 369 285" version="1.1"  xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve">
            <g transform="matrix(1,0,0,1,-315.999,-1457.77)">
                <g transform="matrix(0.981354,0,0,0.994036,-2348.38,1100)">
                    <g transform="matrix(1.019,0,0,1.006,2393,-1206.05)">
                        <path d="M463.181,1767.5C483.419,1767.5 499.977,1784.06 499.977,1804.3C499.977,1824.54 483.419,1841.09 463.181,1841.09C442.944,1841.09 426.386,1824.54 426.386,1804.3C426.386,1784.06 442.944,1767.5 463.181,1767.5ZM573.568,1767.5C593.806,1767.5 610.364,1784.06 610.364,1804.3C610.364,1824.54 593.806,1841.09 573.568,1841.09C553.331,1841.09 536.772,1824.54 536.772,1804.3C536.772,1784.06 553.331,1767.5 573.568,1767.5ZM463.181,1785.9C452.915,1785.9 444.783,1794.03 444.783,1804.3C444.783,1814.56 452.915,1822.69 463.181,1822.69C473.447,1822.69 481.579,1814.56 481.579,1804.3C481.579,1794.03 473.447,1785.9 463.181,1785.9ZM573.568,1785.9C563.302,1785.9 555.17,1794.03 555.17,1804.3C555.17,1814.56 563.302,1822.69 573.568,1822.69C583.834,1822.69 591.966,1814.56 591.966,1804.3C591.966,1794.03 583.834,1785.9 573.568,1785.9ZM325.228,1556.62L325.172,1556.62C318.97,1556.55 315.999,1561.19 315.999,1565.82C315.999,1570.46 318.979,1575.12 325.198,1575.02C325.21,1575.02 325.222,1575.02 325.235,1575.02L352.775,1575.02C353.896,1575.02 354.88,1575.77 355.182,1576.85L399.007,1733.42L399.054,1733.6L399.156,1733.93C400.72,1739.73 403.145,1745.53 407.495,1750.41C411.852,1755.32 418.714,1759 426.386,1759C426.386,1759 610.364,1759 610.364,1759C617.962,1759 624.861,1755.58 629.488,1750.64C634.045,1745.72 636.705,1739.58 637.812,1733.13C637.837,1732.99 637.873,1732.85 637.922,1732.71C637.922,1732.71 683.845,1604.13 683.845,1604.13C685.858,1592.05 667.846,1589.01 665.703,1600.91C665.678,1601.05 665.643,1601.18 665.597,1601.31C665.597,1601.31 619.673,1729.9 619.673,1729.9C618.477,1737.07 614.982,1740.6 610.364,1740.6L426.432,1740.6L426.359,1740.6C422.238,1740.48 420.157,1738.26 418.851,1735.37C417.979,1733.43 417.452,1731.2 416.899,1729.13L370.983,1563.84L370.957,1563.74C369.98,1559.54 366.278,1556.62 361.993,1556.62L325.228,1556.62ZM562.16,1588.17C565.173,1585.1 565.172,1580.27 562.172,1577.22C562.172,1577.22 562.147,1577.19 562.16,1577.21C559.139,1574.22 554.255,1574.22 551.243,1577.2L520.05,1608.41C519.581,1608.88 518.945,1609.14 518.281,1609.14C517.618,1609.14 516.982,1608.88 516.513,1608.41C516.513,1608.41 485.8,1577.66 485.804,1577.67C482.806,1574.68 477.945,1574.68 474.958,1577.67C471.964,1580.66 471.965,1585.57 474.962,1588.56L505.67,1619.22C506.14,1619.69 506.404,1620.32 506.404,1620.99C506.404,1621.65 506.141,1622.29 505.673,1622.76C505.673,1622.76 474.732,1653.73 474.725,1653.73C471.718,1656.72 471.72,1661.62 474.708,1664.66C477.749,1667.67 482.643,1667.68 485.656,1664.7L516.605,1633.72C517.073,1633.25 517.71,1632.99 518.373,1632.99C519.037,1632.99 519.673,1633.25 520.142,1633.72C520.142,1633.72 550.854,1664.46 550.851,1664.46C553.848,1667.45 558.709,1667.45 561.702,1664.46C564.698,1661.47 564.697,1656.56 561.7,1653.57L530.984,1622.91C530.515,1622.44 530.251,1621.8 530.251,1621.14C530.25,1620.48 530.513,1619.84 530.982,1619.37C530.982,1619.37 562.16,1588.17 562.16,1588.17C562.156,1588.17 562.159,1588.17 562.16,1588.17Z" />
                    </g>
                </g>
            </g>
        </svg>
        <h4>{{$lng->YourCartIsEmpty}}</h4>
    </div>
</div>
@endif
<div class="cart-product-content custom-scrollbar" id="ascroll">
    @foreach(Cart::instance('default')->content() as $item) 
    <div class="product-info">
        <div class="product-img">
            <img src="{{asset('images/product')}}/{{$item->options->image}}" alt="{{$item->name}}">
        </div>
        <div class="product-content-wrapper">
            <div class="content-flex">
                <a class="product-details" href="{{route('front-product.show',$item->options->slug)}}">
                    {{$item->name}}
                </a>
                <span class="product-remove" data-row="{{$item->rowId}}" data-id="{{$item->id}}"><i class="ri-delete-bin-line"></i></span>
            </div>
            <div class="content-flex mt-3">
                <div class="product-attributes">
                    <p>{{App\Model\Product::currencyPriceRate($item->price)}} </p>
                    @if($item->options->size)
                        <span>{{$lng->Size}} : {{$item->options->size}}</span>
                    @endif
                    @if($item->options->color)
                        <span>{{$lng->Color}} : {{$item->options->colorName}}</span>
                    @endif
                    @foreach ($item->options->options as $key => $value)
                        <span>{{$key}} : {{$value}}</span>
                    @endforeach
                </div>
                <div class="product-count">
                    <div class="btn-minus" data-id="{{$item->id}}" data-row="{{$item->rowId}}">
                        <button class="counter">
                            <span><i class="ri-subtract-line"></i></span>
                        </button>
                    </div>
                    <input type="text" readonly class="counter-field qty-{{$item->rowId}}" value="{{$item->qty}}">
                    <div class="btn-plus" data-row="{{$item->rowId}}">
                        <button class="counter counter-plus">
                            <span><i class="ri-add-line"></i></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    @endforeach
</div>
@if(Cart::instance('default')->content()->count()>0)
<div class="cart-footer">
    <div class="cart-subtotal">
        <h4 class="mb-0">{{$lng->SubTotal}}</h4>
        <span class="cart-sub-total">{{App\Model\Product::currencyPriceRate(Cart::subtotal())}}</span>
    </div>
    <div class="cart-action-btn">
        <a href="{{route('cart')}}" class="default-btn cart-btn">
            {{$lng->View}} {{$lng->Cart}}
        </a> 
        <a href="{{route('checkout')}}" class="default-btn checkout-btn">
            {{$lng->Checkout}} 
        </a>
    </div>
</div>
@endif