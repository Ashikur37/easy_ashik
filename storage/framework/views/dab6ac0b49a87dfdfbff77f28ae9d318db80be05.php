<?php $__env->startSection('title', $lng->Order); ?>
<?php $__env->startSection('content'); ?>
<div class="single__order__page">
    <div class="main-content-wrapper order-details">
        <h4 class="section-title">
            <?php echo e($lng->OrderDetails); ?>

            <a href="<?php echo e(route('user.order.print',$order->order_number)); ?>" target="_blank">
                <i class="ri-printer-fill"></i>
            </a>
        </h4>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-6">
                    <div class="content-title">
                        <?php echo e($lng->OrderInfo); ?>

                    </div>
                    <div class="info-row">
                        <div class="info-label"><?php echo e($lng->OrderId); ?></div>
                        <div class="info-value"><?php echo e($order->order_number); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><?php echo e($lng->Date); ?></div>
                        <div class="info-value">
                            <?php echo e($order->created_at->format("d M Y, h:i a")); ?>

                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><?php echo e($lng->Status); ?></div>
                        <span class="status-badge <?php echo e($order->statusClass()); ?>"><?php echo e($order->statusText()); ?></span>
                    </div>
                    <?php if($order->coupon): ?>
                    <div class="info-row">
                        <div class="info-label"><?php echo e($lng->Coupon); ?></div>
                        <div class="info-value coupon-code"><?php echo e($order->coupon->code); ?></div>
                    </div>
                    <?php endif; ?>
                    <div class="info-row">
                        <div class="info-label"><?php echo e($lng->PaymentMethod); ?></div>
                        <div class="info-value"><?php echo e($order->payment_method); ?>

                            <?php $__currentLoopData = $order->additionals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <?php echo e($additional->paymentGatewayAdditional->title); ?> <?php echo e($additional->value); ?>

                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><?php echo e($lng->PaymentStatus); ?></div>
                        <div class="info-value <?php echo e($order->paymentStatusClass()); ?>"><?php echo e($order->paymentStatusText()); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><?php echo e($lng->ShippingMethod); ?></div>
                        <div class="info-value"><?php echo e($order->shipping_method); ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-title">
                        <?php echo e($lng->Summary); ?>

                    </div>
                    <div class="info-row">
                        <div class="info-label"><?php echo e($lng->Discount); ?></div>
                        <div class="info-value">৳<?php echo e(App\Model\Product::currencyPriceRate($order->discount)); ?></div>
                    </div>
                  
                     <div class="info-row">
                        <div class="info-label">Cashback</div>
                        <div class="info-value">৳<?php echo e(App\Model\Product::currencyPriceRate($order->cashback)); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><?php echo e($lng->SubTotal); ?></div>
                        <div class="info-value">৳<?php echo e(App\Model\Product::currencyPriceRate($order->total)); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><?php echo e($lng->Shipping); ?></div>
                        <div class="info-value">৳<?php echo e(App\Model\Product::currencyPriceRate($order->shipping_cost)); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><?php echo e($lng->GrandTotal); ?></div>
                        <div class="info-value grand-total">৳<?php echo e(App\Model\Product::currencyPriceRate($order->total)); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Paid Amount</div>
                        <div class="info-value"><?php echo e($order->paid_amount); ?></div>
                    </div>
                    <div class="info-row">
                      
                        
                        <?php if( $order->paid_amount<$order->total && $order->payment_method!="Cash On Delivery"): ?>
                                <button onclick="" class="btn btn-info" id="pay-btn">Pay Now</button>
                        <?php endif; ?>
                        <?php if($order->is_cod==1&& $order->paid_amount==0&&$order->payment_method!="Cash On Delivery"): ?>
                         <a href="<?php echo e(URL::to('/user/order/cash-on-delivery/'.$order->id)); ?>" style="margin-left:20px;color:white"  class="btn btn-primary" >Cash On Delivery</a>
                        <?php endif; ?>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Due Amount</div>
                        <div class="info-value">৳<?php echo e($order->total-$order->paid_amount); ?></div>
                    </div>
                    
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="content-title">
                        <?php echo e($lng->BillingAddress); ?>

                    </div>
                    <div class="address-info-row">
                        <div class="info-label"><?php echo e($order->billing_first_name); ?></div>
                        <div class="info-label"><?php echo e($order->customer_phone); ?></div>
                        <div class="info-label"><?php echo e($order->billing_address_1); ?></div>
                    </div>
                </div>
            </div>
            <?php if($order->note): ?>
            <div class="row">
                <div class="col-12">
                    <div class="content-title">
                        <?php echo e($lng->OrderNote); ?>

                    </div>
                    <div class="info-row order-note">
                        <div class="info-label">
                            <?php echo e($order->note); ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="product-info-table border-top p-10 mt-25">
        <table class="table product-table mb-0">
            <thead>
                <tr>
                    <th scope="col"><?php echo e($lng->Product); ?></th>
                    <th scope="col"><?php echo e($lng->Price); ?></th>
                    <th scope="col"><?php echo e($lng->Quantity); ?></th>
                    <th scope="col"><?php echo e($lng->Total); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <div class="product-img-name">
                            <img src="<?php echo e(asset('images/product/')); ?>/<?php echo e($item->options->image); ?>" class="product-img" alt="product-image">
                            <p class="mb-0">
                                <?php echo e(Str::limit($item->name,50)); ?>

                                <span class="product-attribute">
                                    <?php echo $item->options->size?"<span> $lng->Size : ".$item->options->size.'</span>':''; ?>

                                    <?php echo $item->options->color?"<span> $lng->Color : ".$item->options->colorName.'</span>': ''; ?>

                                    <?php $__currentLoopData = $item->options->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span><?php echo e($key); ?>: <?php echo e($value); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </span>                                    
                            </p>
                        </div>
                    </td>
                    <td><span>৳<?php echo e(App\Model\Product::currencyPriceRate($item->price)); ?></span></td>
                    <td><span><?php echo e($item->qty); ?></span></td>
                    <td><span>৳<?php echo e(App\Model\Product::currencyPriceRate($item->subtotal)); ?></span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="product-table-md">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="md-product-row">
                <div class="product-img">
                    <img src="<?php echo e(asset('images/product/')); ?>/<?php echo e($item->options->image); ?>"alt="product-image">
                </div>
                <div class="product-desc">
                    <div class="name-qnt">
                        <p class="mb-0">
                            <?php echo e(Str::limit($item->name,50)); ?>                                   
                        </p>
                        <span class="qnt">x <?php echo e($item->qty); ?></span>
                    </div>
                    <div class="product-price">
                        <span>৳<?php echo e(App\Model\Product::currencyPriceRate($item->price)); ?></span>
                        <span>৳<?php echo e(App\Model\Product::currencyPriceRate($item->subtotal)); ?></span>
                    </div>
                    <div class="product-attributes">
                        <?php echo $item->options->size?'<span> $lng->Size :'.$item->options->size.'</span>':''; ?>

                        <?php echo $item->options->size?'<span> $lng->Color :'.$item->options->color.'</span>':''; ?>

                        <?php $__currentLoopData = $item->options->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span><?php echo e($key); ?>:<?php echo e($value); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="order-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content"> 
       <div class="modal-body p-5">
          <h2 class="mb-4 text-center">Pay Now</h2>
          <span class="close modal-close-btn" data-dismiss="modal"><i class="ri-close-line"></i></span>
          <form method="post" action="<?php echo e(URL::to('/user/order/partial-payment/'.$order->id)); ?>">
            <div class="form-group">
              <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="subject">Amount *</label>
                <input value="<?php echo e($order->total-$order->paid_amount); ?>" required placeholder="Amount" type="text" class="form-control" name="amount">
            </div>
        
            <div class="form-group mb-0">    
                <button  class="default-btn px-4 mt-4"><?php echo e($lng->Submit); ?></button>          
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('pageScripts'); ?>
<script>
  $(function () {
    $("#pay-btn").on('click', function() {
      $('#order-modal').modal('show');
      return;
    });
  });
    </script>


    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/user/order/show.blade.php ENDPATH**/ ?>