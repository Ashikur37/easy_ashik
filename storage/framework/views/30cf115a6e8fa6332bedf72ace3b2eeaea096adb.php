<!doctype html>
<html lang="en">
<head>
    <title>
        <?php if (! empty(trim($__env->yieldContent('title')))): ?>
            <?php echo $__env->yieldContent('title'); ?>
        <?php else: ?>
        <?php endif; ?>
    </title>
    <link rel="icon" href="<?php echo e(URL::to('/images/banner/' . $setting->favicon)); ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <?php if (empty(trim($__env->yieldContent('meta')))): ?>
        <meta name="keywords" content="<?php echo e($setting->meta_title); ?>">
        <meta name="description" content="<?php echo e($setting->meta_description); ?>">
    <?php endif; ?>
    <?php echo $__env->yieldContent('meta'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('front/css/vendor/vendor-plugin.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('front/css/core.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('front/css/user.css')); ?>">
    <?php echo $__env->yieldContent('pageStyle'); ?>
</head>

<body style="--dynamic-color:<?php echo e($setting->theme_color); ?>">
    <?php echo $__env->make('includes.front.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="d-none" id="site-loader"><img alt="loader" class="loader__image"
            src="<?php echo e(asset('images/banner/' . $setting->site_loader)); ?>"></div>
    <div class="user__panel__page">
        <div class="container">
            <div class="row py-20 sm-py-10">
                <div class="white-bg user-left-menu">
                    <div class="user-info">
                        <img alt="avatar"
                            src="<?php echo e(auth()->user()->provider ? auth()->user()->avatar : asset('images/avatar.png')); ?>" />
                        <div class="name-balance">
                            <span class="name"><?php echo e(auth()->user()->name." ".auth()->user()->lastname); ?></span>
                            <span class="balance">
                                <?php echo e($lng->Balance); ?>:
                                ৳<?php echo e(App\Model\Product::currencyPriceRate(auth()->user()->affiliate_balance)); ?>

                            </span>
                        </div>
                        <button class="default-btn signOut_btn"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><?php echo e($lng->SignOut); ?></button>
                    </div>
                    <div class="user-panel-sidebar">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->route()->getName() == 'user.home'
                                    ? 'active'
                                    : ''); ?>" id="dashboard-tab" href="<?php echo e(route('user.home')); ?>"><i
                                        class="ri-dashboard-line"></i><?php echo e($lng->Dashboard); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->route()->getName() == 'user.order'
                                    ? 'active'
                                    : ''); ?>" id="profile-tab" href="<?php echo e(route('user.order')); ?>"><i
                                        class="ri-clipboard-line"></i><?php echo e($lng->MyOrder); ?></a>
                            </li>
                            <li class="nav-item">

                                <a class="nav-link <?php echo e(request()->route()->getName() == 'user-address.index'
                                    ? 'active'
                                    : ''); ?>" id="messages-tab" href="<?php echo e(route('user-address.index')); ?>"><i
                                        class="ri-heart-line"></i>Address</a>

                                <a class="nav-link" id="index-tab" href="#"><i class="ri-mail-open-line"></i>Inbox</a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->route()->getName() == 'user.wishlist'
                                    ? 'active'
                                    : ''); ?>" id="messages-tab" href="<?php echo e(route('user.wishlist')); ?>"><i
                                        class="ri-heart-line"></i><?php echo e($lng->MyWishList); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->route()->getName() == 'user.review'
                                    ? 'active'
                                    : ''); ?>" id="settings-tab" href="<?php echo e(route('user.review')); ?>"><i
                                        class="ri-star-half-fill"></i><?php echo e($lng->MyReviews); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->route()->getName() == 'user.affiliation'
                                    ? 'active'
                                    : ''); ?>" id="affliation-tab" href="<?php echo e(route('user.affiliation')); ?>"><i
                                        class="ri-team-line"></i><?php echo e($lng->Affiliation); ?></a>
                            </li>
                            <?php if($setting->affiliate_withdraw): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo e(request()->route()->getName() == 'user.withdraw'
                                        ? 'active'
                                        : ''); ?>" id="withdraw-tab" href="<?php echo e(route('user.withdraw')); ?>"><i
                                            class="ri-currency-line"></i><?php echo e($lng->Withdraw); ?></a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->route()->getName() == 'user.ticket'
                                    ? 'active'
                                    : ''); ?>" id="user-tab" href="<?php echo e(route('user.ticket')); ?>"><i
                                        class="ri-chat-4-line"></i><?php echo e($lng->Ticket); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->route()->getName() == 'user.change-password'
                                    ? 'active'
                                    : ''); ?>" id="changepassword-tab" href="<?php echo e(route('user.change-password')); ?>"><i
                                        class="ri-key-line"></i><?php echo e($lng->ChangePassword); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->route()->getName() == 'user.change-profile'
                                    ? 'active'
                                    : ''); ?>" id="changeprofile-tab" href="<?php echo e(route('user.change-profile')); ?>"><i class="ri-profile-line"></i>Update Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->route()->getName() == 'user.notification'
                                    ? 'active'
                                    : ''); ?>" id="Notification-tab" href="<?php echo e(route('user.notification')); ?>"><i
                                        class="ri-notification-2-line"></i><?php echo e($lng->Notification); ?>

                                    <span
                                        class="custom-badge"><?php echo e(auth()->user()->unreadNotifications()->count()); ?></span>
                                </a>
                            </li>
                            <?php if(auth()->user()->is_vendor==0): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->route()->getName() == 'vendor.apply'
                                    ? 'active'
                                    : ''); ?>" id="vendor-tab" href="<?php echo e(route('vendor.apply')); ?>"><i class="ri-store-line"></i><?php echo e($lng->ApplyForVendor); ?>

                                </a> 
                            </li>
                            <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->route()->getName() == 'vendor.home'
                                    ? 'active'
                                    : ''); ?>" id="vendor-tab" href="<?php echo e(route('vendor.home')); ?>"><i class="ri-store-line"></i>Vendor Panel
                                </a> 
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="nav-link"><i
                                        class="ri-logout-circle-line"></i><?php echo e($lng->SignOut); ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="user-panel-md-dropdown">
                        <div class="form-group">
                            <select class="nice-select ts-custom-select wide" id="md__sidebar">
                                <option <?php echo e(request()->route()->getName() == 'user.home'
                                    ? 'selected'
                                    : ''); ?> value="<?php echo e(route('user.home')); ?>"><?php echo e($lng->Dashboard); ?></option>
                                <option <?php echo e(request()->route()->getName() == 'user.order'
                                    ? 'selected'
                                    : ''); ?> value="<?php echo e(route('user.order')); ?>"><?php echo e($lng->MyOrder); ?></option>
                                <option <?php echo e(request()->route()->getName() == 'user.wishlist'
                                    ? 'selected'
                                    : ''); ?> value="<?php echo e(route('user.wishlist')); ?>"><?php echo e($lng->MyWishList); ?></option>
                                <option <?php echo e(request()->route()->getName() == 'user.review'
                                    ? 'selected'
                                    : ''); ?> value="<?php echo e(route('user.review')); ?>"><?php echo e($lng->MyReviews); ?></option>
                                <option <?php echo e(request()->route()->getName() == 'user.affiliation'
                                    ? 'selected'
                                    : ''); ?> value="<?php echo e(route('user.affiliation')); ?>"><?php echo e($lng->Affiliation); ?></option>
                                <option <?php echo e(request()->route()->getName() == 'user.notification'
                                    ? 'selected'
                                    : ''); ?> value="<?php echo e(route('user.notification')); ?>"><?php echo e($lng->Notification); ?>

                                    (<?php echo e(auth()->user()->unreadNotifications()->count()); ?>)</option>
                                <?php if($setting->affiliate_withdraw): ?>
                                    <option <?php echo e(request()->route()->getName() == 'user.withdraw'
                                        ? 'selected'
                                        : ''); ?> value="<?php echo e(route('user.withdraw')); ?>"><?php echo e($lng->Withdraw); ?></option>
                                <?php endif; ?>
                                <option <?php echo e(request()->route()->getName() == 'user.ticket'
                                    ? 'selected'
                                    : ''); ?> value="<?php echo e(route('user.ticket')); ?>"><?php echo e($lng->Ticket); ?></option>
                                <option <?php echo e(request()->route()->getName() == 'user.change-password'
                                    ? 'selected'
                                    : ''); ?> value="<?php echo e(route('user.change-password')); ?>"><?php echo e($lng->ChangePassword); ?>

                                </option>
                                <option <?php echo e(request()->route()->getName() == 'user.change-profile'
                                    ? 'selected'
                                    : ''); ?> value="<?php echo e(route('user.change-profile')); ?>">Update Profile
                                </option>
                                 <?php if(auth()->user()->is_vendor==0): ?>
                                <option <?php echo e(request()->route()->getName() == 'vendor.apply'
                                    ? 'selected'
                                    : ''); ?> value="<?php echo e(route('vendor.apply')); ?>"><?php echo e($lng->ApplyForVendor); ?>

                                </option>
                                <?php else: ?>
                                 <option <?php echo e(request()->route()->getName() == 'vendor.home'
                                    ? 'selected'
                                    : ''); ?> value="<?php echo e(route('vendor.home')); ?>">Vendor Panel
                                </option>
                                <?php endif; ?>
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="white-bg user-right-centent">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('includes.front.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="product-cart-status" id="aside-cart">
        <?php echo $__env->make('includes.front.cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>
    <script src="<?php echo e(asset('front/js/vendor/jquery.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('pageScripts'); ?>
    <script src="<?php echo e(asset('front/js/vendor/plugins.js')); ?>"></script>
    <!-- core js -->
    <script src="<?php echo e(asset('front/js/core.js')); ?>"></script>
    <script>
        var mainUrl = "<?php echo e(URL::to('/')); ?>";
        var lng = <?php echo json_encode($lng); ?>

        var loggedIn = "<?php echo e(auth()->check()); ?>";
        $(function() {
            $("#md__sidebar").on('change', function() {
                window.location.href = $(this).val();
            });
            $(".notification-link").on('click', function() {
                redirectUrl = $(this).data("url");
                $.ajax({
                    url: "<?php echo e(URL::to('/notification/read/')); ?>" + $(this).data("id"),
                    type: 'GET',

                }).always(function(data) {
                    window.location.href = redirectUrl
                })
            });
            <?php if(Session::has('success')): ?>     
            toastr.success('<?php echo e(Session::get('success')); ?>') 
            <?php endif; ?>
            <?php if(Session::has('error')): ?>
            toastr.error('<?php echo e(Session::get('error')); ?>')
            <?php endif; ?>
        })

    </script>
</body>

</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/layouts/user.blade.php ENDPATH**/ ?>