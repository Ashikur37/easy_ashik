<div
    class="item-inner cart-item-<?php echo e($product->id); ?> <?php echo e(array_key_exists($product->id, $cartProducts) ? 'in-cart' : ''); ?> formet_2">
    <div class="item-img-badge">
        <a href="<?php echo e(route('front-product.show', $product->slug)); ?>" class="item-img">
            <img alt="<?php echo e(Str::limit($product->name, 50)); ?>" src="<?php echo e(asset('/')); ?>images/product/<?php echo e($product->image); ?>">
        </a>
        
        <span class="<?php echo e(in_array($product->id, $wishProducts) ? 'active' : ''); ?> add__wishlist ri-heart-fill"
            data-url="<?php echo e(route('wishlist.add')); ?>" data-id="<?php echo e($product->id); ?>"></span>
        
    </div>
    <div class="item-content cart-item-<?php echo e($product->id); ?> <?php echo e(array_key_exists($product->id, $cartProducts) ? 'in-cart' : ''); ?>">
        <div class="item-price-ratings">
            <div class="item-price">
                <span class="new-price">৳<?php echo e(App\Model\Product::currencyPrice($product->price)); ?></span>
                <?php if($product->actualPrice() != $product->price): ?>
                    <span class="old-price">৳<?php echo e(App\Model\Product::currencyPrice($product->actualPrice())); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="item-title">
            <a href="<?php echo e(route('front-product.show', $product->slug)); ?>"><?php echo e(Str::limit($product->name, 50)); ?></a>
        </div>
        
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/common/product/style4.blade.php ENDPATH**/ ?>