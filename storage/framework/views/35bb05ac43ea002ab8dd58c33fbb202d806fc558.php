<?php $__env->startSection('title', "Order List"); ?>
<?php $__env->startSection('content'); ?>
<div class="user-panel-content-wrapper">
   <div class="main-content-wrapper recent-order-container">
        <h4 class="section-title bb-none"><?php echo e($lng->MyOrder); ?></h4>
        <table class="table">
            <thead>
                <tr class="title-row">
                    <th scope="col"><?php echo e($lng->OrderId); ?></th>
                    <th scope="col"><?php echo e($lng->Date); ?></th>
                    <th scope="col"><?php echo e($lng->Total); ?></th>
                    <th scope="col"><?php echo e($lng->Status); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="table-row" data-href="<?php echo e(route('user.order.show', $order->order_number)); ?>">
                    <td><?php echo e($order->order_number); ?></td>
                    <td><?php echo e($order->created_at->format('Md,Y')); ?></td>
                    <td>৳<?php echo e(App\Model\Product::currencyPriceRate($order->total)); ?></td>
                    <td><span class="status-badge <?php echo e($order->statusClass()); ?>"><?php echo e($order->statusText()); ?></span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="md-card-wrapper">
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="md-card table-row" data-href="<?php echo e(route('user.order.show', $order->order_number)); ?>">
                <div class="md-card-row">
                    <span><?php echo e($lng->OrderId); ?></span>
                    <span><?php echo e($order->order_number); ?></span>
                </div>
                <div class="md-card-row">
                    <span><?php echo e($lng->Date); ?></span>
                    <span><?php echo e($order->created_at->format('Md,Y')); ?></span>
                </div>
                <div class="md-card-row">
                    <span><?php echo e($lng->Total); ?></span>
                    <span>৳<?php echo e(App\Model\Product::currencyPriceRate($order->total)); ?></span>
                </div>
                <div class="md-card-row">
                    <span><?php echo e($lng->Status); ?></span>
                    <span><span class="status-badge <?php echo e($order->statusClass()); ?>"><?php echo e($order->statusText()); ?></span></span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php echo $orders->links(); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/user/order/index.blade.php ENDPATH**/ ?>