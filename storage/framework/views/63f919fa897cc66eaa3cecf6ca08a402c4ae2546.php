<div class="sidebar-wrapper custom-scrollbar" id="custom-scrollbar">
    <a class="logo" href="<?php echo e(URL::to('/admin')); ?>">
        <img src="<?php echo e(asset('images/banner/'.$setting->admin_logo)); ?>" alt="logo"></a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(URL::to('/admin')); ?>">
                <i class="ri-dashboard-line"></i>
                <?php echo e($lng->Dashboard); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(in_array(request()->route()->getName(),["product.index","product.create","attribute-set.index","attribute.index","review.index","comment.index","badge.index","brand.index","coupon.index","color.index","size.index"])?"menu_active":""); ?>"
                href="#" data-toggle="collapse"
                aria-expanded="<?php echo e(in_array(request()->route()->getName(),["product.index","product.create","attribute-set.index","attribute.index","review.index","comment.index","badge.index","brand.index","coupon.index","color.index","size.index"])?"true":"false"); ?>"
                data-target="#submenuProduct" aria-controls="submenuProduct">
                <i class="ri-codepen-line"></i><?php echo e($lng->Products); ?></a>
            <div id="submenuProduct" class="collapse submenu
            <?php echo e(in_array(request()->route()->getName(),["product.index","product.create","attribute-set.index","attribute.index","review.index","comment.index","badge.index","brand.index","coupon.index","color.index","size.index"])?"show":""); ?>

            ">
                <ul class="nav flex-column">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.create')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('product.create')); ?>"><?php echo e($lng->AddProduct); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('/admin/product-import')); ?>">Import Product</a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.index')): ?>
                    <li class="nav-item">
                        <a class="<?php echo e(request()->route()->getName()=='product.index'?'active ':''); ?>nav-link"
                            href="<?php echo e(route('product.index')); ?>"><?php echo e($lng->ProductList); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('attribute.index')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(in_array(request()->route()->getName(),["attribute-set.index","attribute.index"])?"menu_active":""); ?>" href="#" data-toggle="collapse" aria-expanded="<?php echo e(in_array(request()->route()->getName(),["attribute-set.index","attribute.index"])?"true":"false"); ?>"
                            data-target="#childmenuFeature" aria-controls="childmenuFeature"><?php echo e($lng->Product); ?> <?php echo e($lng->Feature); ?></a>
                        <div id="childmenuFeature" class="collapse childmenu <?php echo e(in_array(request()->route()->getName(),["attribute-set.index","attribute.index"])?"show":""); ?>">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('attribute-set.index')); ?>"><?php echo e($lng->FeatureSet); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('attribute.index')); ?>"><?php echo e($lng->Feature); ?></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('color.index')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('color.index')); ?>"><?php echo e($lng->Color); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('size.index')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('size.index')); ?>"><?php echo e($lng->Size); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('badge.index')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('badge.index')); ?>"><?php echo e($lng->Badge); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brand.index')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('brand.index')); ?>"><?php echo e($lng->Brand); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('coupon.index')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('coupon.index')); ?>"><?php echo e($lng->Coupon); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('review.index')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(in_array(request()->route()->getName(),["review.index","comment.index"])?"menu_active":""); ?>" href="#" data-toggle="collapse" aria-expanded="<?php echo e(in_array(request()->route()->getName(),["review.index","comment.index"])?"true":"false"); ?>"
                            data-target="#childmenuReview" aria-controls="childmenuReview"><?php echo e($lng->ReviewAndComment); ?></a>
                        <div id="childmenuReview" class="collapse childmenu <?php echo e(in_array(request()->route()->getName(),["review.index","comment.index"])?"show":""); ?>">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('review.index')); ?>">
                                        <?php echo e($lng->Review); ?>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('comment.index')); ?>"><?php echo e($lng->Comment); ?></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                   
                    <?php endif; ?>
                    
                </ul>
            </div>
        </li>
        
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category.index')): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(in_array(request()->route()->getName(),["category.index","sub-category.index","child-category.index"])?"menu_active":""); ?>"
                href="#" data-toggle="collapse"
                aria-expanded="<?php echo e(in_array(request()->route()->getName(),["category.index","sub-category.index","child-category.index"])?"true":"false"); ?>"
                data-target="#submenuCategory" aria-controls="submenuCategory">
                <i class="ri-list-check-2"></i><?php echo e($lng->Category); ?></a>
            <div id="submenuCategory"
                class="collapse submenu <?php echo e(in_array(request()->route()->getName(),["category.index","sub-category.index","child-category.index"])?"show":""); ?>">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="<?php echo e(request()->route()->getName()=="category.index"?'active':''); ?> nav-link"
                            href="<?php echo e(route('category.index')); ?>"><?php echo e($lng->CategoryList); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="<?php echo e(request()->route()->getName()=="sub-category.index"?'active':''); ?> nav-link"
                            href="<?php echo e(route('sub-category.index')); ?>"><?php echo e($lng->SubCategoryList); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="<?php echo e(request()->route()->getName()=="child-category.index"?'active':''); ?> nav-link"
                            href="<?php echo e(route('child-category.index')); ?>"><?php echo e($lng->ChildCategoryList); ?></a>
                    </li>
                </ul>
            </div>
        </li>
        <?php endif; ?>
        
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('flash-sale.index')): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('flash-sale.index')); ?>"><i
                    class="ri-flashlight-line"></i>Offer</a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('campaign.index')): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('campaign.index')); ?>"><i
                    class="ri-flashlight-line"></i>Campaign</a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shop.index')): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('shop.index')); ?>"><i
                    class="ri-flashlight-line"></i>Shop</a>
        </li>
        <?php endif; ?>
        
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order.index')): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(request()->route()->getName()=='order.index'?'active ':''); ?>"
                href="<?php echo e(route('order.index')); ?>"><i class="ri-clipboard-line"></i>Order</a>
        </li>
        <?php endif; ?>
        
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['customer.index','withdraw.index'])): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(in_array(request()->route()->getName(),["customer.index","withdraw.index","affiliate.index","ticket.index","ticket-category.index"])?"menu_active":""); ?>" href="#" data-toggle="collapse" aria-expanded="<?php echo e(in_array(request()->route()->getName(),["customer.index","withdraw.index","affiliate.index","ticket.index","ticket-category.index"])?"true":"false"); ?>" data-target="#submenuCustomer"
                aria-controls="submenuCustomer"> <i class="ri-user-line"></i><?php echo e($lng->Customer); ?></a>
            <div id="submenuCustomer" class="collapse submenu <?php echo e(in_array(request()->route()->getName(),["customer.index","withdraw.index","affiliate.index","ticket.index","ticket-category.index"])?"show":""); ?>">
                <ul class="nav flex-column">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer.index')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('customer.index')); ?>"><?php echo e($lng->CustomerList); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('withdraw.index')): ?>
                    <li class="nav-item"> 
                        <a class="nav-link" href="<?php echo e(route('withdraw.index')); ?>"><?php echo e($lng->Withdraw); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('affiliate.index')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('affiliate.index')); ?>"><?php echo e($lng->Affiliation); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.index')): ?>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo e(route('ticket-category.index')); ?>"><?php echo e($lng->Ticket); ?> <?php echo e($lng->Category); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo e(route('ticket.index')); ?>"><?php echo e($lng->Ticket); ?></a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </li>
        <?php endif; ?>
        
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['user.index','role.index'])): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(in_array(request()->path(),["admin/user","admin/role"])?"menu_active":""); ?>" href="#" data-toggle="collapse" aria-expanded="<?php echo e(in_array(request()->path(),["admin/user","admin/role"])?"true":"false"); ?>" data-target="#submenuuserRole"
                aria-controls="submenuuserRole"> <i class="ri-file-user-line"></i><?php echo e($lng->User); ?></a>
            <div id="submenuuserRole" class="collapse submenu <?php echo e(in_array(request()->path(),["admin/user","admin/role"])?"show":""); ?>">
                <ul class="nav flex-column">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.index')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('user.index')); ?>"><?php echo e($lng->UserList); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('vendor.index')); ?>">Vendor List</a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role.index')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('role.index')); ?>"><?php echo e($lng->RoleList); ?></a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shipping-method.index')): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('shipping-method.index')); ?>"><i class="ri-truck-line"></i><?php echo e($lng->ShippingMethod); ?></a>
        </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payment-gateway.index')): ?> 
        <li class="nav-item">
            <a class="nav-link <?php echo e(in_array(request()->path(),["admin/payment-setting/general","admin/payment-setting/paypal","admin/payment-setting/ssl-commerz","admin/payment-gateway","admin/payment-setting/stripe","admin/payment-setting/razorpay"])?"menu_active":""); ?>" href="#" data-toggle="collapse" aria-expanded="<?php echo e(in_array(request()->path(),["admin/payment-setting/general","admin/payment-setting/paypal","admin/payment-setting/ssl-commerz","admin/payment-gateway","admin/payment-setting/stripe","admin/payment-setting/razorpay"])?"true":"false"); ?>" data-target="#submenuPaymentSetting"
                aria-controls="submenuPaymentSetting"> <i
                class="ri-bank-card-line"></i><?php echo e($lng->PaymentSetting); ?></a> 
            <div id="submenuPaymentSetting" class="collapse submenu <?php echo e(in_array(request()->path(),["admin/payment-setting/general","admin/payment-setting/paypal","admin/payment-setting/ssl-commerz","admin/payment-gateway","admin/payment-setting/stripe","admin/payment-setting/razorpay"])?"show":""); ?>">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?php echo e(URL::to('admin/payment-setting/general')); ?>"><?php echo e($lng->General); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?php echo e(URL::to('admin/payment-setting/ssl-commerz')); ?>"><?php echo e($lng->SSLCommerz); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?php echo e(URL::to('admin/payment-setting/paypal')); ?>"><?php echo e($lng->Paypal); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?php echo e(URL::to('admin/payment-setting/stripe')); ?>"><?php echo e($lng->Stripe); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?php echo e(URL::to('admin/payment-setting/razorpay')); ?>"><?php echo e($lng->Razorpay); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('payment-gateway.index')); ?>"><?php echo e($lng->PaymentGateway); ?></a>
                    </li>
                </ul>
            </div>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('currency.index')): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('currency.index')); ?>"><i
                    class="ri-money-dollar-box-line"></i><?php echo e($lng->Currency); ?></a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('language.index')): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(URL::to('admin/language')); ?>"><i class="ri-font-color"></i><?php echo e($lng->Language); ?></a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tag.index')): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('tag.index')); ?>"><i class="ri-price-tag-3-line"></i><?php echo e($lng->Tags); ?></a>
        </li>
        <?php endif; ?>

       

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog.index')): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('blog.index')); ?>"><i class="ri-edit-box-line"></i><?php echo e($lng->Blog); ?></a>
        </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report.index')): ?>
        <li class="nav-item">
            <a class="nav-link " href="<?php echo e(URL::to('admin/report')); ?>?type=order"><i
                    class="ri-file-chart-line"></i><?php echo e($lng->Report); ?></a>
        </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page.index')): ?>
        <li class="nav-item "> 
            <a class="nav-link <?php echo e(in_array(request()->path(),["admin/contact-setting","admin/about-us-setting","admin/terms-condition-setting","admin/faq","admin/page"])?"menu_active":""); ?>" href="#" data-toggle="collapse" aria-expanded="<?php echo e(in_array(request()->path(),["admin/contact-setting","admin/about-us-setting","admin/terms-condition-setting","admin/faq","admin/page"])?"true":"false"); ?>" data-target="#submenuPages"
                aria-controls="submenuPages"><i class="ri-pages-line"></i><?php echo e($lng->Pages); ?> </a>
            <div id="submenuPages" class="collapse submenu <?php echo e(in_array(request()->path(),["admin/contact-setting","admin/about-us-setting","admin/terms-condition-setting","admin/faq","admin/page"])?"show":""); ?>">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/contact-setting')); ?>"><?php echo e($lng->Contact); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/about-us-setting')); ?>"><?php echo e($lng->AboutUs); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/terms-condition-setting')); ?>"><?php echo e($lng->TermsAndCondition); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('faq.index')); ?>"><?php echo e($lng->FAQ); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('page.index')); ?>"><?php echo e($lng->CustomPage); ?></a>
                    </li>
                </ul>
            </div>
        </li>
        <?php endif; ?>
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('setting.edit')): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(in_array(request()->path(),["admin/site-setting","admin/logo","admin/social-link","admin/social-setting/social-login","admin/maintenance","admin/services","admin/error404","admin/payment-image","admin/popup-window","admin/custom-css-js","admin/plugin","admin/seo"])?"menu_active":""); ?>" href="#" data-toggle="collapse" aria-expanded="<?php echo e(in_array(request()->path(),["admin/site-setting","admin/logo","admin/social-link","admin/social-setting/social-login","admin/maintenance","admin/services","admin/error404","admin/payment-image","admin/popup-window","admin/custom-css-js","admin/plugin","admin/seo"])?"true":"false"); ?>"
                data-target="#submenuGeneralSetting" aria-controls="submenuGeneralSetting"><i
                    class="ri-settings-5-line"></i><?php echo e($lng->GeneralSetting); ?> </a>
            <div id="submenuGeneralSetting" class="collapse submenu <?php echo e(in_array(request()->path(),["admin/site-setting","admin/logo","admin/social-link","admin/social-setting/social-login","admin/maintenance","admin/services","admin/error404","admin/payment-image","admin/popup-window","admin/custom-css-js","admin/plugin","admin/seo"])?"show":""); ?>">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/site-setting')); ?>"> <?php echo e($lng->SiteSetting); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/logo')); ?>"><?php echo e($lng->LogoAndLoader); ?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(in_array(request()->path(),["admin/social-link","admin/social-setting/social-login"])?"menu_active":""); ?>" href="#" data-toggle="collapse" aria-expanded="<?php echo e(in_array(request()->path(),["admin/social-link","admin/social-setting/social-login"])?"true":"false"); ?>"
                            data-target="#childmenuSocial" aria-controls="childmenuSocial"><?php echo e($lng->SocialSetting); ?></a>
                        <div id="childmenuSocial" class="collapse childmenu <?php echo e(in_array(request()->path(),["admin/social-link","admin/social-setting/social-login"])?"show":""); ?>">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(URL::to('admin/social-link')); ?>"><?php echo e($lng->SocialLink); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="<?php echo e(URL::to('admin/social-setting/social-login')); ?>"><?php echo e($lng->SocialLogin); ?></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/maintenance')); ?>"> <?php echo e($lng->MaintenanceMode); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(Url::to('admin/services')); ?>"><?php echo e($lng->Services); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(Url::to('admin/error404')); ?>"><?php echo e($lng->Error404); ?> <?php echo e($lng->Banner); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(Url::to('admin/payment-image')); ?>"><?php echo e($lng->PaymentMethodImage); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(Url::to('admin/popup-window')); ?>"><?php echo e($lng->PopupWindow); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/custom-css-js')); ?>"><?php echo e($lng->CustomCssJs); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/plugin')); ?>"><?php echo e($lng->Plugin); ?></a>
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" href="<?php echo e(URL::to('admin/seo')); ?>"><?php echo e($lng->SEO); ?></a>
                    </li>
                </ul>
            </div>
        </li>
        <?php endif; ?>
        

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('setting.edit')): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(in_array(request()->path(),["admin/slide","admin/top-right-banner","admin/best-deal-banner","admin/full-width-banner","admin/two-column-banner","admin/home-page-option"])?"menu_active":""); ?>" href="#" data-toggle="collapse" aria-expanded="<?php echo e(in_array(request()->path(),["admin/slide","admin/top-right-banner","admin/best-deal-banner","admin/full-width-banner","admin/two-column-banner","admin/home-page-option"])?"true":"false"); ?>" data-target="#submenuFrontSetting"
                aria-controls="submenuFrontSetting">
                <i class="ri-tools-line"></i>
                <?php echo e($lng->FrontSetting); ?>

            </a>
            <div id="submenuFrontSetting" class="collapse submenu <?php echo e(in_array(request()->path(),["admin/slide","admin/top-right-banner","admin/best-deal-banner","admin/full-width-banner","admin/two-column-banner","admin/home-page-option"])?"show":""); ?>">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('slide.index')); ?>">
                            <?php echo e($lng->Slider); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(in_array(request()->path(),["admin/top-right-banner","admin/best-deal-banner","admin/full-width-banner","admin/two-column-banner"])?"menu_active":""); ?>" href="#" data-toggle="collapse" aria-expanded="<?php echo e(in_array(request()->path(),["admin/top-right-banner","admin/best-deal-banner","admin/full-width-banner","admin/two-column-banner"])?"true":"false"); ?>"
                            data-target="#childmenuBanner" aria-controls="childmenuBanner">
                            <?php echo e($lng->Banner); ?>

                        </a>
                        <div id="childmenuBanner" class="collapse childmenu <?php echo e(in_array(request()->path(),["admin/top-right-banner","admin/best-deal-banner","admin/full-width-banner","admin/two-column-banner"])?"show":""); ?>">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(URL::to('admin/top-right-banner')); ?>">
                                        <?php echo e($lng->TopRightBanner); ?>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="<?php echo e(URL::to('admin/full-width-banner')); ?>"><?php echo e($lng->TwoColumnBanner); ?>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="<?php echo e(URL::to('admin/two-column-banner')); ?>"><?php echo e($lng->ThreeColumnBanner); ?>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/home-page-option')); ?>"><?php echo e($lng->HomepageOption); ?></a>
                    </li>
                </ul>
            </div>
        </li>
        <?php endif; ?>
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('setting.edit')): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(in_array(request()->path(),["admin/subscriber","admin/notification","admin/group-email","admin/email-config"])?"menu_active":""); ?>" href="#" data-toggle="collapse" aria-expanded="<?php echo e(in_array(request()->path(),["admin/subscriber","admin/notification","admin/group-email","admin/email-config"])?"true":"false"); ?>" data-target="#submenu-mail"
                aria-controls="submenu-mail"> <i class="ri-mail-send-line"></i><?php echo e($lng->EmailAndNotification); ?></a>
            <div id="submenu-mail" class="collapse submenu <?php echo e(in_array(request()->path(),["admin/subscriber","admin/notification","admin/group-email","admin/email-config"])?"show":""); ?>">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/subscriber')); ?>"><?php echo e($lng->Subscriber); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/notification')); ?>"><?php echo e($lng->Notification); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URl::to('admin/group-email')); ?>"><?php echo e($lng->GroupEmail); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/email-config')); ?>"><?php echo e($lng->EmailSetting); ?></a>
                    </li>
                </ul>
            </div>
        </li>

        <?php endif; ?>
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('setting.edit')): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(in_array(request()->path(),["admin/clear-cache","admin/cache","admin/optimize"])?"menu_active":""); ?>" href="#" data-toggle="collapse" aria-expanded="<?php echo e(in_array(request()->path(),["admin/clear-cache","admin/cache","admin/optimize"])?"true":"false"); ?>" data-target="#submenuCache"
                aria-controls="submenuCache"><i class="ri-filter-3-line"></i><?php echo e($lng->Performance); ?></a>
            <div id="submenuCache" class="collapse submenu <?php echo e(in_array(request()->path(),["admin/clear-cache","admin/cache","admin/optimize"])?"show":""); ?>">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/clear-cache')); ?>"><?php echo e($lng->ClearCache); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/cache')); ?>"><?php echo e($lng->Cache); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(URL::to('admin/optimize')); ?>"><?php echo e($lng->Optimize); ?></a>
                    </li>
                </ul>
            </div>
        </li>
        <?php endif; ?>
    </ul>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/includes/admin/aside.blade.php ENDPATH**/ ?>