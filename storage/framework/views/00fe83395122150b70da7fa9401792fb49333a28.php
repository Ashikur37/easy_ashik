<?php $__env->startSection('title', "Edit Shop"); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin')); ?>/css/vendor/dropzone.css" />
    <script src="<?php echo e(asset('assets/admin/js/vendor/dropzone.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin')); ?>/css/vendor/select2.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">Edit Shop</a>
    </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <form method="post" action="<?php echo e(route('shop.update', $shop->id)); ?>" onsubmit="return validateForm()">
            <?php echo csrf_field(); ?>
            <?php echo method_field('patch'); ?>
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="<?php echo e(route('shop.index')); ?>" class="list-btn"><?php echo e($lng->SeeList); ?></a>
                        </div>
                        <div>
                            <input type="submit" value="<?php echo e($lng->Save); ?>" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><?php echo e($lng->Name); ?> <span>*</span></label>
                        <input value="<?php echo e($shop->name); ?>" name="name" required type="text" class="form-control"
                            placeholder="<?php echo e($lng->Name); ?>">
                        <?php $__errorArgs = ['name'];
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
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Phone </label>
                        <input value="<?php echo e($shop->phone); ?>" name="phone" required type="text" class="form-control"
                            placeholder="Enter url">
                        <?php $__errorArgs = ['phone'];
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

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><?php echo e($lng->Status); ?> </label>
                        <select name="is_active" class="select2 form-control">
                            <option <?php echo e($shop->is_active == 1 ? 'selected' : ''); ?> value="1">Enabled</option>
                            <option <?php echo e($shop->is_active == 0 ? 'selected' : ''); ?> value="0"><?php echo e($lng->Disabled); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Location </label>
                        <input value="<?php echo e($shop->location); ?>" name="location" type="text" class="form-control"
                            placeholder="Enter location">
                        <?php $__errorArgs = ['meta_title'];
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for=""><?php echo e($lng->Logo); ?> </label>
                        <div id="logoUpload" class="dropzone">
                        </div>
                        <input value="<?php echo e($shop->image); ?>" type="hidden" name="image" id="logo">
                        <span  id="logoError" class="invalid-feedback d-none" role="alert">
                            <strong>Image<?php echo e($lng->Required); ?></strong>
                        </span>
                    </div>
                </div>
              
                
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/admin/js/vendor/select2.full.min.js')); ?>"></script>
    <script>
        function validateForm() {
            if (!$("#logo").val()) {
                $("#logoError").removeClass("d-none")
                return false;
            }
            return true;
        }
        Dropzone.autoDiscover = false;
        $(function() {
            $('.select2').select2({
                minimumResultsForSearch: -1
            });
            window.logoDropzone = new Dropzone("div#logoUpload", {
                init: function() {
                    this.on("success", function(file, serverFileName) {
                        $("#logo").val(serverFileName.name)
                    })
                    this.on("removedfile", function(file) {
                        $.ajax({
                            url: "<?php echo e(route('dropzone.remove', ['path' => 'shop'])); ?>",
                            type: "POST",
                            data: {
                                name: $("#logo").val(),
                            },
                        }).done(function() {
                            $("#logo").val("");
                        })
                    })
                },
                addRemoveLinks: true,
                url: "<?php echo e(route('dropzone.store', ['path' => 'shop'])); ?>",
                maxFiles: 1
            });
            let logoFile = {
                name: "<?php echo e($shop->image); ?>"
            };
            logoDropzone.emit("addedfile", logoFile);
            logoDropzone.createThumbnailFromUrl(logoFile, "<?php echo e(URL::to('/')); ?>/images/shop/<?php echo e($shop->image); ?>");
            logoDropzone.emit("complete", logoFile);

           
            setTimeout(function() {
                $(".dz-remove").html('<i class="ri-close-line"></i>')
                $(".dz-details").html("")
            }, 500)
        })

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin',['headerText' => "Edit Shop"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/admin/shop/edit.blade.php ENDPATH**/ ?>