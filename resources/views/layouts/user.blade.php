<!doctype html>
<html lang="en">
<head>
    <title>
        @hasSection('title')
            @yield('title')
        @else
        @endif
    </title>
    <link rel="icon" href="{{ URL::to('/images/banner/' . $setting->favicon) }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @sectionMissing('meta')
        <meta name="keywords" content="{{ $setting->meta_title }}">
        <meta name="description" content="{{ $setting->meta_description }}">
    @endif
    @yield('meta')
    <link rel="stylesheet" href="{{ asset('front/css/vendor/vendor-plugin.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/user.css') }}">
    @yield('pageStyle')
</head>

<body style="--dynamic-color:{{ $setting->theme_color }}">
    @include('includes.front.header')
    <div class="d-none" id="site-loader"><img alt="loader" class="loader__image"
            src="{{ asset('images/banner/' . $setting->site_loader) }}"></div>
    <div class="user__panel__page">
        <div class="container">
            <div class="row py-20 sm-py-10">
                <div class="white-bg user-left-menu">
                    <div class="user-info">
                        <img alt="avatar"
                            src="{{ auth()->user()->provider ? auth()->user()->avatar : asset('images/avatar.png') }}" />
                        <div class="name-balance">
                            <span class="name">{{ auth()->user()->name." ".auth()->user()->lastname }}</span>
                            <span class="balance">
                                {{ $lng->Balance }}:
                                {{ App\Model\Product::currencyPriceRate(auth()->user()->affiliate_balance) }}
                            </span>
                        </div>
                        <button class="default-btn signOut_btn"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ $lng->SignOut }}</button>
                    </div>
                    <div class="user-panel-sidebar">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->route()->getName() == 'user.home'
                                    ? 'active'
                                    : '' }}" id="dashboard-tab" href="{{ route('user.home') }}"><i
                                        class="ri-dashboard-line"></i>{{ $lng->Dashboard }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->route()->getName() == 'user.order'
                                    ? 'active'
                                    : '' }}" id="profile-tab" href="{{ route('user.order') }}"><i
                                        class="ri-clipboard-line"></i>{{ $lng->MyOrder }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->route()->getName() == 'user.wishlist'
                                    ? 'active'
                                    : '' }}" id="messages-tab" href="{{ route('user.wishlist') }}"><i
                                        class="ri-heart-line"></i>{{ $lng->MyWishList }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->route()->getName() == 'user.review'
                                    ? 'active'
                                    : '' }}" id="settings-tab" href="{{ route('user.review') }}"><i
                                        class="ri-star-half-fill"></i>{{ $lng->MyReviews }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->route()->getName() == 'user.affiliation'
                                    ? 'active'
                                    : '' }}" id="affliation-tab" href="{{ route('user.affiliation') }}"><i
                                        class="ri-team-line"></i>{{ $lng->Affiliation }}</a>
                            </li>
                            @if ($setting->affiliate_withdraw)
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->route()->getName() == 'user.withdraw'
                                        ? 'active'
                                        : '' }}" id="withdraw-tab" href="{{ route('user.withdraw') }}"><i
                                            class="ri-currency-line"></i>{{ $lng->Withdraw }}</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link {{ request()->route()->getName() == 'user.ticket'
                                    ? 'active'
                                    : '' }}" id="user-tab" href="{{ route('user.ticket') }}"><i
                                        class="ri-chat-4-line"></i>{{ $lng->Ticket }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->route()->getName() == 'user.change-password'
                                    ? 'active'
                                    : '' }}" id="changepassword-tab" href="{{ route('user.change-password') }}"><i
                                        class="ri-key-line"></i>{{ $lng->ChangePassword }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->route()->getName() == 'user.change-profile'
                                    ? 'active'
                                    : '' }}" id="changeprofile-tab" href="{{ route('user.change-profile') }}"><i class="ri-profile-line"></i>Update Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->route()->getName() == 'user.notification'
                                    ? 'active'
                                    : '' }}" id="Notification-tab" href="{{ route('user.notification') }}"><i
                                        class="ri-notification-2-line"></i>{{ $lng->Notification }}
                                    <span
                                        class="custom-badge">{{ auth()->user()->unreadNotifications()->count() }}</span>
                                </a>
                            </li>
                            @if(auth()->user()->is_vendor==0)
                            <li class="nav-item">
                                <a class="nav-link {{ request()->route()->getName() == 'vendor.apply'
                                    ? 'active'
                                    : '' }}" id="vendor-tab" href="{{ route('vendor.apply') }}"><i class="ri-store-line"></i>{{ $lng->ApplyForVendor }}
                                </a> 
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->route()->getName() == 'vendor.home'
                                    ? 'active'
                                    : '' }}" id="vendor-tab" href="{{ route('vendor.home') }}"><i class="ri-store-line"></i>Vendor Panel
                                </a> 
                            </li>
                            @endif
                            <li class="nav-item">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="nav-link"><i
                                        class="ri-logout-circle-line"></i>{{ $lng->SignOut }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="user-panel-md-dropdown">
                        <div class="form-group">
                            <select class="nice-select ts-custom-select wide" id="md__sidebar">
                                <option {{ request()->route()->getName() == 'user.home'
                                    ? 'selected'
                                    : '' }} value="{{ route('user.home') }}">{{ $lng->Dashboard }}</option>
                                <option {{ request()->route()->getName() == 'user.order'
                                    ? 'selected'
                                    : '' }} value="{{ route('user.order') }}">{{ $lng->MyOrder }}</option>
                                <option {{ request()->route()->getName() == 'user.wishlist'
                                    ? 'selected'
                                    : '' }} value="{{ route('user.wishlist') }}">{{ $lng->MyWishList }}</option>
                                <option {{ request()->route()->getName() == 'user.review'
                                    ? 'selected'
                                    : '' }} value="{{ route('user.review') }}">{{ $lng->MyReviews }}</option>
                                <option {{ request()->route()->getName() == 'user.affiliation'
                                    ? 'selected'
                                    : '' }} value="{{ route('user.affiliation') }}">{{ $lng->Affiliation }}</option>
                                <option {{ request()->route()->getName() == 'user.notification'
                                    ? 'selected'
                                    : '' }} value="{{ route('user.notification') }}">{{ $lng->Notification }}
                                    ({{ auth()->user()->unreadNotifications()->count() }})</option>
                                @if ($setting->affiliate_withdraw)
                                    <option {{ request()->route()->getName() == 'user.withdraw'
                                        ? 'selected'
                                        : '' }} value="{{ route('user.withdraw') }}">{{ $lng->Withdraw }}</option>
                                @endif
                                <option {{ request()->route()->getName() == 'user.ticket'
                                    ? 'selected'
                                    : '' }} value="{{ route('user.ticket') }}">{{ $lng->Ticket }}</option>
                                <option {{ request()->route()->getName() == 'user.change-password'
                                    ? 'selected'
                                    : '' }} value="{{ route('user.change-password') }}">{{ $lng->ChangePassword }}
                                </option>
                                <option {{ request()->route()->getName() == 'user.change-profile'
                                    ? 'selected'
                                    : '' }} value="{{ route('user.change-profile') }}">Update Profile
                                </option>
                                 @if(auth()->user()->is_vendor==0)
                                <option {{ request()->route()->getName() == 'vendor.apply'
                                    ? 'selected'
                                    : '' }} value="{{ route('vendor.apply') }}">{{ $lng->ApplyForVendor }}
                                </option>
                                @else
                                 <option {{ request()->route()->getName() == 'vendor.home'
                                    ? 'selected'
                                    : '' }} value="{{ route('vendor.home') }}">Vendor Panel
                                </option>
                                @endif
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="white-bg user-right-centent">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('includes.front.footer')
    <section class="product-cart-status" id="aside-cart">
        @include('includes.front.cart')
    </section>
    <script src="{{ asset('front/js/vendor/jquery.min.js') }}"></script>
    @yield('pageScripts')
    <script src="{{ asset('front/js/vendor/plugins.js') }}"></script>
    <!-- core js -->
    <script src="{{ asset('front/js/core.js') }}"></script>
    <script>
        var mainUrl = "{{ URL::to('/') }}";
        var lng = {!!json_encode($lng) !!}
        var loggedIn = "{{ auth()->check() }}";
        $(function() {
            $("#md__sidebar").on('change', function() {
                window.location.href = $(this).val();
            });
            $(".notification-link").on('click', function() {
                redirectUrl = $(this).data("url");
                $.ajax({
                    url: "{{ URL::to('/notification/read/') }}" + $(this).data("id"),
                    type: 'GET',

                }).always(function(data) {
                    window.location.href = redirectUrl
                })
            });
            @if(Session::has('success'))     
            toastr.success('{{ Session::get('success') }}') 
            @endif
            @if(Session::has('error'))
            toastr.error('{{ Session::get('error') }}')
            @endif
        })

    </script>
</body>

</html>
