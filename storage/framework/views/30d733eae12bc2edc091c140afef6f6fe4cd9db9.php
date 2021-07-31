<?php $__env->startSection('title', "$lng->AdminLogin"); ?>
<?php $__env->startSection('pageStyle'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/page/login.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="login__page ">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="login-box white-bg">
                        <div class="row">
                            <div class="col-12 px-4">
                                <div class="email-login-box">
                                    <div class="title"><?php echo e($lng->Login); ?></div>
                                    <form method="POST" action="<?php echo e(route('login')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="email"><?php echo e($lng->Email); ?> *</label>
                                            <input required name="email" type="email" <?php if(Session::has('old_email')): ?> value="<?php echo e(Session::get('old_email')); ?>" <?php endif; ?> class="form-control" id="email"
                                                placeholder="<?php echo e($lng->Email); ?>" />
                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="password"><?php echo e($lng->Password); ?> *</label>
                                            <div class="show-password-wrap position-r">
                                            <input required name="password" type="password" class="form-control"
                                                id="password" placeholder="<?php echo e($lng->Password); ?>" />
                                        <span> 
                                           <i class="ri-eye-line" onclick="showPass()"></i>
                                       </span>
                                       </div>
                                        <script >
                                           function showPass(){
                                               if(document.getElementById("password").type=="password"){
                                                   document.getElementById("password").type="text";
                                                   
                                               }
                                               else{
                                                   document.getElementById("password").type="password";
                                                   
                                               }
                                               
                                           }
                                        </script>
                                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <?php if(Session::has('error')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(Session::get('error')); ?>

                                            </div>
                                        <?php endif; ?>
                                        <div class="forget-password-row">
                                            <div class="form-group custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember">
                                                    <span class="box"></span>
                                                    <?php echo e($lng->RememberMe); ?>

                                                </label>
                                            </div>
                                            <div class="forget">
                                                <a class="forget__link"
                                                    href="<?php echo e(URL::to('password/reset')); ?>"><?php echo e($lng->ForgotPassword); ?> ?</a>
                                            </div>
                                        </div>
                                        <input class="default-btn login__btn" type="submit" value="Login" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/admin/login.blade.php ENDPATH**/ ?>