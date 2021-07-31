<?php $__env->startSection('title', "My Address"); ?>
<?php $__env->startSection('content'); ?>
<div class="user-panel-content-wrapper">
    <div class="main-content-wrapper reviews-container">
        <h4 class="section-title bb-none">
            My Address
                <a class="btn btn-success" href="<?php echo e(route('user-address.create')); ?>">Create Address</a>
        </h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="title-row">
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">City</th>
                        <th scope="col">ZIP</th>
                        <th scope="col">Address</th>
                        <th scope="col">Region</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="reviews-row">
                        <td><?php echo e($address->first_name); ?> <?php echo e($address->last_name); ?></td>
                        <td><?php echo e($address->mobile); ?></td>
                        <td><?php echo e($address->email); ?></td>
                        <td><?php echo e($address->city); ?></td>
                        <td><?php echo e($address->zip); ?></td>
                        <td><?php echo e($address->street_address); ?></td>
                        <td><?php echo e($address->region); ?></td>
                        <td><a style="color:white" class="btn btn-danger" href="<?php echo e(URL::to('/user/address/delete/'.$address->id)); ?>">Delete</a></td>
                    </tr>                            
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>          
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/user/address/index.blade.php ENDPATH**/ ?>