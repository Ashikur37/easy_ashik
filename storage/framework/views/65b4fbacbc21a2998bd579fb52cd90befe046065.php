<div class="lg-header">
    <div class="top-nav">
        <div class="container">
            <div class="top-nav-wrapper">
                <div class="contact-mail">
                    <span><i class="ri-phone-line"></i><?php echo e($setting->phone1); ?></span>
                    <span><i class="ri-mail-line"></i><?php echo e($setting->mail1); ?></span>
                </div>
                <div class="d-flex align-items-center"> 
                    <a href="<?php if(auth()->guard()->guest()): ?><?php echo e(route('login')); ?><?php elseif(auth()->user()->type==0): ?><?php echo e(route('user.home')); ?><?php else: ?><?php echo e(URL::to('/admin')); ?><?php endif; ?>
                        " class="login">
                        <?php if(auth()->guard()->guest()): ?>
                        <?php echo e($lng->Login); ?>

                        <?php else: ?>
                        <?php echo e($lng->Account); ?>

                        <?php endif; ?>
                    </a> 
                    <span class="order-track order-track-button"><?php echo e($lng->TrackOrder); ?></span> 
                    <div class="currency-language-wrapper">
                        <select class="ts-custom-select selectors"> 
                        <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e(route('front.language',$lang->id)); ?>" <?php echo e(Session::has('language') ? ( Session::get('language')->id == $lang->id ? 'selected':'' ):($langs->where('is_default','=',1)->first()->id == $lang->id?'selected':'')); ?>>
                                <?php echo e($lang->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <select class="ts-custom-select selectors">
                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e(route('front.currency',$currency->id)); ?>"
                                <?php echo e(Session::has('currency') ? ( Session::get('currency')->id == $currency->id ? 'selected' : '' ) : ($currencies->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '')); ?>>
                                <?php echo e($currency->sign." ".$currency->name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle-nav">
        <div class="container">
            <div class="middle-nav-content">
                <div class="logo-wrapper">
                    <a href="<?php echo e(route('home')); ?>" class="header-logo">
                        <img alt="<?php echo e($setting->title); ?>" src="<?php echo e(asset('images/banner/'.$setting->header_logo)); ?>">
                    </a>
                   <div class="position-relative active-sticky-category">
                        
                   </div>
                </div>
                <div class="searchbox-wrapper">
                    <div class="searchbox">
                    <div class="searchbox-category">
                            <select class="ts-custom-select wide" id="search-category">
                                <option value=""><?php echo e($lng->AllCategories); ?></option>
                                <?php $__currentLoopData = \App\Model\Category::get()->sortByDesc('product_view')->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>                       
                        <div class="searchbox-input">
                            <input type="text" class="input" placeholder="<?php echo e($lng->SearchGoods); ?>" id="searchProduct">
                            <div class="search-suggestion-wrapper" id="suggestedProduct">
                                <span class="popular-product"><?php echo e($lng->PopularProduct); ?></span>
                                <?php $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="suggested-products-info">
                                    <div class="product-title">
                                        <a href="<?php echo e(route('front-product.show',$product->slug)); ?>"><?php echo e($product->name); ?>

                                            <br>
                                            <span class="product-price">৳<?php echo e(App\Model\Product::currencyPrice($product->price)); ?></span>
                                        </a>
                                    </div>
                                    <div class="product-img">
                                        <a href="<?php echo e(route('front-product.show',$product->slug)); ?>">
                                            <img alt="<?php echo e($product->name); ?>" src="<?php echo e(asset('images/product/'.$product->image)); ?>">
                                        </a>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <span class="top-search">Top Search</span>
                                <?php $__currentLoopData = $topKeys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="link top-keyword" href="<?php echo e(route('category')); ?>?key=<?php echo e(urlencode($key->term)); ?>"><?php echo e($key->term); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div> 
                        <div class="searchbox-icon">
                            <i class="ri-search-line"></i>
                        </div> 
                    </div>  
                </div>       
                <div class="checkout-process-option" id="dynamic-header">
                    <?php echo $__env->make('load.front.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>            
            </div>
            <div class="d-flex align-items-center">
                <div class="position-relative sticky-nav-trigger">
                    <h5 class="ts__dropdown__trigger"><span ><i class="ri-function-line"></i></span> ALL CATEGORIES<span ><i class="ri-arrow-down-s-line"></i></span></h5>
                    <nav class="ts__dropdown dropdown-category">
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
                <div class="offers-wrapper">
                    <ul class="d-flex">
                         <li><a href="<?php echo e(route('campaigns')); ?>"><img src="<?php echo e(asset('images/voucher/index3.jpg')); ?>" alt="" style=""><span>Campaigns</span></a></li>
                
                     <li><a href="<?php echo e(route('offers')); ?>"><img src="<?php echo e(asset('images/voucher/index3.jpg')); ?>" alt="" style=""><span>Doddle Offers</span></a></li>
                     
                     <li><a href="<?php echo e(URL::to('user/order')); ?>"><img src="<?php echo e(asset('images/voucher/index1.svg')); ?>" alt="" style=""><span>Order</span></a></li>
                     <li><a href="<?php echo e(route('category')); ?>"><img src="<?php echo e(asset('images/voucher/index1.svg')); ?>" alt="" style=""><span>Regular Shop</span></a></li>
                <!--<li><a href="<?php echo e(route('campaigns')); ?>"><img src="<?php echo e(asset('images/voucher/index3.jpg')); ?>" alt="" style=""><span>Campaigns</span></a></li>-->

                       <!--<li><a href="<?php echo e(route('single-voucher')); ?>"><img src="<?php echo e(asset('images/voucher/index.svg')); ?>" alt="" style=""><span>Voucher Shops</span></a></li>-->
                   <!--     <li><a href="<?php echo e(route('offers')); ?>"><img src="<?php echo e(asset('images/voucher/index3.jpg')); ?>" alt="" style=""><span>Doddle Offers</span></a></li>-->
                   <!--     <li><a href="<?php echo e(route('category')); ?>"><img src="<?php echo e(asset('images/voucher/index1.svg')); ?>" alt="" style=""><span>Regular Shop</span></a></li>-->
   
                   <!--     <li><a href="<?php echo e(route('shop')); ?>"><img src="<?php echo e(asset('images/voucher/index1.svg')); ?>" alt="" style=""><span>Prime Shops</span></a></li>-->
                   <!--<li><a href="<?php echo e(route('coming_soon')); ?>"><img src="<?php echo e(asset('images/voucher/index.svg')); ?>" alt="" style=""><span>Boucher</span></a></li>-->
                   <!--<li><a href="<?php echo e(route('coming_soon')); ?>"><img src="<?php echo e(asset('images/voucher/index.svg')); ?>" alt="" style=""><span>Boucher Shop</span></a></li>-->
                   <!--<li><a href="<?php echo e(route('coming_soon')); ?>"><img src="<?php echo e(asset('images/voucher/index.svg')); ?>" alt="" style=""><span>Doddle Ride</span></a></li>-->
                   <!--<li><a href="<?php echo e(route('coming_soon')); ?>"><img src="<?php echo e(asset('images/voucher/index.svg')); ?>" alt="" style=""><span>Doddle Food</span></a></li>-->
                   <!--<li><a href="<?php echo e(route('coming_soon')); ?>"><img src="<?php echo e(asset('images/voucher/index.svg')); ?>" alt="" style=""><span>Doddle Courier</span></a></li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- mobile header -->
<div class="d-lg-none">
    <div class="sm-top-header-section white-bg">
        <div class="container">
            <div class="brand-name">
                <a href="<?php echo e(URL::to('/')); ?>">
                    <img alt="<?php echo e($setting->title); ?>" src="<?php echo e(asset('images/banner/'.$setting->header_logo)); ?>"/>             
                </a>
               <div class="sm-easymert-search-box-wrapper ">
                <div class='sm-easymert-search-box'>
                    <form class='sm-easymert-form'>
                      <input class='form-control' placeholder='Search Goods...' type='text'  id="smSearchBar">
                      <button class='btn btn-link search-btn'>
                          <i class="ri-search-line"></i>
                      </button>
                    </form>
                  </div>
                  <div class="search-suggestion-wrapper custom-scrollbar" id="smSuggestedProduct">
                    <span class="popular-product"><?php echo e($lng->PopularProduct); ?></span>
                        <?php $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="suggested-products-info">
                            <div class="product-title">
                                <a href="<?php echo e(route('front-product.show',$product->slug)); ?>"><?php echo e($product->name); ?>

                                <span class="product-price"><?php echo e(App\Model\Product::currencyPrice($product->price)); ?></span>
                                </a>
                            </div>
                            <div class="product-img">
                                <a href="<?php echo e(route('front-product.show',$product->slug)); ?>">
                                    <img src="<?php echo e(asset('images/product/'.$product->image)); ?>" alt="<?php echo e($product->name); ?>">
                                </a>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <strong class="top-search"><?php echo e($lng->TopSearch); ?></strong>
                        <?php $__currentLoopData = $topKeys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="link top-keyword" href="<?php echo e(route('category')); ?>?key=<?php echo e(urlencode ( $key->term)); ?>"><?php echo e($key->term); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
               </div>
            </div>
        </div>
        <div class="offers-wrapper">
            <ul>
                <li><a href="<?php echo e(route('coming_soon')); ?>"><img src="<?php echo e(asset('images/voucher/index.svg')); ?>" alt="" style=""></a></li>
                <li><a href="<?php echo e(route('shop')); ?>"><img src="<?php echo e(asset('images/voucher/index1.svg')); ?>" alt="" style=""></a></li>
                <li><a href="<?php echo e(route('rocket-shop')); ?>"><img src="<?php echo e(asset('images/voucher/index2.svg')); ?>" alt="" style=""></a></li>
                <li><a href="<?php echo e(route('offers')); ?>"><img src="<?php echo e(asset('images/voucher/index3.jpg')); ?>" alt="" style=""></a></li>
            </ul>
        </div>
    </div>
    <div class="sm-bottom-nav">
        <div class="container">
            <div class="sm-bottom-nav-wrapper">
                <a href="<?php echo e(URL::to('/')); ?>">
                    <span class="sm-nav-item"><i class="ri-home-4-line"></i></span>
                </a>
                <span class="sm-nav-item ts__dropdown__trigger sm-dropdown-trigger">
                    <i class="ri-apps-2-line"></i>
                </span>
                <nav class="ts__dropdown dropdown-category">
                    <h4><?php echo e($lng->Categories); ?></h4>
                    <a href="#0" class="ts__close"><?php echo e($lng->Close); ?></a>
                    <ul class="ts__dropdown__content custom-scrollbar">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($category->subCategories->count()>0): ?>
                        <li class="has-children sm-device">
                            <a href="<?php echo e(route('category',[$category->slug])); ?>"><img src="<?php echo e(URL::to('/images/category/'.$category->image)); ?>" alt="<?php echo e($category->name); ?>"><?php echo e($category->name); ?></a>
                            <ul class="ts__secondary__dropdown is-hidden">
                                <li class="go-back"><a href="#0"><?php echo e($lng->Menu); ?></a></li>
                                <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($subCategory->childCategories->count()>0): ?>
                                <li class="has-children sm-device">
                                    <a href="<?php echo e(route('category',[$category->slug,$subCategory->slug])); ?>"><?php echo e($subCategory->name); ?></a>
                                    <ul class="is-hidden">
                                        <li class="go-back"><a href="#0"><?php echo e($subCategory->name); ?></a></li>
                                        <?php $__currentLoopData = $subCategory->childCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(route('category',[$category->slug,$subCategory->slug,$childCategory->slug])); ?>"><?php echo e($childCategory->name); ?></a>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                                <?php else: ?>
                                <li><a href="<?php echo e(route('category',[$category->slug,$subCategory->slug])); ?>"><?php echo e($subCategory->name); ?></a>
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
                <span class="sm-nav-item aside-cart-trigger" id="sm-cart-counter">
                    <i class="ri-shopping-bag-line"></i>
                    <?php if(Cart::instance('default')->content()->count()>0): ?>
                    <span class="counter-badge"><?php echo e(Cart::instance('default')->content()->count()); ?></span>
                    <?php endif; ?> 
                </span>                             
                
                
                <span class="sm-nav-item sm-main-menu-trigger">
                    <i class="ri-user-line"></i>
                </span>
                <div class="sm-main-menu">
                    <div class="header">
                        <div class="avater">
                            <?php if(auth()->guard()->guest()): ?>
                            <i class="ri-user-line"></i>
                            <?php else: ?>
                            <img alt="avatar"
                            src="<?php echo e(auth()->user()->provider ? auth()->user()->avatar : asset('images/avatar.png')); ?>" />
                            <?php endif; ?>
                        </div>
                        <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="login-btn"><?php echo e($lng->Login); ?></a>
                        <?php elseif(auth()->user()->type==0): ?>
                        <a href="<?php echo e(route('user.home')); ?>" class="login-btn"><?php echo e($lng->Account); ?></a>
                        <?php else: ?>
                        <a href="<?php echo e(URL::to('/admin')); ?>" class="login-btn"><?php echo e($lng->Account); ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="content-wrapper">
                        <div class="select-checkout_process_option">
                            <div class="select-option">                            
                                <select class="ts-custom-select selectors">
                                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(route('front.currency',$currency->id)); ?>"
                                        <?php echo e(Session::has('currency') ? ( Session::get('currency')->id == $currency->id ? 'selected' : '' ) : ($currencies->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '')); ?>>
                                        <?php echo e($currency->sign." ".$currency->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <select class="ts-custom-select selectors">
                                    <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(route('front.language',$lang->id)); ?>"
                                        <?php echo e(Session::has('language') ? ( Session::get('language')->id == $lang->id ? 'selected' : '' ) : ($langs->where('is_default','=',1)->first()->id == $lang->id ? 'selected' : '')); ?>>
                                        <?php echo e($lang->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="checkout_process_option" id="sm-all-counter">
                                <a href="<?php echo e(route('user.wishlist')); ?>">
                                    <i class="ri-heart-line"></i>
                                    <?php if($wishCount): ?>
                                    <span class="counter-badge"><?php echo e($wishCount); ?></span>
                                    <?php endif; ?>
                                </a>
                                <a href="<?php echo e(route('compare')); ?>"><i class="ri-shuffle-line"></i>
                                    <?php if(Cart::instance('compare-list')->content()->count()): ?>
                                    <span class="counter-badge">
                                        <?php echo e(Cart::instance('compare-list')->content()->count()); ?>

                                    </span>
                                    <?php endif; ?>
                                </a> 
                                <a href="#" class="order-track-button"><i class="ri-focus-3-line"></i></a>
                            </div> 
                        </div>
                        <ul class="main-menu-item-wrapper">
                            <li><a href="<?php echo e(route('category')); ?>"><?php echo e($lng->Shop); ?></a></li>
                            <li><a href="<?php echo e(route('about-us')); ?>"><?php echo e($lng->AboutUs); ?></a></li>
                            <li><a href="<?php echo e(route('contact')); ?>"><?php echo e($lng->Contact); ?></a></li>
                            <li><a href="<?php echo e(route('faq')); ?>"><?php echo e($lng->FAQ); ?></a></li>
                            <li><a href="<?php echo e(route('blog')); ?>"><?php echo e($lng->Blog); ?></a></li>
                        </ul>
                    </div>
                </div>                     
            </div>       
        </div>
    </div>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/includes/front/header.blade.php ENDPATH**/ ?>