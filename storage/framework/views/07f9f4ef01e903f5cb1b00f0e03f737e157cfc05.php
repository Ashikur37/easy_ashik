<?php $__env->startSection('title', "$product->name"); ?>
<?php $__env->startSection('meta'); ?>
<meta name="title" content="<?php echo e($product->meta_title); ?>">
<meta name="description" content="<?php echo e($product->meta_description); ?>">
<meta property="og:title"  content="<?php echo e($product->meta_title); ?>" />
<meta property="og:description" content="<?php echo e(html_entity_decode(Str::limit(trim(strip_tags($product->details)),180,'.'))); ?>" />
<meta property="og:image"  content="<?php echo e(asset('images/product/'.$product->image)); ?>" data-zoom="<?php echo e(asset('images/product/'.$product->image)); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageStyle'); ?>
<link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/vendor/slick.min.css">
<link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/page/product.css">
<style>

.ticket {
  position: fixed;
  right: 0%;
  bottom: 0%;
  width: 370px;
  height: 380px;
  border-radius: 4px;
  background-color: #fff;
  -webkit-box-shadow: 0 30px 48px rgba(50, 54, 70, 0.30);
          box-shadow: 0 30px 48px rgba(50, 54, 70, 0.30);
  z-index: 999;
  display: none;
}

.ticket-header {
  padding-left: 23px;
  background-color: #fff;
  font-size: 15px;
  line-height: 44px;
  text-transform: uppercase;
  width: 100%;
  height: 43px;
  color: #0088ff;
  -webkit-box-shadow: 0px 5px 5px #2946780f;
          box-shadow: 0px 5px 5px #2946780f;
  border-top-left-radius: 4px;
  border-top-right-radius: 4px;
}

.ticket-closer {
  position: absolute;
  top: 8px;
  right: 12px;
  font-size: 18px;
  color: #4e4e4e;
  opacity: .8;
  cursor: pointer;
}

.ticket-closer:hover {
  color: #db2c2c;
}

.ticket-body {
  position: absolute;
  left: 0;
  right: 0;
  top: 44px;
  bottom: 82px;
  overflow-y: auto;
  padding: 20px 25px 20px 25px;
  background-color: #fff;
}

li.message-left,
li.message-right {
  position: relative;
}

li.message-left>.message-avatar {
  float: left;
  width: 40px;
}

li.message-right>.message-avatar {
  float: right;
  width: 40px;
}

.avatar {
  font-size: 22px;
  width: 40px;
  height: 40px;
  line-height: 40px;
  text-align: center;
  overflow: hidden;
  border-radius: 20px;
}

li.message-left .avatar {
  color: #0088ff95;
  background-color: #0088ff40;
}

li.message-right .avatar {
  color: #777;
  background-color: #DFE2E6;
}

.name {
  font-size: 10px;
  color: #7d7a7a;
  text-align: center;
}

.message-text {
  font-size: 14px;
  max-width: calc(100% - 60px);
  padding: 12px;
  border-radius: 4px;
  background-color: #F1F3F6;
  line-height: 1.1;
  color: #4e4e4e;
}

li.message-left>.message-text {
  text-align: left;
  margin-left: 60px;
}

li.message-right>.message-text {
  text-align: right;
}

.message-text:before {
  content: ' ';
  position: absolute;
  width: 0;
  height: 0;
  top: 10px;
  border: 8px solid;
}

li.message-left>.message-text:before {
  left: 44px;
  border-color: transparent #F1F3F6 transparent transparent;
}

li.message-right>.message-text:before {
  right: 45px;
  border-color: transparent transparent transparent #F1F3F6;
}

.attachment>a {
  width: 50px;
  height: 50px;
  display: inline-block;
  margin-top: 10px;
  border-radius: 4px;
  overflow: hidden;
}

.attachment img {
  width: 100%;
  height: 100%;
}

li.message-right>.attachment {
  text-align: right;
  margin-right: 60px;
}

li.message-left>.attachment {
  text-align: left;
  margin-left: 60px;
}

.message-hour {
  max-width: calc(100% - 60px);
  padding: 2px;
  color: #7d7a7a;
  font-size: 10px;
  margin-bottom: 12px;
}

.message-hour>span {
  color: #0088ff;
}

li.message-left>.message-hour {
  text-align: left;
  margin-left: 60px;
}

li.message-right>.message-hour {
  text-align: right;
}

#ticket-form {
  padding: 20px 25px;
  position: absolute;
  left: 0;
  bottom: 0;
  right: 0;
  background: #fff;
  border-top: 1px solid #2946780f;
}

.ticket-form-wrapper {
  height: 42px;
  background-color: #fff;
}

.input-group>.input-group-append>.input-group-text {
  background: #f4f4f4;
  border: 1px solid #eaeaea;
  border-left: medium;
  cursor: pointer;
}

.ticket-form-wrapper .input-group .form-control {
  border: 1px solid #eaeaea;
  border-right: medium;
}

.ticket-form-wrapper .input-group .form-control:focus {
  border: 1px solid #eaeaea;
  border-right: medium;
}

.ticket-form-wrapper #submit-btn {
  background: #0088ff;
  color: #fff;
  cursor: pointer;
}

@media(max-width:575px) {
  .ticket {
      width: calc(100% - 30px);
      height: calc(100% - 85px);
      margin-right: 15px;
  }
}

</style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="product-page white-bg"> 
    <div class="container">
        <div class="row"> 
            <div class="col-12">
                <div class="row mt-40">
                    <div class="col-md-4 col-sm-8 offset-sm-2 offset-md-0">
                        <div class="gallery">
                            <div class="slickbox-border">
                                <div class="product-image-slider">
                                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="product-image image-zoom" data-src="<?php echo e(asset('images/product/'.$image->image)); ?>">
                                            <img src="<?php echo e(asset('images/product/'.$image->image)); ?>" alt="product-image" />
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                     
                                </div>             
                            </div> 
                            <div class="product-thumbs">
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="product-thumbs-item">
                                        <img src="<?php echo e(asset('images/product/'.$image->image)); ?>" alt="product-thumbs" />                  
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="product-details-wrapper">
                        <div class="brand-stock_status">
                                <?php if($product->inStock()): ?>
                                <span class="in-stock"><i class="ri-checkbox-circle-fill"></i><?php echo e($lng->InStock); ?></span>
                                <?php else: ?>
                                <span class="out-of-stock"><i class="ri-close-circle-fill"></i><?php echo e($lng->OutOfStock); ?></span>
                                <?php endif; ?>
                            <span class="brand-name"><?php echo e($product->brand?$product->brand->name:''); ?></span>
                        </div>
                            <div class="product-name-rating">
                                <span class="product-name">
                                    <?php echo e($product->name); ?>

                                </span>
                                <div class="rating-container">
                                    <div class="ratings">
                                        <div class="empty-stars"></div>
                                        <div class="full-stars" style="width:<?php echo e($rating*20); ?>%"></div> 
                                    </div>
                                    <span>( <?php echo e($product->reviews->count()); ?> )</span>
                                </div> 
                            </div>
                            <div class="product-price">
                                <span id="product-price" class="new-price"> ৳<?php echo e(App\Model\Product::currencyPrice($product->price)); ?></span>
                                <?php if($product->price!=$product->actualPrice()): ?>
                                <span class="old-price">৳<?php echo e(App\Model\Product::currencyPrice($product->actualPrice())); ?> </span>
                                <?php endif; ?>
                            </div>
                            <div class='product-short-desc'>
                                <p><?php echo e(html_entity_decode(Str::limit(trim(strip_tags($product->details)),180,'.'))); ?></p>
                            </div>
                            <div class="color-wrapper">
                                <?php if($product->productColors->count()>0): ?>
                                <div class="color-title"><?php echo e($lng->Color); ?></div>
                                <div class="color-options">
                                    <?php $__currentLoopData = $product->productColors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="color-item" style="background-color:<?php echo e($color->code); ?>">
                                        <input class="product-variant color-product" data-val="<?php echo e($color->id); ?>" type="radio" name="color">
                                        <i class="checked-icon"></i>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php if($product->productSizes->count()>0): ?>
                            <div class="size-wrapper">
                                <div class="size-title"><?php echo e($lng->Size); ?></div>
                                <?php $__currentLoopData = $product->sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label>
                                    <input data-val="<?php echo e($size->size->id); ?>" class="product-variant size-product" type="radio" name="size" />
                                    <?php echo e($size->size->name); ?>

                                    <?php if($size->price>0): ?>
                                    &nbsp;+ <b>৳<?php echo e(App\Model\Product::currencyPriceRate($size->price)); ?></b>
                                    <?php endif; ?>
                                </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endif; ?>
                            <?php $__currentLoopData = $product->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="size-wrapper">
                                <div class="size-title"><?php echo e($option->option->name); ?></div>
                                <?php $__currentLoopData = $option->option->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label>
                                    <input <?php echo e($loop->first&&$option->option->required?'checked':''); ?> class="product-variant option-input" data-id="<?php echo e($option->option_id); ?>" data-val="<?php echo e($value->id); ?>" type="radio" name="option[<?php echo e($option->option_id); ?>]" />
                                    <?php echo e($value->label); ?> &nbsp;+ <b>৳<?php echo e(App\Model\Product::currencyPriceRate($value->price)); ?></b>
                                </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="cart-buy-btn">
                                <?php if($product->inStock()): ?>
                                <button data-url="<?php echo e(route('cart.add')); ?>" data-id="<?php echo e($product->id); ?>" id="add__cart" class="add__cart"><?php echo e($lng->AddToCart); ?></button>
                                <?php else: ?>
                                <button class="add__cart"><?php echo e($lng->SoldOut); ?></button>
                                <?php endif; ?>
                                <button data-url="<?php echo e(route('cart.add')); ?>" data-id="<?php echo e($product->id); ?>" class="buy-btn"><?php echo e($lng->BuyNow); ?></button>
                            </div>
                            <hr>
                            <div class="wishlist-favourite-action">
                                <div data-url="<?php echo e(route('wishlist.add')); ?>" class="add__wishlist fav <?php echo e(in_array($product->id,$wishProducts)?'active':''); ?>" data-id="<?php echo e($product->id); ?>"><i class="ri-heart-line"></i>wishlist</div>
                                <div class="add-to-compare" data-url="<?php echo e(route('compare.add')); ?>" class="add-to-compare" data-id="<?php echo e($product->id); ?>">
                                    <i class="ri-shuffle-line"></i>compare</div>
                            </div>           
                            <div class="aditional-infos-row">
                                <div class="info-title">categories</div>
                                <div class="info-item">
                                    <a href="<?php echo e(route('category',$product->category->slug)); ?>" class="item"><?php echo e($product->category->name); ?>,</a>
                                    <?php if($product->sub_category_id): ?>
                                    <a href="<?php echo e(route('category',[$product->category->slug,$product->subCategory->slug])); ?>" class="item"><?php echo e($product->subCategory->name); ?>,</a>
                                    <?php endif; ?>
                                    <?php if($product->child_category_id): ?>
                                    <a href="<?php echo e(route('category',[$product->category->slug,$product->subCategory->slug,$product->childCategory->slug])); ?>" class="item"><?php echo e($product->childCategory->name); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if($product->productTags->count()>0): ?>
                            <div class="aditional-infos-row">
                                <div class="info-title"><?php echo e($lng->Tags); ?></div>
                                <div class="info-item">
                                    <?php $__currentLoopData = $product->productTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('tag.product',$tag->name)); ?>" class="item"><?php echo e($tag->name); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <?php endif; ?>      
                            <div class="social-share mt-4">
                                <div class="info-title mb-2"><?php echo e($lng->Share); ?></div>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(Request::url()); ?>" target="_blank">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                                <a href="https://wa.me/?text=<?php echo e($product->name); ?> <?php echo e(Request::url()); ?>" target="_blank"><i class="ri-whatsapp-fill"></i></a>
                                <a href="https://twitter.com/share?url=<?php echo e(Request::url()); ?>" target="_blank">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(Request::url()); ?>" target="_blank">
                                    <i class="ri-linkedin-box-fill"></i>
                                </a>
                                <a href="http://www.tumblr.com/share?v=3&amp;u=<?php echo e(Request::url()); ?>" target="_blank">
                                    <i class="ri-tumblr-fill"></i>
                                </a>
                            
                            </div>            
                        </div>
                    </div>
                    <div class="col-3 d-none d-md-block">
                        <div class="text-center p-20 seller-info-wrapper">
                            <h4>Seller Information</h4>
                            <?php if(!$product->user_id): ?>
                            <div class="seller-info">
                                <span class="avater"><img alt="<?php echo e($setting->title); ?>" src="<?php echo e(asset('images/banner/'.$setting->header_logo)); ?>"></span>
                                <span class="seller-name"><?php echo e($setting->title); ?><span class="is-verify"> <img style="width:70px" src="<?php echo e(URL::to('images/verified.png')); ?>"> </span></span>
                            </div> 
                            <?php else: ?>
                            <div class="seller-info">
                                <span class="avater">
                                    <img alt="avatar"
                                    src="<?php echo e($product->user->provider ? $product->user->avatar : asset('images/avatar.png')); ?>" />
                                </span>
                                <span class="seller-name"><?php echo e(\App\Model\Vendor::where('user_id',$product->user_id)->first()->store_name); ?><span class="is-verify"> <img style="width:70px" src="<?php echo e(URL::to('images/verified.png')); ?>">  </span></span>
                            </div>
                            <?php endif; ?>
                            <span class="store-status"><?php echo e(\App\Model\Product::where('user_id',$product->user_id)->count()); ?> items</span>
                            <a href="<?php echo e(route('seller')); ?>?id=<?php echo e($product->user_id); ?>" class="store-btn">Visit Seller Store</a> 
                            <button id="show-chat-btn">Chat</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col"> 
                        <div class="product-desc-container">
                        <div class="desc-tabs">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="desc-tab" data-toggle="tab" href="#desc"><span><?php echo e($lng->Details); ?></span></a>
                                        </li>
                                        <?php if(count($product->attributes)>0): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" id="spec-tab" data-toggle="tab" href="#spec"><span><?php echo e($lng->Spec); ?></span></a>
                                        </li>
                                        <?php endif; ?>
                                        <li class="nav-item">
                                            <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments"><span><?php echo e($lng->Comments); ?></span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews"><span><?php echo e($lng->Reviews); ?></span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="desc">
                                    <div class="content-wrapper">
                                        <?php echo $product->details; ?>

                                    </div>
                                    </div>
                                    <div class="tab-pane" id="spec">
                                        <?php $__currentLoopData = $product->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="specifications">
                                                <span class="label"><?php echo e($attribute->attribute->name); ?></span>
                                                <?php $__currentLoopData = $attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="value"><?php echo e($value->value->value); ?></span>&nbsp;
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <div class="tab-pane" id="comments">
                                        <div class="post-comment">
                                            <div class="section-title">
                                                <span><?php echo e($lng->PostAComment); ?></span>
                                            </div>
                                            <?php if(auth()->guard()->check()): ?>
                                            <form method="post" action="<?php echo e(route('product.comment', $product->id)); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-group">
                                                    <textarea required name="text" cols="100" class="form-control" rows="3" placeholder="Your Comment ..."></textarea>
                                                </div>
                                                <div class="form-group">                                    
                                                    <button class="default-btn submit-btn" type="submit">Post</button>
                                                </div>
                                            </form>
                                            <?php else: ?>                     
                                            <span class="login-comment"><?php echo e($lng->PleaseLoginToComment); ?></span>
                                            <a class="default-btn login-button login-modal"> Login</a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="comments-section">
                                            <div class="comments-header">
                                                <div class="section-title"><span><?php echo e($lng->Comments); ?>(<?php echo e($product->comments->count()); ?>)</span></div>
                                            </div>
                                            <?php $__currentLoopData = $product->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="comment-wrapper"> 
                                                <div class="thumb">
                                                    <img onerror="this.onerror=null;this.src='<?php echo e(asset('images/avatar.png')); ?>'" src="<?php echo e($comment->user->getImageUrl()); ?>" alt="avatar" />
                                                </div>
                                                <div class="comment-details">
                                                    <span class="name"><?php echo e($comment->user->name); ?></span> 
                                                    <p class="comment"><?php echo e($comment->text); ?></p>
                                                    <div class="reply-date">
                                                        <?php if(auth()->guard()->check()): ?>
                                                        <span onclick="showReplyContainer(<?php echo e($comment->id); ?>,this)" class="reply-button"><?php echo e($lng->Reply); ?></span> 
                                                        <?php else: ?>
                                                        <span class="reply-button login-modal"><?php echo e($lng->Reply); ?></span> 
                                                        <?php endif; ?>
                                                        <span class="date-time">&mid; <?php echo e($comment->created_at->diffForHumans()); ?></span>
                                                    </div>                                 
                                                    <div class="reply-container">                               
                                                        <?php if(auth()->guard()->check()): ?>
                                                        <div class="reply-form hide" id="reply-container<?php echo e($comment->id); ?>">
                                                            <form class="mb-3" method="post" action="<?php echo e(route('product.comment.reply', $comment->id)); ?>">
                                                                <?php echo csrf_field(); ?>
                                                                <div class="form-group">
                                                                    <textarea required name="text" cols="100" class="form-control" rows="3" placeholder="Your Reply ..."></textarea>
                                                                </div>
                                                                <button class="default-btn submit-btn">Reply</button>
                                                            </form>
                                                        </div>                             
                                                        <?php endif; ?>
                                                        <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="reply-wrapper">
                                                            <div class="thumb">
                                                                <img onerror="this.onerror=null;this.src='<?php echo e(asset('images/avatar.png')); ?>'" src="<?php echo e($reply->user->getImageUrl()); ?>" alt="avatar" />
                                                            </div>
                                                            <div class="reply-details">
                                                                <span class="name"><?php echo e($reply->user->name); ?></span> 
                                                                <p class="comment"><?php echo e($reply->text); ?></p>
                                                                <span class="date-time"><?php echo e($reply->created_at->diffForHumans()); ?></span>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                       
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="reviews">
                                        <div class="reviews">
                                            <h4 class="review-count"><?php echo e($lng->Reviews); ?>(<?php echo e($product->reviews->count()); ?>)</h4>
                                            <?php $__currentLoopData = $product->reviews->where('is_approved',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="review">
                                                <div class="thumb">
                                                    <img onerror="this.onerror=null;this.src='<?php echo e(asset('images/avatar.png')); ?>'" src="<?php echo e($review->user->getImageUrl()); ?>" alt="avatar" />
                                                </div>
                                                <div class="review-details">
                                                    <div class="name-rating">
                                                        <span class="name"><?php echo e($review->user->name); ?></span>
                                                        <div class="ratings">
                                                            <div class="empty-stars"></div>
                                                            <div class="full-stars" style="width:<?php echo e($review->rating*20); ?>%"></div>
                                                        </div>
                                                    </div>
                                                <div class="review-bg">
                                                        <div class="title-date">
                                                            <span class="title"><?php echo e($review->title); ?></span>
                                                            <span class="date-time"><?php echo e($review->created_at->diffForhumans()); ?></span>
                                                        </div>
                                                        <div class="review-detail">
                                                            <p><?php echo e($review->comment); ?></p>
                                                        </div>
                                                </div>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div class="post-review">
                                                <?php if(auth()->check()): ?>
                                                <?php if($product->canReview()&&!$product->hadReview()): ?>
                                                <span class="section-title"><?php echo e($lng->AddAReview); ?></span>
                                                <?php endif; ?>
                                                <div class="review-form">
                                                    <?php if($product->canReview()): ?>
                                                    <?php if(!$product->hadReview()): ?>
                                                    <form method="post" action="<?php echo e(route('product.review',$product->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <label><?php echo e($lng->ReviewTitle); ?></label>
                                                                    <input type="text" class="form-control" id="review__title" name="title" placeholder="review title" />
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label><?php echo e($lng->Rating); ?> *</label>
                                                                    <div class="custom__input">
                                                                        <div class="rat">
                                                                            <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
                                                                            <label for="star5">☆</label>
                                                                            <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
                                                                            <label for="star4">☆</label>
                                                                            <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
                                                                            <label for="star3">☆</label>
                                                                            <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
                                                                            <label for="star2">☆</label>
                                                                            <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
                                                                            <label for="star1">☆</label>
                                                                            <div class="clear"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Comment"><?php echo e($lng->Comment); ?>*</label>
                                                            <textarea name="comment" cols="100" class="form-control" id="Comment" rows="3"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="default-btn px-3"><?php echo e($lng->Submit); ?></button>
                                                        </div>
                                                    </form>
                                                    <?php endif; ?>
                                                    <?php else: ?>
                                                    <?php echo e($lng->BuyThisProductToReview); ?>

                                                    <?php endif; ?>
                                                </div>
                                                <?php else: ?>
                                                <span class="section-title"><?php echo e($lng->PleaseLoginToAddAReview); ?></span>
                                                <a class="default-btn login-btn login-modal"> <?php echo e($lng->LoginNow); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="row d-md-none mb-4">
                    <div class="col-12">
                        <div class="text-center p-20 seller-info-wrapper">
                            <h4>Seller Information</h4>
                            <?php if(!$product->user_id): ?>
                            <div class="seller-info">
                                <span class="avater"><img alt="<?php echo e($setting->title); ?>" src="<?php echo e(asset('images/banner/'.$setting->header_logo)); ?>"></span>
                                <span class="seller-name"><?php echo e($setting->title); ?><span class="is-verify"> (verified) </span></span>
                            </div> 
                            <?php else: ?>
                            <div class="seller-info">
                                <span class="avater">
                                    <img alt="avatar"
                                    src="<?php echo e($product->user->provider ? $product->user->avatar : asset('images/avatar.png')); ?>" />
                                </span>
                                <span class="seller-name"><?php echo e(\App\Model\Vendor::where('user_id',$product->user_id)->first()->store_name); ?><span class="is-verify"> (verified) </span></span>
                            </div>
                            <?php endif; ?>
                            <span class="store-status"><?php echo e(\App\Model\Product::where('user_id',$product->user_id)->count()); ?> items</span>
                            <a href="<?php echo e(route('category')); ?>?seller=<?php echo e($product->user_id); ?>" class="store-btn">Visit Seller Store</a> 
                            
                        </div>
                    </div>
                </div>
                <div class="related-product-section">
                <h3 class="mt-20"><?php echo e($lng->RelatedProducts); ?></h3> 
                    <div class="row mt-25">
                        <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-4 col-6 mb-30 sm-mb-15 <?php echo e($loop->even?'sm-pl':'sm-pr'); ?>">
                            <div
        class="item-inner cart-item-<?php echo e($relatedProduct->id); ?> <?php echo e(array_key_exists($relatedProduct->id, $cartProducts) ? 'in-cart' : ''); ?>">
        <div class="item-img-badge">
            <a href="<?php echo e(route('front-product.show', $relatedProduct->slug)); ?>" class="item-img">
                <img alt="<?php echo e(Str::limit($relatedProduct->name, 50)); ?>"
                    src="<?php echo e(asset('/')); ?>images/product/<?php echo e($relatedProduct->image); ?>">
            </a>
            <div class="item-badge-wrapper">
                <?php $__currentLoopData = $relatedProduct->productBadges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span style="background-color:<?php echo e($badge->background); ?>;color:<?php echo e($badge->color); ?>;"
                        class="item-badge"><?php echo e($badge->name); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <span class="<?php echo e(in_array($relatedProduct->id, $wishProducts) ? 'active' : ''); ?> add__wishlist ri-heart-fill"
                data-url="<?php echo e(route('wishlist.add')); ?>" data-id="<?php echo e($relatedProduct->id); ?>"></span>
            <?php if(!$relatedProduct->inStock()): ?>
                <span class="stockout-btn"><?php echo e($lng->OutOfStock); ?></span>
            <?php endif; ?>
        </div>
        <div
            class="item-content cart-item-<?php echo e($relatedProduct->id); ?> <?php echo e(array_key_exists($relatedProduct->id, $cartProducts) ? 'in-cart' : ''); ?>">
            <div class="item-price-ratings">
                <div class="item-price">
                    <span class="new-price">৳<?php echo e(App\Model\Product::currencyPrice($relatedProduct->price)); ?></span>
                    <?php if($relatedProduct->actualPrice() != $relatedProduct->price): ?>
                        <span
                            class="old-price">৳<?php echo e(App\Model\Product::currencyPrice($relatedProduct->actualPrice())); ?></span>
                    <?php endif; ?>
                </div>
                <div class="ratings">
                    <div class="empty-stars"></div>
                    <div class="full-stars" style="width:<?php echo e($relatedProduct->rating * 20); ?>%"></div>
                </div>
            </div>
            <div class="item-title">
                <a
                    href="<?php echo e(route('front-product.show', $relatedProduct->slug)); ?>"><?php echo e(Str::limit($relatedProduct->name, 50)); ?></a>
            </div>
            <div
                class="item-action cart-item-<?php echo e($relatedProduct->id); ?> <?php echo e(array_key_exists($relatedProduct->id, $cartProducts) ? 'in-cart' : ''); ?>">
                <ul>
                    <li class="cart-button-wrapper-<?php echo e($relatedProduct->id); ?> <?php if(!(count($relatedProduct->
                        options) == 0 && count($relatedProduct->colors) == 0 && count($relatedProduct->sizes) == 0) ||
                        !$relatedProduct->inStock()): ?> w-100 <?php endif; ?>">
                        <?php if(!$relatedProduct->inStock()): ?>
                            <span class="sold-out-btn"><?php echo e($lng->SoldOut); ?></span>
                        <?php elseif(count($relatedProduct->options)==0&&count($relatedProduct->colors)==0&&count($relatedProduct->sizes)==0): ?>
                            <?php if(array_key_exists($relatedProduct->id, $cartProducts)): ?>
                                <div class="product-count item-count">
                                    <div class="btn-minus" data-id="<?php echo e($relatedProduct->id); ?>"
                                        data-row="<?php echo e($cartProducts[$relatedProduct->id]['rowId']); ?>">
                                        <button aria-label="substract" type="button" class="counter">
                                            <i class="ri-subtract-line"></i>
                                        </button>
                                    </div>
                                    <input type="text" readonly class="counter-field qty-<?php echo e($cartProducts[$relatedProduct->id]['rowId']); ?>"
                                        value="<?php echo e($cartProducts[$relatedProduct->id]['qty']); ?>">
                                    <div class="btn-plus" data-row="<?php echo e($cartProducts[$relatedProduct->id]['rowId']); ?>">
                                        <button aria-label="addition" type="button" class="counter counter-plus">
                                            <i class="ri-add-line"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php else: ?>
                                <span data-url="<?php echo e(route('cart.add')); ?>" data-id="<?php echo e($relatedProduct->id); ?>"
                                    class="add__cart related">
                                    <?php echo e($lng->AddToCart); ?>

                                </span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="see-option-btn">
                                <a
                                    href="<?php echo e(route('front-product.show', $relatedProduct->slug)); ?>"><?php echo e($lng->SeeOptions); ?></a>
                            </span>
                        <?php endif; ?>
                    </li>
                    <?php if(count($relatedProduct->options) == 0 && count($relatedProduct->colors) == 0 && count($relatedProduct->sizes) == 0 && $relatedProduct->inStock()): ?>
                        <li>
                            <?php if(count($relatedProduct->options) == 0 && count($relatedProduct->colors) == 0 && count($relatedProduct->sizes) == 0 && $relatedProduct->inStock()): ?>
                                <span data-url="<?php echo e(route('cart.add')); ?>" data-id="<?php echo e($relatedProduct->id); ?>"
                                    class="buy-btn related">
                                    <a href="#"> <?php echo e($lng->BuyNow); ?></a>
                                </span>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
                                        
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ticket" id="chat-box" >
        
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageScripts'); ?>
<script src="<?php echo e(asset('front/js/vendor/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset('front/js/vendor/jquery-zoom.js')); ?>"></script> 
<script src="<?php echo e(asset('front/js/page/product.js')); ?>"></script> 
<script>
    $(function(){

            
    $("#show-chat-btn").on('click',function() {
        if (!loggedIn) {
            $('#login-modal').modal('show');
            return;
        }
      let id = "<?php echo e($product->id); ?>";
      $("#chat-box").load("<?php echo e(URL::to('/user/get-messages')); ?>/" + id, function() {
        $("#chat-box").css('display', 'block')
        setTimeout(function(){
            $('#ticket-body').scrollTop($('#ticket-body')[0].scrollHeight);
          },300)
      });
    })
    $(document).on('click', '.ticket-closer', {}, function() {
      $("#chat-box").css('display', 'none')
    })

    $(document).on('submit', "form#ticket-form", {}, function(e) { 
      e.preventDefault();
      var formData = new FormData(this);
      showLoader()
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: $(this).attr("action"),
        type: 'POST',
        data: formData,
        success: function(data) {
          $("#chat-box").html(data);
          setTimeout(function(){
            $('#ticket-body').scrollTop($('#ticket-body')[0].scrollHeight);
          },300)
          hideLoader()
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });


    
    })
        function updatePrice() {
            let size = "";
            let color = "";
            let optionIds = [];
            let optionValues = [];
            if ($('.color-product').length > 0) {
                color = $('.color-product:checked').data('val');
            }
            if ($('.size-product').length > 0) {
                size = $('.size-product:checked').data('val');
            }
            if ($('.option-input').length > 0) {
                optionIds = $(".option-input:checked").map(function() {
                    return $(this).data('id');
                }).get();
                optionValues = $(".option-input:checked").map(function() {
                    return $(this).data('val');
                }).get();
            }
            productId = "<?php echo e($product->id); ?>";
            url = "<?php echo e(route('product.price')); ?>";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    productId,
                    optionIds,
                    optionValues,
                    color,
                    size,
                    submit: true
                }
            }).always(function(data) {
                $("#product-price").html("৳"+data)
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/front/product.blade.php ENDPATH**/ ?>