<?php $__env->startSection('title', "Create Address"); ?>
<?php $__env->startSection('content'); ?>
<div class="user-panel-content-wrapper">
    <div class="tab-pane" id="withdraw" role="tabpanel" aria-labelledby="withdraw-tab">
        <div class="main-content-wrapper withdraw-container">
            <h4 class="section-title">Create Address</h4>
            <form action="<?php echo e(route('user-address.store')); ?>" method="POST" class="withdraw-form">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >First Name</label> 
                            <input  required type="text" class="form-control"  name="first_name" placeholder="First Name" /> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >Last Name</label> 
                            <input  required type="text" class="form-control"  name="last_name" placeholder="Last Name" /> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >Mobile</label> 
                            <input  required type="text" class="form-control"  name="mobile" placeholder="Mobile" /> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >City</label> 
                            <input  required type="text" class="form-control"  name="city" placeholder="City" /> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >Email</label> 
                            <input  required type="email" class="form-control"  name="email" placeholder="Email" /> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >Zip</label> 
                            <input  required type="text" class="form-control"  name="zip" placeholder="Zip" /> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >Street Address</label> 
                            <input  required type="text" class="form-control"  name="street_address" placeholder="Street Address" /> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >Region</label>
                            <select required id="method" name="region" class="ts-custom-select wide">
                            <option value="">Select Region</option>
                            <option value="Inside Dhaka">Inside Dhaka</option>
                            <option value="Outside Dhaka">Outside Dhaka</option>
                            </select>
                        </div>
                    </div>
                </div>
               
                <div class="form-group mb-10">
                <input class="default-btn" type="submit" value="Create Address">
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/user/address/create.blade.php ENDPATH**/ ?>