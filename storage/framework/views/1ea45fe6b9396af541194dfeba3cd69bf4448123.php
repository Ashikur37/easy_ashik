<div class="container">
    <div class="best-deal-section p-20 pb-0 sm-pt-10 mt-20 sm-mt-10">
        <h5 class="section-header mt-6 ">
        <i class="ri-medal-line flash-icon"></i><?php echo e($lng->BestDeals); ?></h5>
        <?php if(count($bestDealProducts) > 0): ?>
            <div class="best-deal-products mt-20">
                <?php $__currentLoopData = $bestDealProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="best-deal-item mb-25">
                        <div class="best-deal-inner">
                            <img src="<?php echo e(asset('images/product/' . $product->image)); ?>"
                                alt=" <?php echo e(Str::limit($product->name, 20, '...')); ?>">
                            <div class="content-wrapper">
                                <a href="<?php echo e(route('front-product.show', $product->slug)); ?>">
                                    <span class="product-title">
                                        <?php echo e(Str::limit($product->name, 45)); ?>

                                    </span>
                                    <div class="price-cart">৳<?php echo e(App\Model\Product::currencyPrice($product->price)); ?>

                                        <?php if($product->actualPrice() != $product->price): ?>
                                            <div class="old-price">
                                                <span>৳<?php echo e(App\Model\Product::currencyPrice($product->actualPrice())); ?></span>
                                               
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php if($setting->top_in_category): ?>
    <div class="container">
        <div class="top-category-section p-20 sm-pt-10 mt-20 sm-mt-10 sm-pt-15 white-bg">
            <h5 class="section-header "><i class="ri-award-line flash-icon"></i>Top Categories </h5>
            <div class="top-in-category d-flex flex-wrap mt-20">
                <?php $__currentLoopData = $trendCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="top-in-category-item"
                        data-href="<?php echo e(route('category',[$category->slug])); ?>">
                        <img src="<?php echo e(asset('images/category/' . $category->image)); ?>" alt="<?php echo e($category->name); ?>">
                        <div class="category-name">
                            <span><?php echo e($category->name); ?></span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if($setting->is_two_column_banner_1): ?>
    <div class="container">
        <div class="ts-banner-wrapper">
            <div class="row">
                <div class="col-md-4 col-12 prl-10 mt-20 sm-mt-10">
                    <?php if($setting->two_column_banner_1_image): ?>
                        <a aria-label="banner"
                            <?php echo e($setting->two_column_banner_1_new_window == 1 ? 'target="_blank"' : ''); ?>

                            href="<?php echo e($setting->two_column_banner_1_url); ?>" class="ts-banner twc-banner">
                            <img src="<?php echo e(asset('images/banner/' . $setting->two_column_banner_1_image)); ?>" alt="banner">
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-md-4 col-12 prl-10 mt-20 sm-mt-10">
                    <?php if($setting->two_column_banner_2_image): ?>
                        <a aria-label="banner"
                            <?php echo e($setting->two_column_banner_2_new_window == 1 ? 'target="_blank"' : ''); ?>

                            href="<?php echo e($setting->two_column_banner_2_url); ?>" class="ts-banner twc-banner">
                            <img src="<?php echo e(asset('images/banner/' . $setting->two_column_banner_2_image)); ?>" alt="banner">
                        </a>
                    <?php endif; ?>
                </div>
                 <div class="col-md-4 col-12 prl-10 mt-20 sm-mt-10">
                    <?php if($setting->two_column_banner_3_image): ?>
                        <a aria-label="banner"
                            <?php echo e($setting->two_column_banner_3_new_window == 1 ? 'target="_blank"' : ''); ?>

                            href="<?php echo e($setting->two_column_banner_3_url); ?>" class="ts-banner twc-banner">
                            <img src="<?php echo e(asset('images/banner/' . $setting->two_column_banner_3_image)); ?>" alt="banner">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="container">
<div class="row">
<div class="col-xl-6 prl-10 sm-prl-0">
    <?php if($setting->is_new_arrival): ?>   
        <div class="new-arrival-section p-20 sm-pt-10 mt-20 sm-mt-10 white-bg">
            <div class="section-wrapper sm-prl-0">
                <h5 class="item-section-info mb-0 "><i
                        class="ri-bookmark-3-line badge-arrow"></i><?php echo e($lng->NewArrival); ?></h5>
                <a href="<?php echo e(route('category')); ?>" class="see-all-product"><?php echo e($lng->ViewAll); ?>

                    <i class="ri-arrow-right-line see-all-arrow"></i>
                </a>
            </div>
            <div class="d-flex flex-wrap mt-20">
                <?php $__currentLoopData = $newProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('common.product.style4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div> 
    <?php endif; ?>
</div>
    <div class="col-xl-6 prl-10 sm-prl-0">
        <?php if($setting->is_best_sale): ?>
            <div class="best-sale-section p-20 sm-pt-10 white-bg mt-20 sm-mt-10">
                 <div class="best-sale-wrapper sm-prl-0">
                    <h5 class="item-section-info mb-0"><i
                            class="ri-medal-2-line badge-arrow"></i><?php echo e($lng->BestSelling); ?></h5>
                    <a href="<?php echo e(route('best-sale')); ?>" class="see-all-product"><?php echo e($lng->ViewAll); ?>

                        <i class="ri-arrow-right-line see-all-arrow"></i>
                    </a>
                </div>
                <div class="d-flex flex-wrap mt-20">
                    <?php $__currentLoopData = $bestSellProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php echo $__env->make('common.product.style3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>

<?php if($setting->is_three_column_product): ?>
    <div class="container">
        <div class="tht-section">
            <div class="row">
                <div class="col-xl-6 prl-10 sm-prl-0 mt-20 sm-mt-10">
                  <div class="p-20 sm-pt-15 white-bg pb-10">
                    <div class="column-heading">
                       <h5 class="column-title"><i class="ri-fire-line badge-arrow"></i><?php echo e($lng->Hot); ?></h5>
                    </div>
                    <div class="trending-productss">
                        <div class="d-flex flex-wrap">
                            <?php $__currentLoopData = $hotProducts->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('front-product.show', $product->slug)); ?>"
                                class="single-product-card">
                                    <div class="left">
                                        <img src="<?php echo e(asset('/')); ?>images/product/<?php echo e($product->image); ?>" alt="<?php echo e(Str::limit($product->name, 50)); ?>"
                                            class="product-img">
                                    </div>
                                    <div class="right">
                                        <div class="product-name">
                                            <?php echo e(Str::limit($product->name, 50)); ?>

                                        </div>
                                        <div class="product-prices">
                                            <span
                                                class="new-price">৳<?php echo e(App\Model\Product::currencyPrice($product->price)); ?></span>
                                            <?php if($product->actualPrice() != $product->price): ?>
                                                <span
                                                    class="old-price">৳<?php echo e(App\Model\Product::currencyPrice($product->actualPrice())); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="ratings">
                                            <div class="empty-stars"></div>
                                            <div class="full-stars"
                                                style="width:<?php echo e($product->rating * 20); ?>%"></div>
                                        </div>
                                    </div>
                                </a>      
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 prl-10 sm-prl-0 mt-20 sm-mt-10">
                    <div class="p-20 sm-pt-15 white-bg pb-10">
                        <div class="column-heading">
                        <h5 class="column-title"><i class="ri-bookmark-3-line badge-arrow"></i> <?php echo e($lng->TopRated); ?></h5>
                    </div>
                    <div class="top-rated-sliders">
                        <div class="d-flex flex-wrap">
                            <?php $__currentLoopData = $topTrendProducts->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('front-product.show', $product->slug)); ?>" class="single-product-card">
                                    <div class="left">
                                        <img src="<?php echo e(asset('/')); ?>images/product/<?php echo e($product->image); ?>" alt="<?php echo e(Str::limit($product->name, 50)); ?>"
                                            class="product-img">
                                    </div>
                                    <div class="right">
                                        <div class="product-name">
                                            <?php echo e(Str::limit($product->name, 50)); ?>

                                        </div>
                                        <div class="product-prices">
                                            <span
                                                class="new-price">৳<?php echo e(App\Model\Product::currencyPrice($product->price)); ?></span>
                                            <?php if($product->actualPrice() != $product->price): ?>
                                                <span
                                                    class="old-price">৳<?php echo e(App\Model\Product::currencyPrice($product->actualPrice())); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="ratings">
                                            <div class="empty-stars"></div>
                                            <div class="full-stars"
                                                style="width:<?php echo e($product->rating * 20); ?>%"></div>
                                        </div>
                                    </div>
                                </a>                     
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </div>
                    </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if($setting->is_full_width_banner): ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 prl-10 mt-20 sm-mt-10">
                <div class="ts-banner-wrapper">
                    <a <?php echo e($setting->full_width_banner_new_window == 1 ? 'target="_blank"' : ''); ?>

                        href="<?php echo e($setting->full_width_banner_url); ?>" class="ts-banner fw-banner">
                        <?php if($setting->full_width_banner_image): ?>
                            <img src="<?php echo e(asset('images/banner/' . $setting->full_width_banner_image)); ?>" alt="banner">
                        <?php endif; ?>
                    </a>
                </div>
            </div>
            <div class="col-md-4 prl-10 mt-20 sm-mt-10">
                <div class="ts-banner-wrapper">
                    <a <?php echo e($setting->full_width_banner_2_new_window == 1 ? 'target="_blank"' : ''); ?>

                        href="<?php echo e($setting->full_width_banner_2_url); ?>" class="ts-banner fw-banner">
                        <?php if($setting->full_width_banner_2_image): ?>
                            <img src="<?php echo e(asset('images/banner/' . $setting->full_width_banner_2_image)); ?>" alt="banner">
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php $__currentLoopData = $categories->where('is_featured',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="container">
        <div class="best-sale-section p-20 sm-pt-10 pb-0 mt-20 sm-mt-10 white-bg">
            <div class="section-wrapper">
                <h5 class="item-section-info mb-0">
                    <i class="ri-apps-2-line badge-arrow"></i><?php echo e($category->name); ?></h5>
                    <span class="ri-menu-line d-lg-none categoryToggler"></span>
                    <ul class="category-tab-menu">
                        <?php $__currentLoopData = $category->subCategories->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="sub-product sub-<?php echo e($category->id); ?>" data-id="<?php echo e($subCategory->id); ?>" data-category="<?php echo e($category->id); ?>">
                        <?php echo e($subCategory->name); ?>

                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route('category',[$category->slug])); ?>" ><?php echo e($lng->All); ?></a></li>
                    </ul>
            </div>
            <div class="mt-20" >
                <div class="product-slider" id="sub-wrapper<?php echo e($category->id); ?>">
                    <?php $__currentLoopData = $category->products->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('common.product.style1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php if($setting->is_brands): ?>
    <div class="container">
        <div class="shop-brand-section mt-20 sm-mt-10 white-bg">
            <div class="row">
                <div class="col">
                    <div class="top-brands-slider">
                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="brand-item">
                                <div class="brand-image">
                                    <a href="<?php echo e(route('brand.product', $brand->name)); ?>">
                                        <img src="<?php echo e(asset('images/brand/' . $brand->logo)); ?>" alt="<?php echo e($brand->name); ?>">
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if($setting->is_blog): ?>
    <div class="container">
        <div class="blog-section p-20 pb-0 sm-pt-10 mb-20 sm-mb-10 mt-20 sm-mt-10 white-bg">
            <div class="row">
                <div class="col sm-prl-0">
                    <h5 class="section-header mb-20 pt-6"><i class="ri-pen-nib-line badge-arrow"></i><?php echo e($lng->FromOurBlog); ?></h5>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 col-sm-4 col-12 mb-20 prl-10">
                        <div class="card blog-inner">
                            <a href="<?php echo e(route('front-blog.show', $blog->slug)); ?>" class="blog-img">
                                <img class="card-img-top" src="<?php echo e(asset('images/blog/' . $blog->image)); ?>"
                                    alt="<?php echo e($blog->title); ?>" />
                            </a>
                            <div class="card-body">
                                <a class="card-title" href="<?php echo e(route('front-blog.show', $blog->slug)); ?>">
                                    <?php echo e(Str::limit($blog->title, 40, '.')); ?>

                                </a>
                                <div class="blog-meta">
                                    <a href="<?php echo e(route('front-blog.show', $blog->slug)); ?>"><?php echo e($blog->commentsCount()); ?>

                                        <?php echo e($lng->Comments); ?></a>
                                    <span class="blog-date"><?php echo e($blog->created_at->format('d M Y')); ?></span>
                                </div>
                                <p class="card-text">
                                    <?php echo e(html_entity_decode(Str::limit(trim(strip_tags($blog->details)), 90, '...'))); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/front/homeExtra.blade.php ENDPATH**/ ?>