    
    <?php if(count(explode(".", request()->getRequestUri()))==1): ?>
    <?php $__env->startSection('title', "$lng->_404NotFound"); ?>
    <?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row my-5">
            <div class="col"><img src="<?php echo e(asset('images/banner/'.$setting->banner_404)); ?>"/></div>
        </div>
    </div>
    <?php $__env->stopSection(); ?> 

    <?php else: ?>
    <?php $__env->startSection('title', __('Not Found')); ?>
    <?php $__env->startSection('code', '404'); ?>
    <?php $__env->startSection('message', __('Not Found')); ?>
    

    <?php endif; ?>


<?php echo $__env->make(['layouts.front','errors::minimal','errors::minimal','errors::minimal','errors::minimal','errors::minimal'][count(explode(".", request()->getRequestUri()))-1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/errors/404.blade.php ENDPATH**/ ?>