<?php $__env->startSection('title', "$lng->Checkout"); ?>
<?php $__env->startSection('pageStyle'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/vendor/select2.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/page/checkout.css">
    <link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/page/cart.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="checkout-section">
        <div class="container white-bg">
            <div class="row">
                <div class="col-xl-10 offset-xl-1 white-bg">
                    <h2><?php echo e($lng->Checkout); ?> </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-10 offset-xl-1 checkout-form white-bg p-20 pb-25 ">
                    <form action="<?php echo e(route('checkout.submit')); ?>" method="post" 
                            class="require-validation" data-cc-on-file="false"
                            data-stripe-publishable-key="<?php echo e($paymentSetting->stripe_key); ?>" id="payment-form">
                            <?php echo csrf_field(); ?>
                        <div class="row">
                           <div class="col-lg-6 col-12 after-border"> 
                            <h4>Billing Address</h4>
                                <div class="d-flex after-m-r">
                                    <div class="form-group" style="flex: 1">
                                        <select onchange="changeAddress(this.value)" name="address_id" id="" class="form-control" required>
                                            <option value=""> Select Address
                                            <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($address->id); ?>">
                                                        <?php echo e($address->first_name); ?> <?php echo e($address->lastname); ?> <?php echo e($address->mobile); ?>  
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div>
                                        <a class="default-btn " href="<?php echo e(route('user-address.create')); ?>" style="color: #fff;width: 110px;margin-left: 10px;">Add new</a>
                                    </div>
                                </div>
                                <div id="my-address"></div>
                            </div>
                           <div class="col-6 d-none d-lg-block">
                            <div id="checkout-cart" class="checkout-process">
                                <div class="row">
                                    <div class="col-lg-7 col-md-5 col-12 ">
                                        <div class="checkout-process-content">
                                            <div class="flex-item">
                                                <p><?php echo e($lng->Discount); ?></p>
                                                <span>৳<?php echo e(App\Model\Product::currencyPriceRate(Cart::discount())); ?></span>
                                            </div>
                                            <div class="flex-item">
                                                <p><?php echo e($lng->Tax); ?></p>
                                                <span>৳<?php echo e(App\Model\Product::currencyPriceRate(Cart::tax())); ?></span>
                                            </div>
                                            <div class="flex-item">
                                                <p class="mb-md-0"><?php echo e($lng->SubTotal); ?></p>
                                                <span>৳<?php echo e(App\Model\Product::currencyPriceRate(Cart::subtotal())); ?></span>
                                            </div>
                                            <div class="sm-grand-total">
                                                <div class="grand-total">
                                                    <p class="mb-0"><?php echo e($lng->GrandTotal); ?></p>
                                                    <span
                                                        class="total-price">৳<?php echo e(App\Model\Product::currencyPriceRate(Cart::total())); ?></span>
                                                </div>
                                                <button class="btn-checkout default-btn">Process Order</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5 lg-grand-total pr-10">
                                        <div class="grand-total">
                                            <p class="mb-4"><?php echo e($lng->GrandTotal); ?></p>
                                            <span
                                                class="total-price">৳<?php echo e(App\Model\Product::currencyPriceRate(Cart::total())); ?></span>
                                        </div>
                                        <button class="default-btn btn-checkout">Process Order</button>
                                    </div>
                                </div>
                            </div>
                           </div>
                           
                        </div> 
                        
                        <div id="dynamic-cart">
                            <?php echo $__env->make('load.front.check-cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        
                        <div class="row mt-15" id="payment-additional"></div>
                        <div class="row mt-15">
                            <div id="stripe-field" class="d-none col-12">
                                <div class="row">
                                    <div class='col-sm-6 col-12 form-group required'>
                                        <label class='control-label'><?php echo e($lng->NameOnCard); ?></label>
                                        <input class='form-control' size='4' type='text'>
                                    </div>
                                    <div class='col-sm-6 col-12 form-group required'>
                                        <label class='control-label'><?php echo e($lng->CardNumber); ?></label>
                                        <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-12 col-sm-4 form-group cvc required'>
                                        <label class='control-label'><?php echo e($lng->CVC); ?></label>
                                        <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4'
                                            type='text'>
                                    </div>
                                    <div class='col-12 col-sm-4 form-group expiration required'>
                                        <label class='control-label'><?php echo e($lng->ExpirationMonth); ?></label>
                                        <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                    </div>
                                    <div class='col-12 col-sm-4 form-group expiration required'>
                                        <label class='control-label'><?php echo e($lng->ExpirationYear); ?></label>
                                        <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-12 error form-group d-none'>
                                        <div class='alert-danger alert'>Please correct the errors and try
                                            again.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-20 d-lg-none">
                            <div id="checkout-cart" class="checkout-process col-12">
                                <div class="row">
                                    
                                    <div class="col-lg-6 col-md-5 col-12 ">
                                        <div class="checkout-process-content">
                                            <div class="flex-item">
                                                <p><?php echo e($lng->Discount); ?></p>
                                                <span>৳<?php echo e(App\Model\Product::currencyPriceRate(Cart::discount())); ?></span>
                                            </div>
                                            <div class="flex-item">
                                                <p><?php echo e($lng->Tax); ?></p>
                                                <span>৳<?php echo e(App\Model\Product::currencyPriceRate(Cart::tax())); ?></span>
                                            </div>
                                            <div class="flex-item">
                                                <p class="mb-md-0"><?php echo e($lng->SubTotal); ?></p>
                                                <span>৳<?php echo e(App\Model\Product::currencyPriceRate(Cart::subtotal())); ?></span>
                                            </div>
                                            <div class="sm-grand-total">
                                                <div class="grand-total">
                                                    <p class="mb-0"><?php echo e($lng->GrandTotal); ?></p>
                                                    <span
                                                        class="total-price">৳<?php echo e(App\Model\Product::currencyPriceRate(Cart::total())); ?></span>
                                                </div>
                                                
                                                <button class="btn-checkout default-btn">Process Order</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 lg-grand-total pr-10">
                                        <div class="grand-total">
                                            <p class="mb-4"><?php echo e($lng->GrandTotal); ?></p>
                                            <span
                                                class="total-price">৳<?php echo e(App\Model\Product::currencyPriceRate(Cart::total())); ?></span>
                                        </div>
                                        <button class="default-btn btn-checkout">Process Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>       
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageScripts'); ?>
    <script src="<?php echo e(asset('assets/admin/js/vendor/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front/js/page/checkout.js')); ?>"></script>
    <script src="<?php echo e(asset('front/js/vendor/stripe.min.js')); ?>"></script>
    <script>
       
        function changeAddress(id){
            if(id){
                $("#my-address").load("<?php echo e(URL::to('load-address')); ?>/"+id);
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/front/checkout.blade.php ENDPATH**/ ?>