<!doctype html>
<html lang="en">
<head>
    <title>
        <?php if (! empty(trim($__env->yieldContent('title')))): ?>
            <?php echo $__env->yieldContent('title'); ?>
            -<?php echo e($setting->title); ?>

        <?php else: ?>
        <?php endif; ?>
    </title>
    <link rel="icon" href="<?php echo e(URL::to('/images/banner/' . $setting->favicon)); ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin')); ?>/css/vendor/vendor-plugin.css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin')); ?>/css/adminmaster.css">
    <?php echo $__env->yieldContent('style'); ?>
</head>
<body>
    <div class="body-overlay"></div>
    <div class="top-section"></div>
    <div class="ts-container">
        <?php echo $__env->make('includes.admin.aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="d-none" id="admin-loader"><img alt="loader" class="loader__image"
                src="<?php echo e(asset('images/banner/' . $setting->admin_loader)); ?>"></div>
        <div class="content-section">
            <div class="content-wrapper">
                <?php echo $__env->make('includes.admin.header',['headerText' => $headerText], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-section">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo e(URL::to('/admin')); ?>"><?php echo e($lng->Dashboard); ?></a>
                                </li>
                                <?php echo $__env->yieldContent('breadcrumb'); ?>
                            </ol>
                        </div>
                    </div>
                </div>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <?php echo $__env->make('includes.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <script src="<?php echo e(asset('assets/admin/js/vendor/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/flatpickr.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/sweetalert.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/promise.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/toastr.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('script'); ?>
    <script>
        $(function() {
          $(".notification-link").on('click',function(){
            redirectUrl=$(this).data("url");
            $.ajax({
              url: "<?php echo e(URL::to('/')); ?>/notification/read/" + $(this).data("id"),
              type: 'GET',
            }).always(function (data) {
                window.location.href=redirectUrl
            })
          });
          <?php if(Session::has('success')): ?>
            toastr.success( "<?php echo e(Session::get('success')); ?>");
          <?php endif; ?>
          <?php if(Session::has('error')): ?>
            toastr.error( "<?php echo e(Session::get('error')); ?>");
          <?php endif; ?>
        })
        var adminUrl = "<?php echo e(URL::to('/admin')); ?>";
        var lng = <?php echo json_encode($lng); ?>;
    </script>
    <script src="<?php echo e(asset('assets/admin/js/adminmaster.js')); ?>"></script>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/layouts/admin.blade.php ENDPATH**/ ?>