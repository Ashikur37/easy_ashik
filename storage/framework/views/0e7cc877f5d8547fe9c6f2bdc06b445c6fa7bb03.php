<!doctype html>
<html lang="en">
<head>
    <title>
        <?php if (! empty(trim($__env->yieldContent('title')))): ?>
<?php echo $__env->yieldContent('title'); ?>-<?php echo e($setting->title); ?>

<?php else: ?>
        <?php echo e($setting->title); ?>

<?php endif; ?>
    </title>
    <link rel="icon" href="<?php echo e(URL::to('/images/banner/' . $setting->favicon)); ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<?php if (empty(trim($__env->yieldContent('meta')))): ?>
    <meta name="keywords" content="<?php echo e($setting->meta_title); ?>">
    <meta name="description" content="<?php echo e($setting->meta_description); ?>">
    <meta property="og:title" content="<?php echo e($setting->meta_title); ?>" />
    <meta property="og:description" content="<?php echo e($setting->meta_description); ?>" />
    <meta property="og:image" content="<?php echo e(URL::to('/images/banner/' . $setting->header_logo)); ?>" />
<?php endif; ?>
<?php echo $__env->yieldContent('meta'); ?>
    
    <link rel="stylesheet" href="<?php echo e(asset('front/css/vendor/vendor-plugin.css')); ?>" />  
<?php echo $__env->yieldContent('pageStyle'); ?>
<link rel="stylesheet" href="<?php echo e(asset('front/css/core.css')); ?>" />
    <?php echo $setting->custom_css; ?>

    <?php if($setting->is_pixel): ?>
    <?php echo $setting->facebook_pixel; ?>

    <?php endif; ?>
</head>
<body style="--dynamic-color:<?php echo e($setting->theme_color); ?>">
<?php echo $__env->make('includes.front.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="d-none" id="site-loader">
        <img alt="loader" class="loader__image" src="<?php echo e(asset('images/banner/' . $setting->site_loader)); ?>">
    </div>
    <?php echo $__env->yieldContent('content'); ?>
    <!--top scroll button   -->
    <a id="back-to-top"><i class="ri-arrow-up-s-line"></i></a>
    <?php echo $__env->make('includes.front.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="product-cart-status" id="aside-cart">
        <?php echo $__env->make('includes.front.cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    
    <script src="<?php echo e(asset('front/js/vendor/jquery.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('pageScripts'); ?>
    <script src="<?php echo e(asset('front/js/vendor/plugins.js')); ?>"></script>
    <script src="<?php echo e(asset('front/js/core.js')); ?>"></script>
    <script>
        var mainUrl = "<?php echo e(URL::to('/')); ?>";
        var lng = <?php echo json_encode($lng); ?>

        var loggedIn = "<?php echo e(auth()->check()); ?>";
        $(function () {
            $(".theme-color").on('click',function(){
               $(document.body).css("--dynamic-color",$(this).val())
            })
            $("#favcolor").on('input',function(){
                $(document.body).css("--dynamic-color",$(this).val())
            })
            <?php if(Session::has('success')): ?>     
            toastr.success('<?php echo e(Session::get('success')); ?>')
            <?php endif; ?>
            <?php if(Session::has('error')): ?>
            toastr.error('<?php echo e(Session::get('error')); ?>')
            <?php endif; ?>
        }) 
    </script>
    
    <?php if($setting->is_messenger): ?>
        <?php echo $setting->messenger; ?>

    <?php endif; ?>

    <?php if($setting->is_tawk_to): ?>
        <?php echo $setting->tawk_to; ?>

    <?php endif; ?>

    <?php if($setting->is_analytic): ?>
        <?php echo $setting->google_analytic; ?>

    <?php endif; ?>
    <?php echo $setting->custom_js; ?>

    
    <script>
    var btn = $('#back-to-top');
    $(window).scroll(function() {
      if ($(window).scrollTop() > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });
    
    btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop:0}, '300');
    });
    </script>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/layouts/front.blade.php ENDPATH**/ ?>