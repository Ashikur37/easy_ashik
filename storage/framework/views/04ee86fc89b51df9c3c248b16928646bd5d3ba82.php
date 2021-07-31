<?php $__env->startSection('title', "$lng->ProductList"); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin')); ?>/css/vendor/dataTables.bootstrap4.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#"><?php echo e($lng->ProductList); ?></a>
    </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="flex-item top-info-header">
                    <div class="d-flex">
                        <div>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.create')): ?>
                                <a href="<?php echo e(route('product.create')); ?>" class="submit-btn mr-3">
                                    <?php echo e($lng->Add); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="action-wrapper">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.edit')): ?>
                                <select class="select2 select-status-head" data-route="<?php echo e(URL::to('/admin/product/multi')); ?>">
                                    <option value=""><?php echo e($lng->Status); ?></option>
                                    <option value="1"><?php echo e($lng->Enabled); ?></option>
                                    <option value="0"><?php echo e($lng->Disabled); ?></option>
                                </select>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.destroy')): ?>
                                <button class="trash-btn delete-button-head mr-3"
                                    data-route="<?php echo e(URL::to('/admin/product/multi')); ?>">
                                    <?php echo e($lng->Delete); ?>

                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="d-flex ">
                        <div class="data-table-search-box">
                            <input id="searchBox" type="text" placeholder="Search..." />
                        </div>
                        <div class="pl-3">
                            <select class="select2 form-control" id="pagelen">
                                <option value="10">10</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="-1"><?php echo e($lng->All); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-table">
                    <div class="responsive-table">
                        <table class="table table-striped first" id="takwa-table">
                            <thead>
                                <tr>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['product.edit','product.destroy'])): ?>
                                    <th>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                            <label for="checkboxPrimary0">
                                            </label>
                                        </div>
                                    </th>
                                    <?php endif; ?>
                                    <th>Id</th>
                                    <th><?php echo e($lng->Image); ?></th>
                                    <th> <?php echo e($lng->Name); ?> </th>
                                    <th> <?php echo e($lng->Price); ?> </th>
                                    <th> <?php echo e($lng->Quantity); ?> </th>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.edit')): ?>
                                        <th><?php echo e($lng->Status); ?></th>
                                    <?php endif; ?>
                                    <th><?php echo e($lng->Created); ?></th>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['product.edit','product.destroy'])): ?>
                                    <th><?php echo e($lng->Action); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/admin/js/vendor/select2.full.min.js')); ?>"></script>
    <?php echo $__env->make('includes.scripts.admin.data-table',
    ['route' => 'product.index','columns'=>[
    auth()->user()->can('product.edit')||auth()->user()->can('product.destroy')?
    [
    "name"=>'index',
    'order'=>'false'
    ]:null,
    [
    "name"=>'id',
    'order'=>'true'
    ],
    [
    "name"=>'image',
    'order'=>'false'
    ],
    [
    "name"=>'name',
    'order'=>'true'
    ],
    [
    "name"=>'selling_price',
    'order'=>'false',
    ],
    [
    "name"=>'qty',
    'order'=>'true',
    ],
    auth()->user()->can('product.edit')?
    [
    "name"=>'status',
    'order'=>'false'
    ]:null,
    [
    "name"=>'created',
    'order'=>'true'
    ],
    auth()->user()->can('product.edit')||auth()->user()->can('product.destroy')?
    [
    "name"=>'action',
    'order'=>'false'
    ]:null,
    ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin',['headerText' => $lng->ProductList], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/admin/product/index.blade.php ENDPATH**/ ?>