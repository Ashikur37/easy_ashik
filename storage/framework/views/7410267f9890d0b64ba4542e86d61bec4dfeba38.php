<div
    class="item-inner formet_2 cart-item-<?php echo e($product->product->id); ?> <?php echo e(array_key_exists($product->product->id, $cartProducts) ? 'in-cart' : ''); ?>">
    <div class="item-img-badge">
        <a href="<?php echo e(route('front-product.show', $product->product->slug)); ?>" class="item-img">
            <img alt="<?php echo e(Str::limit($product->product->name, 50)); ?>" src="<?php echo e(asset('/')); ?>images/product/<?php echo e($product->product->image); ?>">
        </a>
        
        <span class="<?php echo e(in_array($product->product->id, $wishProducts) ? 'active' : ''); ?> add__wishlist ri-heart-fill"
            data-url="<?php echo e(route('wishlist.add')); ?>" data-id="<?php echo e($product->product->id); ?>"></span>
        
    </div>
    <div class="item-content cart-item-<?php echo e($product->product->id); ?> <?php echo e(array_key_exists($product->product->id, $cartProducts) ? 'in-cart' : ''); ?>">
        <div class="item-price-ratings">
            <div class="item-price">
                <span class="new-price"><?php echo e(App\Model\Product::currencyPrice($product->product->price)); ?></span>
                <?php if($product->product->actualPrice() != $product->product->price): ?>
                    <span class="old-price"><?php echo e(App\Model\Product::currencyPrice($product->product->actualPrice())); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="item-title">
            <a href="<?php echo e(route('front-product.show', $product->product->slug)); ?>"><?php echo e(Str::limit($product->product->name, 50)); ?></a>
        </div>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/common/product/style3.blade.php ENDPATH**/ ?>