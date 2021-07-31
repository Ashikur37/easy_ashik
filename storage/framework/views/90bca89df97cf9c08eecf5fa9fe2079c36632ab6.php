<?php $__env->startSection('title', "$lng->Home"); ?>

<?php $__env->startSection('pageStyle'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/vendor/slick.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/vendor/animate.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/page/home.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="offers-wrapper lg-offers-wrapper">
            <ul>
                <li><a href="<?php echo e(route('campaigns')); ?>"><img src="<?php echo e(asset('images/voucher/index3.jpg')); ?>" alt="" style=""><span>Campaigns</span></a></li>
                
                     <li><a href="<?php echo e(route('offers')); ?>"><img src="<?php echo e(asset('images/voucher/index3.jpg')); ?>" alt="" style=""><span>Doddle Offers</span></a></li>
                     
                     <li><a href="<?php echo e(URL::to('user/order')); ?>"><img src="<?php echo e(asset('images/voucher/index1.svg')); ?>" alt="" style=""><span>Order</span></a></li>
                     <li><a href="<?php echo e(route('category')); ?>"><img src="<?php echo e(asset('images/voucher/index1.svg')); ?>" alt="" style=""><span>Regular Shop</span></a></li>

                <!--     <li><a href="<?php echo e(route('shop')); ?>"><img src="<?php echo e(asset('images/voucher/index1.svg')); ?>" alt="" style=""><span>Prime Shops</span></a></li>-->
                <!--<li><a href="<?php echo e(route('coming_soon')); ?>"><img src="<?php echo e(asset('images/voucher/index.svg')); ?>" alt="" style=""><span>Boucher</span></a></li>-->
                <!--<li><a href="<?php echo e(route('coming_soon')); ?>"><img src="<?php echo e(asset('images/voucher/index.svg')); ?>" alt="" style=""><span>Boucher Shop</span></a></li>-->
                <!--<li><a href="<?php echo e(route('coming_soon')); ?>"><img src="<?php echo e(asset('images/voucher/index.svg')); ?>" alt="" style=""><span>Doddle Ride</span></a></li>-->
                <!--<li><a href="<?php echo e(route('coming_soon')); ?>"><img src="<?php echo e(asset('images/voucher/index.svg')); ?>" alt="" style=""><span>Doddle Food</span></a></li>-->
                <!--<li><a href="<?php echo e(route('coming_soon')); ?>"><img src="<?php echo e(asset('images/voucher/index.svg')); ?>" alt="" style=""><span>Doddle Courier</span></a></li>-->

                
            </ul>
        </div>
        <div class="hero-section">
            <div class="position-relative"> 
                <nav class="ts__dropdown d-none d-lg-block category-home">
                    <h5 class="category-title">Categories</h5>
                    <a href="#0" class="ts__close"><?php echo e($lng->Close); ?></a>
                    <ul class="ts__dropdown__content">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($category->subCategories->count()>0): ?>
                        <li class="has-children">                                
                            <a href="<?php echo e(route('category',[$category->slug])); ?>">
                                <img src="<?php echo e(URL::to('/images/category/'.$category->image)); ?>" alt="<?php echo e($category->name); ?>"><?php echo e($category->name); ?></a>
                            <ul class="<?php echo e($category->childCategories->count()==0?'ts__primary__dropdown':'ts__secondary__dropdown'); ?> is-hidden">
                                <li class="go-back"><a href="#0"><?php echo e($lng->Menu); ?></a></li>
                                <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($category->subCategories->count()>0): ?>
                                <li class="<?php echo e($subCategory->childCategories->count()==0?'':'has-children'); ?> ">
                                    <a href="<?php echo e(route('category',[$category->slug,$subCategory->slug])); ?>"><?php echo e($subCategory->name); ?></a>
                                    <ul class="is-hidden">
                                        <?php $__currentLoopData = $subCategory->childCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(route('category',[$category->slug,$subCategory->slug,$childCategory->slug])); ?>"><?php echo e($childCategory->name); ?></a>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                                <?php else: ?>
                                <li>
                                    <a href="<?php echo e(route('category',[$category->slug,$subCategory->slug])); ?>"><?php echo e($subCategory->name); ?></a>
                                </li>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul> 
                        </li> 
                        <?php else: ?>
                        <li><a href="<?php echo e(route('category',[$category->slug])); ?>"><img src="<?php echo e(URL::to('/images/category/'.$category->image)); ?>" alt="<?php echo e($category->name); ?>"><?php echo e($category->name); ?></a></li>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route('categories')); ?>"><i class="ri-add-circle-line"></i><?php echo e($lng->AllCategories); ?></a></li>
                    </ul> 
                </nav>
            </div>
            <div class="home-slider">
                <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="slide">
                        <div class="slide-img">
                            <img src="<?php echo e(asset('images/slider/' . $slide->image)); ?>" alt="<?php echo e($slide->title); ?>"
                                data-lazy="<?php echo e(asset('images/slider/' . $slide->image)); ?>" class="full-image animated"
                                data-animation-in="zoomInImage" />
                        </div>
                        <div
                            class="slide-content <?php echo e($slide->direction == 1 ? 'slide-content-left' : 'slide-content-right'); ?>">
                            <div
                                class="slide-content-wrapper <?php echo e($slide->direction == 1 ? 'text-left' : 'text-right'); ?>">
                                <span style="color:<?php echo e($slide->title_color); ?>" class="animated title"
                                    data-animation-in="<?php echo e($slide->direction == 1 ? 'fadeInRight' : 'fadeInLeft'); ?>"><?php echo e($slide->title); ?></span>
                                <span style="color:<?php echo e($slide->color); ?>" class="animated sub-title"
                                    data-animation-in="<?php echo e($slide->direction == 1 ? 'fadeInRight' : 'fadeInLeft'); ?>"
                                    data-delay-in="0.3"><?php echo e($slide->body); ?></span>
                                <a href="<?php echo e($slide->call_to_action_url); ?>" data-delay-in="0.6"
                                    class="animated btn-action" data-animation-in="zoomIn"><?php echo e($slide->button_text); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="top-category-banner">
                <div class="banner">
                    <?php if($setting->top_right_banner_1_image): ?>
                        <img src="<?php echo e(asset('images/banner/' . $setting->top_right_banner_1_image)); ?>" alt="banner">
                    <?php endif; ?>
                    <div class="banner-content">
                        <h3><?php echo e($setting->top_right_banner_1_text); ?></h3>
                        <a href="<?php echo e($setting->top_right_banner_1_url); ?>"
                            <?php echo e($setting->top_right_banner_1_new_window == 1 ? 'target="_blank"' : ''); ?>>Explore</a>
                    </div>
                </div>
                <div class="banner">
                    <?php if($setting->top_right_banner_2_image): ?>
                        <img src="<?php echo e(asset('images/banner/' . $setting->top_right_banner_2_image)); ?>" alt="banner">
                    <?php endif; ?>
                    <div class="banner-content">
                        <h3><?php echo e($setting->top_right_banner_2_text); ?></h3>
                        <a href="<?php echo e($setting->top_right_banner_2_url); ?>"
                            <?php echo e($setting->top_right_banner_2_new_window == 1 ? 'target="_blank"' : ''); ?>>Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($setting->is_service): ?>
        <div class="container">
            <div class="shop-with-us mt-20 sm-mt-10">
                <?php if($setting->is_service): ?>
                    <?php for($i = 1; $i <= 4; $i++): ?>
                        <div class="shop-facility">
                            <span class="large-icon"><?php echo $setting['service' . $i . '_image']; ?></span>
                            <div>
                                <span class="title"><?php echo e($setting['service' . $i . '_title']); ?> </span>
                                <span class="sub-title"><?php echo e($setting['service' . $i . '_sub_title']); ?> </span>
                            </div>
                        </div>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
       <?php if($flashSale): ?>
        <div class="container">
            <div class="flash-sale-section mt-20 sm-mt-10 p-20 pb-0">
                <div class="flash-deal-wrapper ">
                    <div class="flash-deal-lg-content">
                        <h5 class="item-section-info mb-0"><span>
                        <i class="ri-shield-flash-line flash-icon"></i></span>Offer</h5>
                        <div class="flash-deal-counter">
                            <span>end in</span>
                            <div id="flashClock">
                                <div>
                                    <span class="days"></span>:
                                </div>
                                <div>
                                    <span class="hours"></span>:
                                </div>
                                <div>
                                    <span class="minutes"></span>:
                                </div>
                                <div>
                                    <span class="seconds"></span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="<?php echo e(URL::to('offers')); ?>" class="see-all-product"><?php echo e($lng->ViewAll); ?>

                                <i class="ri-arrow-right-line see-all-arrow"></i>
                            </a>
                        </div>
                    </div>
                    <div class="sm-flash-deal-counter">
                        <div class="small"><?php echo e($lng->EndingIn); ?></div>
                        <div id="smFlashClock">
                            <div>
                                <span class="days"></span>:
                            </div>
                            <div>
                                <span class="hours"></span>:
                            </div>
                            <div>
                                <span class="minutes"></span>:
                            </div>
                            <div>
                                <span class="seconds"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-20">
                    <div class="flash-slider">                   
                        <?php $__currentLoopData = $flashSale->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>           
                            <?php echo $__env->make('common.product.flash-sale', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>                     
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
        <div id="extra">
        </div>

    <?php if($setting->is_newsletter): ?>
        <div class="modal fade" id="newsLatterModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="newsletter-inner">
                            <span class="close" data-dismiss="modal">
                                <i class="ri-close-line"></i>
                            </span>
                            <div class="left"
                                style="background-image: url('<?php echo e(URL::to('images/banner/' . $setting->news_letter_image)); ?>')">
                            </div>
                            <div class="right">
                                <h3 class="title">
                                    <?php echo e($setting->news_letter_title); ?>

                                </h3>
                                <p class="sub-title"><?php echo e($setting->news_letter_sub_title); ?></p>
                                <form onsubmit="return subscribe()">
                                    <div class="input-group">
                                        <input required type="email" class="form-control email-field"
                                            placeholder="<?php echo e($lng->Email); ?>" id="sub_email">
                                        <button type="submit" class="default-btn submit-btn"><?php echo e($lng->Subscribe); ?></button>
                                    </div>
                                    <div class="form-group custom-checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" id="hide-news-letter">
                                            <span class="box"></span>
                                            <?php echo e($lng->DontShowthisAgain); ?>

                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageScripts'); ?>
    <script src="<?php echo e(asset('front')); ?>/js/vendor/slick.min.js"></script>
    <script src="<?php echo e(asset('front')); ?>/js/vendor/slick-animation.min.js"></script>
    <script src="<?php echo e(asset('front')); ?>/js/page/home.js"></script>
    <script>
        <?php if($flashSale): ?>
        window.flashSale=true;
        window.deadline = new Date('<?php echo e($flashSale->end); ?>');
        <?php else: ?>
        window.flashSale=false;
        <?php endif; ?>
    </script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/front/home.blade.php ENDPATH**/ ?>