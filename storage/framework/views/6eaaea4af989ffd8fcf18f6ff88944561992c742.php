
<div class="modal fade" id="orderTrack">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body p-5">
        <h2 class="mb-4 text-center">Track Order</h2>
        <span class="close modal-close-btn" data-dismiss="modal"><i class="ri-close-line"></i></span>
          <div class="form-group">
            <label for="orderID"><?php echo e($lng->OrderId); ?> *</label>     
            <input type="text" class="form-control" placeholder="Order Id" id="orderID">
          </div>
          <div class="form-group mb-0">
            <button id="order-track-submit" type="button" class="default-btn mt-4 px-4">Submit</button>
          </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="login-modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"> 
     <div class="modal-body p-5">
        <h2 class="mb-4 text-center"><?php echo e($lng->LoginNow); ?></h2>
        <span class="close modal-close-btn" data-dismiss="modal"><i class="ri-close-line"></i></span>
          <div class="form-group">
            <label for="modal-email"><?php echo e($lng->Email); ?> *</label>     
            <input type="text" class="form-control" placeholder="Email" id="modal-email"> 
          </div>
          <div class="form-group">
            <label for="modal-password"><?php echo e($lng->Password); ?> *</label>     
            <input type="password" class="form-control" placeholder="Password" id="modal-password">
          </div>
          <div class="form-group mb-0">
            <button id="modal-login-button" type="button" class="default-btn mt-4 px-4"><?php echo e($lng->Login); ?></button>
          </div>
      </div>
    </div>
  </div>
</div>

<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row text-center text-sm-left">
                <div class="col-lg-3 col-sm-6 col-12 mt-5 mt-sm-0 ">
                <h4><?php echo e($lng->Contact); ?></h4>
                    <div class="contact-info"> 
                    <span><?php echo e($setting->address); ?></span>
                    <span><?php echo e($setting->contact); ?></span>
                        <span><?php echo e($setting->mail); ?></span>
                    </div>
                    <div class="mt-lg-3 social-links">
                      <?php if($setting->facebook_link): ?>
                      <a aria-label="facebook" rel="noreferrer" href="<?php echo e($setting->facebook_link); ?>" target="_blank" class="facebook"><i class="ri-facebook-box-fill"></i></a>
                      <?php endif; ?>
                      <?php if($setting->skype_link): ?>
                      <a aria-label="twitter" rel="noreferrer" href="<?php echo e($setting->skype_link); ?>" target="_blank" class="twitter"><i class="ri-twitter-fill"></i></a>
                      <?php endif; ?>
                      <?php if($setting->instagram_link): ?>
                      <a aria-label="instagram" rel="noreferrer" href="<?php echo e($setting->instagram_link); ?>" target="_blank" class="instagram"><i class="ri-instagram-fill"></i></a>
                      <?php endif; ?>
                      <?php if($setting->pinterest_link): ?>
                      <a aria-label="pinterest" rel="noreferrer" href="<?php echo e($setting->pinterest_link); ?>" target="_blank" class="google-plus"><i class="ri-pinterest-fill"></i></a>
                      <?php endif; ?>
                      <?php if($setting->youtube_link): ?>
                      <a aria-label="youtube" rel="noreferrer" href="<?php echo e($setting->youtube_link); ?>" target="_blank" class="linkedin"><i class="ri-youtube-fill"></i></a>
                      <?php endif; ?>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 footer-links mt-5 mt-sm-0 mt-lg-0 ">
                <h4><?php echo e($lng->Information); ?></h4>
                    <ul>
                        <li><a href="<?php echo e(URL::to('/blog')); ?>"><?php echo e($lng->Blog); ?></a></li>
                        <li><a href="<?php echo e(URL::to('/faq')); ?>"><?php echo e($lng->FAQ); ?></a></li>
                        <li><a href="<?php echo e(URL::to('/about-us')); ?>"><?php echo e($lng->AboutUs); ?></a></li>
                        <li><a href="<?php echo e(URL::to('/contact')); ?>"><?php echo e($lng->ContactUs); ?></a></li>
                        <li><a href="<?php echo e(URL::to('/terms-condition')); ?>"><?php echo e($lng->TermsAndCondition); ?></a></li>
                        <?php $__currentLoopData = $showPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(URL::to('/page/'.$page->slug)); ?>"><?php echo e($page->name); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 footer-links mt-5 mt-sm-3 mt-md-0 mt-lg-0 pt-sm-4 pt-lg-0">
                    <h4><?php echo e($lng->Account); ?> </h4>
                    <ul>
                        <li><a href="<?php echo e(route('user.home')); ?>"><?php echo e($lng->MyProfile); ?></a></li>
                        <li><a href="<?php echo e(route('user.wishlist')); ?>"><?php echo e($lng->MyWishList); ?></a></li> 
                        <li><a href="<?php echo e(route('user.order')); ?>"><?php echo e($lng->MyOrder); ?></a></li>
                        <li><a href="<?php echo e(route('user.affiliation')); ?>"><?php echo e($lng->Affiliation); ?></a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-5 mt-sm-3 mt-md-0 mt-lg-0 pt-sm-4 pt-lg-0">
                    <?php if($setting->is_newsletter): ?>
                    <h4><?php echo e($lng->SignUpNewsleter); ?> </h4>
                    <div class="my-4 newsletter-form">
                        <input id="subscribe_email" type="text" class="form-control" placeholder="Your email address">
                    <button id="subscribe-btn" class="subscribe-btn"><?php echo e($lng->Subscribe); ?></button>  
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
       <div class="container">
       <div class="row">       
           <div class="col-sm-6 col-12 text-center text-sm-left">
            <div class="copyright"> 
            <p class="mb-0">
                <?php if($setting->copyright_text): ?>
                &copy; <?php echo e($setting->copyright_text); ?>

                <?php endif; ?>
            </p>
            </div>
           </div>
           <div class="col-sm-6 col-12 text-center text-sm-left text-lg-right mt-4 mt-sm-0">
            <div class="footer-logo">
                <div class="payment-method">                                        
                    <img  src="<?php echo e(asset('images/banner/'.$setting->payment_image)); ?>">
              </div> 
            </div>           
           </div>
       </div>
       </div>
    </div>
</footer>
<div class="body-overlay"></div>
<?php if($setting->is_cookie): ?>
<?php echo $__env->make('cookieConsent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/includes/front/footer.blade.php ENDPATH**/ ?>