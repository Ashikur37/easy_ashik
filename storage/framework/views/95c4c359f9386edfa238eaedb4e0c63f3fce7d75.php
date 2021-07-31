<?php $__env->startSection('title', "Campaign List"); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">Campaign List</a>
    </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/admin')); ?>/css/vendor/select2.min.css">
<link rel="stylesheet" href="<?php echo e(asset('assets/admin')); ?>/css/vendor/dataTables.bootstrap4.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="flex-item top-info-header">
                <div class="d-flex">
                    <div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('campaign.create')): ?>
                        <a href="<?php echo e(route('campaign.create')); ?>" class="submit-btn mr-3">
                            <?php echo e($lng->Add); ?>

                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="action-wrapper">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('campaign.destroy')): ?>
                        <button class="trash-btn delete-button-head mr-3" data-route="<?php echo e(URL::to('/admin/campaign/multi')); ?>">
                                <?php echo e($lng->Delete); ?>

                        </button>
                        <?php endif; ?>
                    </div>
                </div>               
                <div class="d-flex ">              
                    <div class="data-table-search-box">
                        <input id="searchBox" type="text" placeholder="Search..." /><span> </span>
                    </div>
                    <div class="pl-3">
                        <select class="select2 form-control" id="pagelen" >
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
                <div class="table-responsive">
                    <table class="table table-striped first" id="takwa-table">
                        <thead>
                            <tr>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['campaign.edit','campaign.destroy'])): ?>
                                <th>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="checkboxPrimary0" class="chek-all check-element">
                                        <label for="checkboxPrimary0">
                                        </label>
                                    </div>
                                </th>
                                 <?php endif; ?>
                                <th><?php echo e($lng->Image); ?></th>
                                <th><?php echo e($lng->Title); ?></th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('campaign.edit')): ?>
                                <th><?php echo e($lng->Status); ?></th>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['campaign.edit','campaign.destroy'])): ?>
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
<?php echo $__env->make('includes.scripts.admin.data-table', ['route' => 'campaign.index','columns'=>[
    auth()->user()->can('campaign.edit')||auth()->user()->can('campaign.destroy')?
[
"name"=>'index',
'order'=>'false'
]:null,
[
"name"=>'image',
'order'=>'true'
],

[
"name"=>'title',
'order'=>'true'
],
[
"name"=>'status',
'order'=>'false'
],
auth()->user()->can('campaign.edit')||auth()->user()->can('campaign.destroy')?
[
"name"=>'action',
'order'=>'false'
]:null,
]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin',['headerText' => "Campaign List"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/admin/campaign/index.blade.php ENDPATH**/ ?>