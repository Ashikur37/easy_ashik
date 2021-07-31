<?php $__env->startSection('title', "Edit Campaign"); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">Edit Campaign</a>
    </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/admin')); ?>/css/vendor/select2.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('assets/admin')); ?>/css/vendor/flatpickr.css">
  <link rel="stylesheet" href="<?php echo e(asset('assets/admin')); ?>/css/vendor/dropzone.css"/> 
  <script src="<?php echo e(asset('assets/admin/js/vendor/dropzone.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <form method="post" action="<?php echo e(route('campaign.update',$campaign->id)); ?>"  >
            <?php echo method_field('patch'); ?>
           <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-12">
                    <div class="flex-item top-info-header">
                        <div>
                            <a href="<?php echo e(route('campaign.index')); ?>" class="list-btn"><?php echo e($lng->SeeList); ?></a>
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
                        <label ><?php echo e($lng->Title); ?> </label>
                        <input required value="<?php echo e($campaign->title); ?>" name="title" type="text" class="form-control" placeholder="<?php echo e($lng->Title); ?>">
                        <?php $__errorArgs = ['title'];
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
                        <label ><?php echo e($lng->Image); ?> </label>
                        <div id="imageUpload" class="dropzone"></div>
                        <input value="<?php echo e($campaign->image); ?>" type="hidden" name="image" id="image">
                        <?php $__errorArgs = ['image'];
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
            <?php $__currentLoopData = $campaign->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaignProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group permission-wrapper d-none">
                        <label ><?php echo e($lng->Product); ?> </label>
                        <select required  name="product[]" class="select2 select2-wide" data-placeholder="<?php echo e($lng->SelectProducts); ?>"  >
                            <option value=""><?php echo e($lng->SelectProducts); ?></option>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php echo e($campaignProduct->product_id==$product->id?'selected':''); ?> value="<?php echo e($product->id); ?>">#<?php echo e($product->id); ?> <?php echo e($product->name); ?> --<?php echo e($product->getSpecialPriceCurrency()); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"  >
                        <label ><?php echo e($lng->Price); ?> </label>
                    <input value="<?php echo e($campaignProduct->price); ?>" required type="number" name="price[]" class="form-control" placeholder="<?php echo e($lng->Price); ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"  >
                        <label ><?php echo e($lng->Quantity); ?> </label>
                        <div class="d-flex">
                            <div class="w-100"><input value="<?php echo e($campaignProduct->qty); ?>" required type="number" name="qty[]" class="form-control" placeholder="<?php echo e($lng->Quantity); ?>"></div>
                            <span class="remove-extra-feature" onclick="removeProductRow(this,<?php echo e($campaignProduct->id); ?>)"><i class="ri-delete-bin-line"></i><span>
                        </div>
                    </div>                
                </div>              
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div id="product-wrapper-html" class="d-none">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group permission-wrapper d-none">
                            <label ><?php echo e($lng->Product); ?> </label>
                            <select require  name="product[]" class="select2 select2-wide" data-placeholder="Select product" placeholder="<?php echo e($lng->Product); ?>">
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($product->id); ?>">#<?php echo e($product->id); ?> <?php echo e($product->name); ?> --<?php echo e($product->getSpecialPriceCurrency()); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"  >
                            <label ><?php echo e($lng->Price); ?> </label>
                            <input require type="number" name="price[]" class="form-control" placeholder="<?php echo e($lng->Price); ?>">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group"  >
                            <label ><?php echo e($lng->Quantity); ?>  </label>
                            <div class="d-flex">
                                <div class="w-100"><input require type="number" name="qty[]" class="form-control" placeholder="<?php echo e($lng->Quantity); ?> "></div>
                                <span class="remove-extra-feature" onclick="removeProductRow(this)"><i class="ri-delete-bin-line"></i></span>
                            </div>
                        </div>  
                    </div>   
                </div>
            </div>
           <div id="product-wrapper">
           </div>
        <button type="button" id="moreProduct" class="add-extra-feature ml-0"><?php echo e($lng->AddMore); ?></button>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/admin/js/vendor/select2.full.min.js')); ?>"></script>
<script>
    Dropzone.autoDiscover = false;
    $(function() {
    var productHTML=document.getElementById("product-wrapper-html").innerHTML.split('require').join('required');
    $("#moreProduct").on('click',function(){
        $("#product-wrapper").append(productHTML);
        $(".permission-wrapper").removeClass("d-none");
        $('.select2').select2();
    });
    $(".permission-wrapper").removeClass("d-none");
    $('.select2').select2();
    var imageDropzone = new Dropzone("div#imageUpload", {
        init: function () {
            this.on("success", function (file, serverFileName) {
                $("#image").val(serverFileName.name)
                    setTimeout(function(){
                        $(".dz-remove").html('<i class="ri-close-line"></i>')
                        $(".dz-details").html("")
                    },500)
            })
            this.on("removedfile", function (file) {
                $.ajax({
                    url: "<?php echo e(route('dropzone.remove', ['path'=>'campaign' ])); ?>",
                    type: "POST",
                    data: {
                        name: $("#image").val(),
                    },
                }).done(function() {
                    $("#image").val("");

                })
            })
        },
          addRemoveLinks: true,
          url: "<?php echo e(route('dropzone.store', ['path'=>'campaign' ])); ?>",
          maxFiles: 1
          });
          let imageFile = { name: "<?php echo e($campaign->image); ?>" };
          imageDropzone.emit("addedfile", imageFile);
          imageDropzone.createThumbnailFromUrl(imageFile, "<?php echo e(URL::to('/')); ?>/images/campaign/<?php echo e($campaign->image); ?>");
          setTimeout(function(){
                    $(".dz-remove").html('<i class="ri-close-line"></i>')
                    $(".dz-details").html("")
            },500)
          imageDropzone.emit("complete",imageFile);

})
function removeProductRow(el,id=null){
    el.parentElement.parentElement.parentElement.parentElement.remove()
    if(id){
        $.get("<?php echo e(URL::to('/admin/remove-campaign-product')); ?>/"+id, function(data, status){
    });
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin',['headerText' => "Edit Campaign"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/admin/campaign/edit.blade.php ENDPATH**/ ?>