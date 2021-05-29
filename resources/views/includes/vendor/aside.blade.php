<div class="sidebar-wrapper custom-scrollbar" id="custom-scrollbar">
    <a class="logo" href="{{URL::to('/admin')}}">
        <img src="{{asset('images/banner/'.$setting->admin_logo)}}" alt="logo"></a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{URL::to('/vendor')}}">
                <i class="ri-dashboard-line"></i>
                {{$lng->Dashboard}}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{in_array(request()->route()->getName(),["vendor.product_list","vendor.product_create","attribute-set.index","attribute.index","review.index","comment.index","badge.index","brand.index","coupon.index","color.index","size.index"])?"menu_active":""}}"
                href="#" data-toggle="collapse"
                aria-expanded="{{in_array(request()->route()->getName(),["vendor.product_list","vendor.product_create","attribute-set.index","attribute.index","review.index","comment.index","badge.index","brand.index","coupon.index","color.index","size.index"])?"true":"false"}}"
                data-target="#submenuProduct" aria-controls="submenuProduct">
                <i class="ri-codepen-line"></i>{{$lng->Products}}</a>
            <div id="submenuProduct" class="collapse submenu
            {{in_array(request()->route()->getName(),["vendor.product_list","vendor.product_create","attribute-set.index","attribute.index","review.index","comment.index","badge.index","brand.index","coupon.index","color.index","size.index"])?"show":""}}
            ">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vendor.product_create')}}"> {{$lng->AddProduct}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('/vendor/product-import')}}">Import Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{request()->route()->getName()=='vendor.product_list'?'active ':''}}nav-link"
                            href="{{route('vendor.product_list')}}">{{$lng->ProductList}}</a>
                    </li>
                </ul>
            </div>
        </li>
        {{-- End Product --}}
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{route('affiliate.index')}}"><i class="ri-numbers-line"></i>{{$lng->Affiliation}}</a>
        </li> --}}
        {{-- Order --}}
        <li class="nav-item">
            <a class="nav-link {{request()->route()->getName()=='order.index'?'active ':''}}"
                href="{{route('vendor_order.index')}}"><i class="ri-clipboard-line"></i>Order</a>
        </li>
        {{-- End Order --}}

        {{-- userpanel --}}
        <li class="nav-item">
            <a class="nav-link {{request()->route()->getName()=='order.index'?'active ':''}}"
                href="{{route('user.home')}}"><i class="ri-user-line"></i>User panel</a>
        </li>
        {{-- End user panel --}}
        {{-- userpanel --}}
        <li class="nav-item">
            <a class="nav-link {{request()->route()->getName()=='user.withdraw'?'active ':''}}"
                href="{{route('user.withdraw')}}"><i class="ri-currency-line"></i>Withdraw</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->route()->getName()=='vendor.change-profile'?'active ':''}}"
                href="{{route('vendor.change-profile')}}"><i class="ri-currency-line"></i>Update Store</a>
        </li>
        {{-- End user panel --}}
        {{-- signout --}}
        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <a class="nav-link "
                href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="ri-logout-box-r-line"></i>Logout (EVM00{{auth()->user()->id}})</a>
        </li>
        {{-- End signout --}}
    </ul> 
</div> 
