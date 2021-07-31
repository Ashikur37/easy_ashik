<div>
    <div
        class="item-inner cart-item-<?php echo e($product->product->id); ?> <?php echo e(array_key_exists($product->product->id, $cartProducts) ? 'in-cart' : ''); ?>">
        <div class="item-img-badge">
            <a href="<?php echo e(route('front-product.show', $product->product->slug)); ?>" class="item-img">
                <img alt="<?php echo e(Str::limit($product->product->name, 50)); ?>"
                    src="<?php echo e(asset('/')); ?>images/product/<?php echo e($product->product->image); ?>">
            </a>
            <div class="item-badge-wrapper">
                <?php $__currentLoopData = $product->product->productBadges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span style="background-color:<?php echo e($badge->background); ?>;color:<?php echo e($badge->color); ?>;"
                        class="item-badge"><?php echo e($badge->name); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <span class="<?php echo e(in_array($product->product->id, $wishProducts) ? 'active' : ''); ?> add__wishlist ri-heart-fill"
                data-url="<?php echo e(route('wishlist.add')); ?>" data-id="<?php echo e($product->product->id); ?>"></span>
            <?php if(!$product->product->inStock()): ?>
                <span class="stockout-btn"><?php echo e($lng->OutOfStock); ?></span>
            <?php endif; ?>
        </div>
        <div
            class="item-content cart-item-<?php echo e($product->product->id); ?> <?php echo e(array_key_exists($product->product->id, $cartProducts) ? 'in-cart' : ''); ?>">
            <div class="item-price-ratings">
                <div class="item-price">
                    <span class="new-price">৳<?php echo e(App\Model\Product::currencyPrice($product->product->price)); ?></span>
                    <?php if($product->product->actualPrice() != $product->product->price): ?>
                        <span
                            class="old-price">৳<?php echo e(App\Model\Product::currencyPrice($product->product->actualPrice())); ?></span>
                    <?php endif; ?>
                </div>
                <div class="ratings">
                    <div class="empty-stars"></div>
                    <div class="full-stars" style="width:<?php echo e($product->product->rating * 20); ?>%"></div>
                </div>
            </div>
            <div class="item-title">
                <a
                    href="<?php echo e(route('front-product.show', $product->product->slug)); ?>"><?php echo e(Str::limit($product->product->name, 50)); ?></a>
            </div>
            <div
                class="item-action cart-item-<?php echo e($product->product->id); ?> <?php echo e(array_key_exists($product->product->id, $cartProducts) ? 'in-cart' : ''); ?>">
                <ul>
                    <li class="cart-button-wrapper-<?php echo e($product->product->id); ?> <?php if(!(count($product->product->
                        options) == 0 && count($product->product->colors) == 0 && count($product->product->sizes) == 0) ||
                        !$product->product->inStock()): ?> w-100 <?php endif; ?>">
                        <?php if(!$product->product->inStock()): ?>
                            <span class="sold-out-btn"><?php echo e($lng->SoldOut); ?></span>
                        <?php elseif(count($product->product->options)==0&&count($product->product->colors)==0&&count($product->product->sizes)==0): ?>
                            <?php if(array_key_exists($product->product->id, $cartProducts)): ?>
                                <div class="product-count item-count">
                                    <div class="btn-minus" data-id="<?php echo e($product->product->id); ?>"
                                        data-row="<?php echo e($cartProducts[$product->product->id]['rowId']); ?>">
                                        <button aria-label="substract" type="button" class="counter">
                                            <i class="ri-subtract-line"></i>
                                        </button>
                                    </div>
                                    <input type="text" readonly
                                        class="counter-field qty-<?php echo e($cartProducts[$product->product->id]['rowId']); ?>"
                                        value="<?php echo e($cartProducts[$product->product->id]['qty']); ?>">
                                    <div class="btn-plus" data-row="<?php echo e($cartProducts[$product->product->id]['rowId']); ?>">
                                        <button aria-label="addition" type="button" class="counter counter-plus">
                                            <i class="ri-add-line"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php else: ?>
                                <span data-url="<?php echo e(route('cart.add')); ?>" data-id="<?php echo e($product->product->id); ?>"
                                    class="add__cart">
                                    <?php echo e($lng->AddToCart); ?>

                                </span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="see-option-btn">
                                <a
                                    href="<?php echo e(route('front-product.show', $product->product->slug)); ?>"><?php echo e($lng->SeeOptions); ?></a>
                            </span>
                        <?php endif; ?>
                    </li>
                    <?php if(count($product->product->options) == 0 && count($product->product->colors) == 0 && count($product->product->sizes) == 0 && $product->product->inStock()): ?>
                        <li>
                            <?php if(count($product->product->options) == 0 && count($product->product->colors) == 0 && count($product->product->sizes) == 0 && $product->product->inStock()): ?>
                                <span data-url="<?php echo e(route('cart.add')); ?>" data-id="<?php echo e($product->product->id); ?>"
                                    class="buy-btn">
                                    <a href="#"> <?php echo e($lng->BuyNow); ?></a>
                                </span>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/common/product/flash-sale.blade.php ENDPATH**/ ?>