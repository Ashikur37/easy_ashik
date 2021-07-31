<?php if($products->count() == 0): ?>
    <span class="noresults"><?php echo e($lng->NoResultFound); ?></span>
<?php else: ?>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="suggested-products-info">
            <div class="product-title">
                <a href="<?php echo e(route('front-product.show', $product->slug)); ?>"><?php echo App\Model\Product::highlight(Str::limit($product->name, 60, '..'), $key); ?>

                    <br>
                    <span class="product-price">৳<?php echo e(App\Model\Product::currencyPrice($product->price)); ?></span>
                </a>
            </div>
            <div class="product-img">
                <a href="<?php echo e(route('front-product.show', $product->slug)); ?>">
                    <img src="<?php echo e(asset('images/product/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>">
                </a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="total-suggested-product">
        <a class="search-all" href="#"><?php echo e($lng->SeeAll); ?> <?php echo e($count); ?> <?php echo e($lng->Results); ?>

        </a>
    </div>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/load/front/suggestion.blade.php ENDPATH**/ ?>