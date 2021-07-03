<div class="sidebar-wrapper custom-scrollbar" id="custom-scrollbar">
    <a class="logo" href="{{URL::to('/admin')}}">
        <img src="{{asset('images/banner/'.$setting->admin_logo)}}" alt="logo"></a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{URL::to('/admin')}}">
                <i class="ri-dashboard-line"></i>
                {{$lng->Dashboard}}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{in_array(request()->route()->getName(),["product.index","product.create","attribute-set.index","attribute.index","review.index","comment.index","badge.index","brand.index","coupon.index","color.index","size.index"])?"menu_active":""}}"
                href="#" data-toggle="collapse"
                aria-expanded="{{in_array(request()->route()->getName(),["product.index","product.create","attribute-set.index","attribute.index","review.index","comment.index","badge.index","brand.index","coupon.index","color.index","size.index"])?"true":"false"}}"
                data-target="#submenuProduct" aria-controls="submenuProduct">
                <i class="ri-codepen-line"></i>{{$lng->Products}}</a>
            <div id="submenuProduct" class="collapse submenu
            {{in_array(request()->route()->getName(),["product.index","product.create","attribute-set.index","attribute.index","review.index","comment.index","badge.index","brand.index","coupon.index","color.index","size.index"])?"show":""}}
            ">
                <ul class="nav flex-column">
                    @can('product.create')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('product.create')}}">{{$lng->AddProduct}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('/admin/product-import')}}">Import Product</a>
                    </li>
                    @endcan
                    @can('product.index')
                    <li class="nav-item">
                        <a class="{{request()->route()->getName()=='product.index'?'active ':''}}nav-link"
                            href="{{route('product.index')}}">{{$lng->ProductList}}</a>
                    </li>
                    @endcan
                    @can('attribute.index')
                    <li class="nav-item">
                        <a class="nav-link {{in_array(request()->route()->getName(),["attribute-set.index","attribute.index"])?"menu_active":""}}" href="#" data-toggle="collapse" aria-expanded="{{in_array(request()->route()->getName(),["attribute-set.index","attribute.index"])?"true":"false"}}"
                            data-target="#childmenuFeature" aria-controls="childmenuFeature">{{$lng->Product}} {{$lng->Feature}}</a>
                        <div id="childmenuFeature" class="collapse childmenu {{in_array(request()->route()->getName(),["attribute-set.index","attribute.index"])?"show":""}}">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('attribute-set.index')}}">{{$lng->FeatureSet}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('attribute.index')}}">{{$lng->Feature}}</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    @can('color.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('color.index')}}">{{$lng->Color}}</a>
                    </li>
                    @endcan
                    @can('size.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('size.index')}}">{{$lng->Size}}</a>
                    </li>
                    @endcan
                    @can('badge.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('badge.index')}}">{{$lng->Badge}}</a>
                    </li>
                    @endcan
                    @can('brand.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('brand.index')}}">{{$lng->Brand}}</a>
                    </li>
                    @endcan
                    @can('coupon.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('coupon.index')}}">{{$lng->Coupon}}</a>
                    </li>
                    @endcan
                    @can('review.index')
                    <li class="nav-item">
                        <a class="nav-link {{in_array(request()->route()->getName(),["review.index","comment.index"])?"menu_active":""}}" href="#" data-toggle="collapse" aria-expanded="{{in_array(request()->route()->getName(),["review.index","comment.index"])?"true":"false"}}"
                            data-target="#childmenuReview" aria-controls="childmenuReview">{{$lng->ReviewAndComment}}</a>
                        <div id="childmenuReview" class="collapse childmenu {{in_array(request()->route()->getName(),["review.index","comment.index"])?"show":""}}">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('review.index')}}">
                                        {{$lng->Review}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('comment.index')}}">{{$lng->Comment}}</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                   
                    @endcan
                    
                </ul>
            </div>
        </li>
        {{-- End Product --}}
        {{-- Category --}}
        @can('category.index')
        <li class="nav-item">
            <a class="nav-link {{in_array(request()->route()->getName(),["category.index","sub-category.index","child-category.index"])?"menu_active":""}}"
                href="#" data-toggle="collapse"
                aria-expanded="{{in_array(request()->route()->getName(),["category.index","sub-category.index","child-category.index"])?"true":"false"}}"
                data-target="#submenuCategory" aria-controls="submenuCategory">
                <i class="ri-list-check-2"></i>{{$lng->Category}}</a>
            <div id="submenuCategory"
                class="collapse submenu {{in_array(request()->route()->getName(),["category.index","sub-category.index","child-category.index"])?"show":""}}">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="{{request()->route()->getName()=="category.index"?'active':'' }} nav-link"
                            href="{{route('category.index')}}">{{$lng->CategoryList}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{request()->route()->getName()=="sub-category.index"?'active':'' }} nav-link"
                            href="{{route('sub-category.index')}}">{{$lng->SubCategoryList}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{request()->route()->getName()=="child-category.index"?'active':'' }} nav-link"
                            href="{{route('child-category.index')}}">{{$lng->ChildCategoryList}}</a>
                    </li>
                </ul>
            </div>
        </li>
        @endcan
        {{-- End Category --}}
        {{-- Flash Sale --}}
        @can('flash-sale.index')
        <li class="nav-item">
            <a class="nav-link" href="{{route('flash-sale.index')}}"><i
                    class="ri-flashlight-line"></i>Offer</a>
        </li>
        @endcan
        @can('campaign.index')
        <li class="nav-item">
            <a class="nav-link" href="{{route('campaign.index')}}"><i
                    class="ri-flashlight-line"></i>Campaign</a>
        </li>
        @endcan
        @can('shop.index')
        <li class="nav-item">
            <a class="nav-link" href="{{route('shop.index')}}"><i
                    class="ri-flashlight-line"></i>Shop</a>
        </li>
        @endcan
        {{-- End Flash Sale --}}
        {{-- Order --}}
        @can('order.index')
        <li class="nav-item">
            <a class="nav-link {{request()->route()->getName()=='order.index'?'active ':''}}"
                href="{{route('order.index')}}"><i class="ri-clipboard-line"></i>Order</a>
        </li>
        @endcan
        {{-- End Order --}}
        {{-- Customer --}}
        @canany(['customer.index','withdraw.index'])
        <li class="nav-item">
            <a class="nav-link {{in_array(request()->route()->getName(),["customer.index","withdraw.index","affiliate.index","ticket.index","ticket-category.index"])?"menu_active":""}}" href="#" data-toggle="collapse" aria-expanded="{{in_array(request()->route()->getName(),["customer.index","withdraw.index","affiliate.index","ticket.index","ticket-category.index"])?"true":"false"}}" data-target="#submenuCustomer"
                aria-controls="submenuCustomer"> <i class="ri-user-line"></i>{{$lng->Customer}}</a>
            <div id="submenuCustomer" class="collapse submenu {{in_array(request()->route()->getName(),["customer.index","withdraw.index","affiliate.index","ticket.index","ticket-category.index"])?"show":""}}">
                <ul class="nav flex-column">
                    @can('customer.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('customer.index')}}">{{$lng->CustomerList}}</a>
                    </li>
                    @endcan
                    @can('withdraw.index')
                    <li class="nav-item"> 
                        <a class="nav-link" href="{{route('withdraw.index')}}">{{$lng->Withdraw}}</a>
                    </li>
                    @endcan
                    @can('affiliate.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('affiliate.index')}}">{{$lng->Affiliation}}</a>
                    </li>
                    @endcan
                    @can('ticket.index')
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('ticket-category.index')}}">{{$lng->Ticket}} {{$lng->Category}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('ticket.index')}}">{{$lng->Ticket}}</a>
                    </li>
                    @endcan
                </ul>
            </div>
        </li>
        @endcanany
        {{-- End Customer --}}
        
        @canany(['user.index','role.index'])
        <li class="nav-item">
            <a class="nav-link {{in_array(request()->path(),["admin/user","admin/role"])?"menu_active":""}}" href="#" data-toggle="collapse" aria-expanded="{{in_array(request()->path(),["admin/user","admin/role"])?"true":"false"}}" data-target="#submenuuserRole"
                aria-controls="submenuuserRole"> <i class="ri-file-user-line"></i>{{$lng->User}}</a>
            <div id="submenuuserRole" class="collapse submenu {{in_array(request()->path(),["admin/user","admin/role"])?"show":""}}">
                <ul class="nav flex-column">
                    @can('user.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.index')}}">{{$lng->UserList}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vendor.index')}}">Vendor List</a>
                    </li>
                    @endcan
                    @can('role.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('role.index')}}">{{$lng->RoleList}}</a>
                    </li>
                    @endcan
                </ul>
            </div>
        </li>
        @endcanany

        @can('shipping-method.index')
        <li class="nav-item">
            <a class="nav-link" href="{{route('shipping-method.index')}}"><i class="ri-truck-line"></i>{{$lng->ShippingMethod}}</a>
        </li>
        @endcan

        @can('payment-gateway.index') 
        <li class="nav-item">
            <a class="nav-link {{in_array(request()->path(),["admin/payment-setting/general","admin/payment-setting/paypal","admin/payment-setting/ssl-commerz","admin/payment-gateway","admin/payment-setting/stripe","admin/payment-setting/razorpay"])?"menu_active":""}}" href="#" data-toggle="collapse" aria-expanded="{{in_array(request()->path(),["admin/payment-setting/general","admin/payment-setting/paypal","admin/payment-setting/ssl-commerz","admin/payment-gateway","admin/payment-setting/stripe","admin/payment-setting/razorpay"])?"true":"false"}}" data-target="#submenuPaymentSetting"
                aria-controls="submenuPaymentSetting"> <i
                class="ri-bank-card-line"></i>{{$lng->PaymentSetting}}</a> 
            <div id="submenuPaymentSetting" class="collapse submenu {{in_array(request()->path(),["admin/payment-setting/general","admin/payment-setting/paypal","admin/payment-setting/ssl-commerz","admin/payment-gateway","admin/payment-setting/stripe","admin/payment-setting/razorpay"])?"show":""}}">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{URL::to('admin/payment-setting/general')}}">{{$lng->General}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{URL::to('admin/payment-setting/ssl-commerz')}}">{{$lng->SSLCommerz}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{URL::to('admin/payment-setting/paypal')}}">{{$lng->Paypal}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{URL::to('admin/payment-setting/stripe')}}">{{$lng->Stripe}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{URL::to('admin/payment-setting/razorpay')}}">{{$lng->Razorpay}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('payment-gateway.index')}}">{{$lng->PaymentGateway}}</a>
                    </li>
                </ul>
            </div>
        </li>
        @endcan
        @can('currency.index')
        <li class="nav-item">
            <a class="nav-link" href="{{route('currency.index')}}"><i
                    class="ri-money-dollar-box-line"></i>{{$lng->Currency}}</a>
        </li>
        @endcan
        @can('language.index')
        <li class="nav-item">
            <a class="nav-link" href="{{URL::to('admin/language')}}"><i class="ri-font-color"></i>{{$lng->Language}}</a>
        </li>
        @endcan
        @can('tag.index')
        <li class="nav-item">
            <a class="nav-link" href="{{route('tag.index')}}"><i class="ri-price-tag-3-line"></i>{{$lng->Tags}}</a>
        </li>
        @endcan

       

        @can('blog.index')
        <li class="nav-item">
            <a class="nav-link" href="{{route('blog.index')}}"><i class="ri-edit-box-line"></i>{{$lng->Blog}}</a>
        </li>
        @endcan

        @can('report.index')
        <li class="nav-item">
            <a class="nav-link " href="{{URL::to('admin/report')}}?type=order"><i
                    class="ri-file-chart-line"></i>{{$lng->Report}}</a>
        </li>
        @endcan

        @can('page.index')
        <li class="nav-item "> 
            <a class="nav-link {{in_array(request()->path(),["admin/contact-setting","admin/about-us-setting","admin/terms-condition-setting","admin/faq","admin/page"])?"menu_active":""}}" href="#" data-toggle="collapse" aria-expanded="{{in_array(request()->path(),["admin/contact-setting","admin/about-us-setting","admin/terms-condition-setting","admin/faq","admin/page"])?"true":"false"}}" data-target="#submenuPages"
                aria-controls="submenuPages"><i class="ri-pages-line"></i>{{$lng->Pages}} </a>
            <div id="submenuPages" class="collapse submenu {{in_array(request()->path(),["admin/contact-setting","admin/about-us-setting","admin/terms-condition-setting","admin/faq","admin/page"])?"show":""}}">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/contact-setting')}}">{{$lng->Contact}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/about-us-setting')}}">{{$lng->AboutUs}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/terms-condition-setting')}}">{{$lng->TermsAndCondition}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('faq.index')}}">{{$lng->FAQ}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('page.index')}}">{{$lng->CustomPage}}</a>
                    </li>
                </ul>
            </div>
        </li>
        @endcan
        {{-- stie setting --}}
        @can('setting.edit')
        <li class="nav-item">
            <a class="nav-link {{in_array(request()->path(),["admin/site-setting","admin/logo","admin/social-link","admin/social-setting/social-login","admin/maintenance","admin/services","admin/error404","admin/payment-image","admin/popup-window","admin/custom-css-js","admin/plugin","admin/seo"])?"menu_active":""}}" href="#" data-toggle="collapse" aria-expanded="{{in_array(request()->path(),["admin/site-setting","admin/logo","admin/social-link","admin/social-setting/social-login","admin/maintenance","admin/services","admin/error404","admin/payment-image","admin/popup-window","admin/custom-css-js","admin/plugin","admin/seo"])?"true":"false"}}"
                data-target="#submenuGeneralSetting" aria-controls="submenuGeneralSetting"><i
                    class="ri-settings-5-line"></i>{{$lng->GeneralSetting}} </a>
            <div id="submenuGeneralSetting" class="collapse submenu {{in_array(request()->path(),["admin/site-setting","admin/logo","admin/social-link","admin/social-setting/social-login","admin/maintenance","admin/services","admin/error404","admin/payment-image","admin/popup-window","admin/custom-css-js","admin/plugin","admin/seo"])?"show":""}}">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/site-setting')}}"> {{$lng->SiteSetting}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/logo')}}">{{$lng->LogoAndLoader}}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{in_array(request()->path(),["admin/social-link","admin/social-setting/social-login"])?"menu_active":""}}" href="#" data-toggle="collapse" aria-expanded="{{in_array(request()->path(),["admin/social-link","admin/social-setting/social-login"])?"true":"false"}}"
                            data-target="#childmenuSocial" aria-controls="childmenuSocial">{{$lng->SocialSetting}}</a>
                        <div id="childmenuSocial" class="collapse childmenu {{in_array(request()->path(),["admin/social-link","admin/social-setting/social-login"])?"show":""}}">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{URL::to('admin/social-link')}}">{{$lng->SocialLink}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{URL::to('admin/social-setting/social-login')}}">{{$lng->SocialLogin}}</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/maintenance')}}"> {{$lng->MaintenanceMode}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{Url::to('admin/services')}}">{{$lng->Services}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{Url::to('admin/error404')}}">{{$lng->Error404}} {{$lng->Banner}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{Url::to('admin/payment-image')}}">{{$lng->PaymentMethodImage}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{Url::to('admin/popup-window')}}">{{$lng->PopupWindow}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/custom-css-js')}}">{{$lng->CustomCssJs}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/plugin')}}">{{$lng->Plugin}}</a>
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" href="{{URL::to('admin/seo')}}">{{$lng->SEO}}</a>
                    </li>
                </ul>
            </div>
        </li>
        @endcan
        {{-- site setting end --}}

        {{-- front setting --}}
        @can('setting.edit')
        <li class="nav-item">
            <a class="nav-link {{in_array(request()->path(),["admin/slide","admin/top-right-banner","admin/best-deal-banner","admin/full-width-banner","admin/two-column-banner","admin/home-page-option"])?"menu_active":""}}" href="#" data-toggle="collapse" aria-expanded="{{in_array(request()->path(),["admin/slide","admin/top-right-banner","admin/best-deal-banner","admin/full-width-banner","admin/two-column-banner","admin/home-page-option"])?"true":"false"}}" data-target="#submenuFrontSetting"
                aria-controls="submenuFrontSetting">
                <i class="ri-tools-line"></i>
                {{$lng->FrontSetting}}
            </a>
            <div id="submenuFrontSetting" class="collapse submenu {{in_array(request()->path(),["admin/slide","admin/top-right-banner","admin/best-deal-banner","admin/full-width-banner","admin/two-column-banner","admin/home-page-option"])?"show":""}}">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('slide.index')}}">
                            {{$lng->Slider}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{in_array(request()->path(),["admin/top-right-banner","admin/best-deal-banner","admin/full-width-banner","admin/two-column-banner"])?"menu_active":""}}" href="#" data-toggle="collapse" aria-expanded="{{in_array(request()->path(),["admin/top-right-banner","admin/best-deal-banner","admin/full-width-banner","admin/two-column-banner"])?"true":"false"}}"
                            data-target="#childmenuBanner" aria-controls="childmenuBanner">
                            {{$lng->Banner}}
                        </a>
                        <div id="childmenuBanner" class="collapse childmenu {{in_array(request()->path(),["admin/top-right-banner","admin/best-deal-banner","admin/full-width-banner","admin/two-column-banner"])?"show":""}}">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{URL::to('admin/top-right-banner')}}">
                                        {{$lng->TopRightBanner}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{URL::to('admin/full-width-banner')}}">{{$lng->TwoColumnBanner}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{URL::to('admin/two-column-banner')}}">{{$lng->ThreeColumnBanner}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/home-page-option')}}">{{$lng->HomepageOption}}</a>
                    </li>
                </ul>
            </div>
        </li>
        @endcan
        {{-- end front setting --}}
        @can('setting.edit')
        <li class="nav-item">
            <a class="nav-link {{in_array(request()->path(),["admin/subscriber","admin/notification","admin/group-email","admin/email-config"])?"menu_active":""}}" href="#" data-toggle="collapse" aria-expanded="{{in_array(request()->path(),["admin/subscriber","admin/notification","admin/group-email","admin/email-config"])?"true":"false"}}" data-target="#submenu-mail"
                aria-controls="submenu-mail"> <i class="ri-mail-send-line"></i>{{$lng->EmailAndNotification}}</a>
            <div id="submenu-mail" class="collapse submenu {{in_array(request()->path(),["admin/subscriber","admin/notification","admin/group-email","admin/email-config"])?"show":""}}">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/subscriber')}}">{{$lng->Subscriber}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/notification')}}">{{$lng->Notification}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URl::to('admin/group-email')}}">{{$lng->GroupEmail}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/email-config')}}">{{$lng->EmailSetting}}</a>
                    </li>
                </ul>
            </div>
        </li>

        @endcan
        
        @can('setting.edit')
        <li class="nav-item">
            <a class="nav-link {{in_array(request()->path(),["admin/clear-cache","admin/cache","admin/optimize"])?"menu_active":""}}" href="#" data-toggle="collapse" aria-expanded="{{in_array(request()->path(),["admin/clear-cache","admin/cache","admin/optimize"])?"true":"false"}}" data-target="#submenuCache"
                aria-controls="submenuCache"><i class="ri-filter-3-line"></i>{{$lng->Performance}}</a>
            <div id="submenuCache" class="collapse submenu {{in_array(request()->path(),["admin/clear-cache","admin/cache","admin/optimize"])?"show":""}}">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/clear-cache')}}">{{$lng->ClearCache}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/cache')}}">{{$lng->Cache}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('admin/optimize')}}">{{$lng->Optimize}}</a>
                    </li>
                </ul>
            </div>
        </li>
        @endcan
    </ul>
</div>
