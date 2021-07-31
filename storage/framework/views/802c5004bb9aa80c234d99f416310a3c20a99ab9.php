<div class="row lg-cart-table">
    <div class="col">
        <div class="cart-table">
            <table class="table scrollTable">
                <thead>
                    <tr>
                        <th class="details"><?php echo e($lng->Product); ?></th>
                        <th class="price"><?php echo e($lng->Price); ?></th>
                        <th class="qty"><?php echo e($lng->Quantity); ?></th>
                        <th class="total"><?php echo e($lng->Total); ?></th>
                        <th class="remove"><?php echo e($lng->Remove); ?></th>
                    </tr>
                </thead>
                <tbody class="custom-scrollbar">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="cart-product">
                                    <div class="product-img">
                                        <img src="<?php echo e(asset('images/product/')); ?>/<?php echo e($item->options->image); ?>" alt="<?php echo e(Str::limit($item->name, 50)); ?>">
                                    </div>
                                    <div class="product-details">
                                        <a href="#"><?php echo e(Str::limit($item->name, 50)); ?></a>
                                        <div class="product-attributes">
                                            <?php if($item->options->size): ?>
                                                <span><?php echo e($lng->Size); ?> : <?php echo e($item->options->size); ?></span>
                                            <?php endif; ?>
                                            <?php if($item->options->color): ?>
                                                <span><?php echo e($lng->Color); ?> : <?php echo e($item->options->colorName); ?></span>
                                            <?php endif; ?>
                                            <?php $__currentLoopData = $item->options->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span><?php echo e($key); ?> : <?php echo e($value); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="product-price">৳<?php echo e(App\Model\Product::currencyPriceRate($item->price)); ?></p>
                            </td>
                            <td>
                                <div class="product-count">
                                    <div class="btn-minus cart-view" data-id="<?php echo e($item->id); ?>"
                                        data-row="<?php echo e($item->rowId); ?>">
                                        <button type="button" class="counter">
                                            <span><i class="ri-subtract-line"></i></span>
                                        </button>
                                    </div>
                                    <input id="item-<?php echo e($item->rowId); ?>" readonly type="text"
                                        class="counter-field qty-<?php echo e($item->rowId); ?>" value="<?php echo e($item->qty); ?>">
                                    <div class="btn-plus cart-view" data-row="<?php echo e($item->rowId); ?>">
                                        <button type="button" class="counter counter-plus">
                                            <span><i class="ri-add-line"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="product-total row-total-<?php echo e($item->rowId); ?>">৳
                                    <?php echo e(App\Model\Product::currencyPriceRate($item->priceTotal)); ?></p>
                            </td>
                            <td><span data-id="<?php echo e($item->id); ?>" data-row="<?php echo e($item->rowId); ?>"
                                    class="product-remove cart-view"><i class="ri-delete-bin-line"></i>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row sm-cart-table">
    <div class="col-12">
        <div>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product-info mb-20">
                    <div class="product-img">
                        <img src="<?php echo e(asset('images/product/')); ?>/<?php echo e($item->options->image); ?>" alt="<?php echo e(Str::limit($item->name, 50)); ?>">
                    </div>
                    <div class="product-content-wrapper">
                        <div class="flex-item">
                            <div class="product-details">
                                <p><?php echo e(Str::limit($item->name, 50)); ?></p>
                            </div>
                            <div class="remove-item">
                                <span data-id="<?php echo e($item->id); ?>" data-row="<?php echo e($item->rowId); ?>"
                                    class="product-remove cart-view"><i class="ri-delete-bin-line"></i></span>
                            </div>
                        </div>
                        <div class="flex-item">
                            <div class="product-attributes">
                                <p class="product-price"><?php echo e(App\Model\Product::currencyPriceRate($item->price)); ?></p>
                                <?php if($item->options->size): ?>
                                    <span>Size : <?php echo e($item->options->size); ?></span>
                                <?php endif; ?>
                                <?php if($item->options->color): ?>
                                    <span>color : <?php echo e($item->options->colorName); ?></span>
                                <?php endif; ?>
                                <?php $__currentLoopData = $item->options->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span><?php echo e($key); ?> <?php echo e($value); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="product-count">
                                <div class="btn-minus" data-row="<?php echo e($item->rowId); ?>">
                                    <button type="button" class="counter">
                                        <span><i class="ri-subtract-line"></i></span>
                                    </button>
                                </div>
                                <input type="text" class="counter-field qty-<?php echo e($item->rowId); ?>"
                                    value="<?php echo e($item->qty); ?>">
                                <div class="btn-plus" data-row="<?php echo e($item->rowId); ?>">
                                    <button type="button" class="counter counter-plus">
                                        <span><i class="ri-add-line"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/load/front/check-cart.blade.php ENDPATH**/ ?>