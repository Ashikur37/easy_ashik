<?php

use Illuminate\Support\Facades\Route;

// ************************************ ADMIN SECTION **********************************************

Route::group(['prefix' => 'admin',  'middleware' => 'is_admin'], function () {
    /*Admin Dashboard*/
    Route::get('/', 'Admin\HomeController@index');

    /*Dashboard data on ajax call*/
    Route::get('/dashboard-data/{day}/{type}', 'Admin\HomeController@dashboardData');

    /* Routes For Resource Controllers*/
    /*Attribute Routes*/
    Route::resource('attribute', 'Admin\AttributeController');
    Route::get('attribute/status/{attribute}/{status}', 'Admin\AttributeController@updateStatus');
    Route::get('attribute/remove-value/{attribute}/{value}', 'Admin\AttributeController@removeValue');
    Route::post('attribute/multi/{status}/{ids}', 'Admin\AttributeController@multiStatus');
    Route::delete('attribute/multi/{ids}', 'Admin\AttributeController@multiDelete');


    /*Attribute Set Routes*/
    Route::resource('attribute-set', 'Admin\AttributeSetController');
    Route::delete('attribute-set/multi/{ids}', 'Admin\AttributeSetController@multiDelete');

    /*Badge Routes*/
    Route::resource('badge', 'Admin\BadgeController');
    Route::get('badge/status/{badge}/{status}', 'Admin\BadgeController@updateStatus');
    Route::delete('badge/multi/{ids}', 'Admin\BadgeController@multiDelete');
    Route::post('badge/multi/{status}/{ids}', 'Admin\BadgeController@multiStatus');

    /*Blog Routes*/
    Route::resource('blog', 'Admin\BlogController');
    Route::get('blog/status/{blog}/{status}', 'Admin\BlogController@updateStatus');
    Route::delete('blog/multi/{ids}', 'Admin\BlogController@multiDelete');
    Route::post('blog/multi/{status}/{ids}', 'Admin\BlogController@multiStatus');

    /*Brand Routes*/
    Route::resource('brand', 'Admin\BrandController');
    Route::get('brand/status/{brand}/{status}', 'Admin\BrandController@updateStatus');
    Route::delete('brand/multi/{ids}', 'Admin\BrandController@multiDelete');
    Route::post('brand/multi/{status}/{ids}', 'Admin\BrandController@multiStatus');

    /*Shop Routes*/
    Route::resource('shop', 'Admin\ShopController');
    Route::get('shop/status/{shop}/{status}', 'Admin\ShopController@updateStatus');
    Route::delete('shop/multi/{ids}', 'Admin\ShopController@multiDelete');
    Route::post('shop/multi/{status}/{ids}', 'Admin\ShopController@multiStatus');

    /*Category Routes*/
    Route::resource('category', 'Admin\CategoryController');
    Route::get('category/status/{category}/{status}', 'Admin\CategoryController@updateStatus');

    Route::get('category/feature/{category}/{status}', 'Admin\CategoryController@updateFeature');
    Route::delete('category/multi/{ids}', 'Admin\CategoryController@multiDelete');
    Route::post('category/multi/{status}/{ids}', 'Admin\CategoryController@multiStatus');

    /*Child Category Routes*/
    Route::resource('child-category', 'Admin\ChildCategoryController');
    Route::get('child-category/status/{childCategory}/{status}', 'Admin\ChildCategoryController@updateStatus');
    Route::get('child-category/feature/{childCategory}/{status}', 'Admin\ChildCategoryController@updateFeature');
    Route::delete('child-category/multi/{ids}', 'Admin\ChildCategoryController@multiDelete');
    Route::post('child-category/multi/{status}/{ids}', 'Admin\ChildCategoryController@multiStatus');

    /*Color Routes*/
    Route::resource('color', 'Admin\ColorController');
    Route::delete('color/multi/{ids}', 'Admin\ColorController@multiDelete');

    /*Coupon Routes*/
    Route::resource('coupon', 'Admin\CouponController');
    Route::get('coupon/status/{coupon}/{status}', 'Admin\CouponController@updateStatus');
    Route::delete('coupon/multi/{ids}', 'Admin\CouponController@multiDelete');
    Route::post('coupon/multi/{status}/{ids}', 'Admin\CouponController@multiStatus');

    /*Currency Routes*/
    Route::resource('currency', 'Admin\CurrencyController');
    Route::delete('currency/multi/{ids}', 'Admin\CurrencyController@multiDelete');
    Route::get('currency/status/{currency}/{status}', 'Admin\CurrencyController@updateStatus');

    /*FAQ Routes*/
    Route::resource('faq', 'Admin\FaqController');
    Route::get('faq/status/{faq}/{status}', 'Admin\FaqController@updateStatus');
    Route::delete('faq/multi/{ids}', 'Admin\FaqController@multiDelete');
    Route::post('faq/multi/{status}/{ids}', 'Admin\FaqController@multiStatus');

    /*Flash Sale Routes*/
    Route::resource('flash-sale', 'Admin\FlashSaleController');
    Route::get('flash-sale/status/{flashSale}/{status}', 'Admin\FlashSaleController@updateStatus');
    Route::get('/remove-flash-product/{id}', 'Admin\FlashSaleController@removeFlashProduct');
    Route::delete('flash-sale/multi/{ids}', 'Admin\FlashSaleController@multiDelete');

    /*Campaign Routes*/
    Route::resource('campaign', 'Admin\CampaignController');
    Route::get('campaign/status/{campaign}/{status}', 'Admin\CampaignController@updateStatus');
    Route::get('/remove-flash-product/{id}', 'Admin\CampaignController@removeCampaignProduct');
    Route::delete('campaign/multi/{ids}', 'Admin\CampaignController@multiDelete');

    /*Customer Routes*/
    Route::resource('customer', 'Admin\CustomerController');
    Route::get('customer/status/{customer}/{status}', 'Admin\CustomerController@updateStatus');
    Route::delete('customer/multi/{ids}', 'Admin\CustomerController@multiDelete');
    Route::post('customer/multi/{status}/{ids}', 'Admin\CustomerController@multiStatus');

    /*Brand Routes*/
    Route::resource('withdraw', 'Admin\WithdrawController');
    Route::get('withdraw/status/{withdraw}/{status}', 'Admin\WithdrawController@updateStatus');
    Route::delete('withdraw/multi/{ids}', 'Admin\WithdrawController@multiDelete');
    Route::post('withdraw/multi/{status}/{ids}', 'Admin\WithdrawController@multiStatus');

    /*Brand Routes*/
    Route::resource('language', 'Admin\LanguageController');
    Route::get('language/status/{language}/{status}', 'Admin\LanguageController@updateStatus');
    Route::delete('language/multi/{ids}', 'Admin\LanguageController@multiDelete');
    Route::post('language/multi/{status}/{ids}', 'Admin\LanguageController@multiStatus');

    /*Order Routes*/
    Route::resource('order', 'Admin\OrderController');
    Route::post('order/address/{order}', 'Admin\OrderController@updateAddress');
    Route::get('order/status/{order}/{status}', 'Admin\OrderController@updateStatus');
    Route::get('order/print/{order}', 'Admin\OrderController@printOrder');
    Route::get('order/payment-status/{order}/{status}', 'Admin\OrderController@updatePaymentStatus');
    Route::delete('order/multi/{ids}', 'Admin\OrderController@multiDelete');
    Route::post('order/multi/{status}/{ids}', 'Admin\OrderController@multiStatus');

    /*Page Routes*/
    Route::resource('page', 'Admin\PageController');
    Route::get('page/status/{page}/{status}', 'Admin\PageController@updateStatus');
    Route::delete('page/multi/{ids}', 'Admin\PageController@multiDelete');
    Route::post('page/multi/{status}/{ids}', 'Admin\PageController@multiStatus');

    /*Payment Gateway Routes*/
    Route::resource('payment-gateway', 'Admin\PaymentGatewayController');
    Route::get('payment-gateway/status/{paymentGateway}/{status}', 'Admin\PaymentGatewayController@updateStatus');
    Route::delete('payment-gateway/multi/{ids}', 'Admin\PaymentGatewayController@multiDelete');
    Route::post('payment-gateway/multi/{status}/{ids}', 'Admin\PaymentGatewayController@multiStatus');

    /*Payment Setting Routes*/
    Route::get('payment-setting/general', 'Admin\PaymentSettingController@general');
    Route::post('payment-setting/general-update', 'Admin\PaymentSettingController@updateGeneral');
    Route::get('payment-setting/paypal', 'Admin\PaymentSettingController@paypal');
    Route::post('payment-setting/paypal-update', 'Admin\PaymentSettingController@updatePaypal');
    Route::get('payment-setting/stripe', 'Admin\PaymentSettingController@stripe');
    Route::post('payment-setting/stripe-update', 'Admin\PaymentSettingController@updateStripe');
    Route::get('payment-setting/ssl-commerz', 'Admin\PaymentSettingController@sslCommerz');
    Route::post('payment-setting/ssl-commerz-update', 'Admin\PaymentSettingController@updateSslCommerz');
    Route::get('payment-setting/razorpay', 'Admin\PaymentSettingController@razorpay');
    Route::post('payment-setting/razorpay-update', 'Admin\PaymentSettingController@updateRazorpay');

    /*SOcial Setting Routes*/
    Route::get('social-setting/social-login', 'Admin\SocialLoginController@socialLogin');
    Route::post('social-setting/social-login-update', 'Admin\SocialLoginController@updateSocialLogin');

    /*Product Routes*/
    Route::resource('product', 'Admin\ProductController');
    Route::get('product-import', 'Admin\ProductController@import');
    Route::get('product/{product}/duplicate', 'Admin\ProductController@duplicate');

    Route::post('product-import', 'Admin\ProductController@importSubmit');


    Route::get('product/status/{product}/{status}', 'Admin\ProductController@updateStatus');
    Route::delete('product/multi/{ids}', 'Admin\ProductController@multiDelete');
    Route::post('product/multi/{status}/{ids}', 'Admin\ProductController@multiStatus');
    Route::get('remove-option/{product_id}/{option_id}', 'Admin\ProductController@removeOption');
    Route::get('remove-option-value/{value_id}', 'Admin\ProductController@removeOptionValue');

    /*Review Routes*/
    Route::resource('review', 'Admin\ReviewController');
    Route::get('review/status/{review}/{status}', 'Admin\ReviewController@updateStatus');
    Route::delete('review/multi/{ids}', 'Admin\ReviewController@multiDelete');
    Route::post('review/multi/{status}/{ids}', 'Admin\ReviewController@multiStatus');

    /*Comment*/
    Route::resource('comment', 'Admin\CommentController');
    Route::delete('comment/multi/{ids}', 'Admin\CommentController@multiDelete');

    /*Role Routes*/
    Route::resource('role', 'Admin\RoleController');
    Route::delete('role/multi/{ids}', 'Admin\RoleController@multiDelete');

    /*Shipping Method Routes*/
    Route::resource('shipping-method', 'Admin\ShippingMethodController');
    Route::get('shipping-method/status/{shippingMethod}/{status}', 'Admin\ShippingMethodController@updateStatus');
    Route::delete('shipping-method/multi/{ids}', 'Admin\ShippingMethodController@multiDelete');
    Route::post('shipping-method/multi/{status}/{ids}', 'Admin\ShippingMethodController@multiStatus');

    /*Size Routes*/
    Route::resource('size', 'Admin\SizeController');
    Route::delete('size/multi/{ids}', 'Admin\SizeController@multiDelete');

    /*Slider Routes*/
    Route::resource('slide', 'Admin\SliderController');
    Route::get('slide/status/{slide}/{status}', 'Admin\SliderController@updateStatus');
    Route::delete('slide/multi/{ids}', 'Admin\SliderController@multiDelete');
    Route::post('slide/multi/{status}/{ids}', 'Admin\SliderController@multiStatus');

    /*Sub Category Routes*/
    Route::resource('sub-category', 'Admin\SubCategoryController');
    Route::get('sub-category/status/{subCategory}/{status}', 'Admin\SubCategoryController@updateStatus');
    Route::get('sub-category/feature/{subCategory}/{status}', 'Admin\SubCategoryController@updateFeature');
    Route::delete('sub-category/multi/{ids}', 'Admin\SubCategoryController@multiDelete');
    Route::post('sub-category/multi/{status}/{ids}', 'Admin\SubCategoryController@multiStatus');

    /*Tag Routes*/
    Route::resource('tag', 'Admin\TagController');
    Route::delete('tag/multi/{ids}', 'Admin\TagController@multiDelete');

    /*Ticket Routes*/
    Route::resource('ticket', 'Admin\TicketController');
    Route::get('/load-ticket/{ticket}', 'Admin\TicketController@loadTicket');
    Route::post('/ticket/message/{ticket}', 'Admin\TicketController@postMessage');
    Route::get('ticket/status/{ticket}/{status}', 'Admin\TicketController@updateStatus');
    Route::post('ticket/multi/{status}/{ids}', 'Admin\TicketController@multiStatus');

    /*Ticket Category Routes*/
    Route::resource('ticket-category', 'Admin\TicketCategoryController');
    Route::delete('ticket-category/multi/{ids}', 'Admin\TicketCategoryController@multiDelete');

    /*User Routes*/
    Route::resource('user', 'Admin\UserController');
    Route::delete('user/multi/{ids}', 'Admin\UserController@multiDelete');


    /*vendor Routes*/
    Route::resource('vendor', 'Admin\VendorController');
    Route::get('vendor/status/{vendor}/{status}', 'Admin\VendorController@updateStatus');

    /*Affiliation Routes*/
    Route::resource('affiliate', 'Admin\AffiliateController');
    Route::get('affiliate/status/{affiliateProduct}/{status}', 'Admin\AffiliateController@updateStatus');
    Route::delete('affiliate/multi/{ids}', 'Admin\AffiliateController@multiDelete');
    Route::post('affiliate/multi/{status}/{ids}', 'Admin\AffiliateController@multiStatus');

    /*Profile and password Routes*/
    Route::get('profile', 'Admin\ProfileController@index');
    Route::post('update-password', 'Admin\ProfileController@updatePassword');
    Route::post('update-profile', 'Admin\ProfileController@updateProfile');

    /*Report Routes*/
    Route::resource('report', 'Admin\ReportController');

    /*Notification Routes*/
    Route::get('/notifications', 'Admin\NotificationController@index');

    /*Site Setting Routes*/
    Route::get('site-setting', 'Admin\GeneralSettingController@siteSetting');
    Route::post('site-setting', 'Admin\GeneralSettingController@siteSettingUpdate');

    /*Logo setting Routes*/
    Route::get('logo', 'Admin\GeneralSettingController@logo');
    Route::post('logo', 'Admin\GeneralSettingController@updateLogo');

    /*Social Link Setting Routes*/
    Route::get('social-link', 'Admin\GeneralSettingController@socialLink');
    Route::post('social-link', 'Admin\GeneralSettingController@socialLinkUpdate');

    /*Custom css-js Routes*/
    Route::get('custom-css-js', 'Admin\GeneralSettingController@customCssJs');
    Route::post('custom-css-js', 'Admin\GeneralSettingController@customCssJsUpdate');

    /*Maintenance Routes*/
    Route::get('maintenance', 'Admin\GeneralSettingController@maintenance');
    Route::post('maintenance', 'Admin\GeneralSettingController@maintenanceUpdate');

    /*Banner Routes*/
    Route::get('top-right-banner', 'Admin\FrontSettingController@topRightBanner');
    Route::post('top-right-banner', 'Admin\FrontSettingController@topRightBannerUpdate');
    Route::get('two-column-banner', 'Admin\FrontSettingController@twoColumnBanner');
    Route::post('two-column-banner', 'Admin\FrontSettingController@twoColumnBannerUpdate');
    Route::get('best-deal-banner', 'Admin\FrontSettingController@bestDealBanner');
    Route::post('best-deal-banner', 'Admin\FrontSettingController@bestDealBannerUpdate');
    Route::get('full-width-banner', 'Admin\FrontSettingController@fullWidthBanner');
    Route::post('full-width-banner', 'Admin\FrontSettingController@fullWidthBannerUpdate');

    /*Homepage Setting Routes*/
    Route::get('home-page-option', 'Admin\FrontSettingController@homePageOption');
    Route::post('home-page-option', 'Admin\FrontSettingController@homePageOptionUpdate');

    /*Plugin Routes*/
    Route::get('plugin', 'Admin\GeneralSettingController@plugin');
    Route::post('plugin', 'Admin\GeneralSettingController@pluginUpdate');

    /*SEO Routes*/
    Route::get('seo', 'Admin\GeneralSettingController@seo');
    Route::post('seo', 'Admin\GeneralSettingController@seoUpdate');


    /*Performance Routes*/
    Route::get('cache', 'Admin\PerformanceController@cache');
    Route::get('clear-cache', 'Admin\PerformanceController@clearCache');
    Route::get('optimize', 'Admin\PerformanceController@optimize');

    /*Service Routes*/
    Route::get('services', 'Admin\GeneralSettingController@services');
    Route::post('services', 'Admin\GeneralSettingController@updateServices');

    /*Error Page Banner Routes*/
    Route::get('error404', 'Admin\GeneralSettingController@errorBanner');
    Route::post('error404', 'Admin\GeneralSettingController@errorBannerUpdate');

    Route::get('payment-image', 'Admin\GeneralSettingController@paymentImage');
    Route::post('payment-image', 'Admin\GeneralSettingController@paymentImageUpdate');

    /*Popup Banner Routes*/
    Route::get('popup-window', 'Admin\GeneralSettingController@popUpWindow');
    Route::post('popup-window', 'Admin\GeneralSettingController@popUpWindowUpdate');

    /*Static Page Routes*/
    Route::get('contact-setting', 'Admin\GeneralSettingController@contactSetting');
    Route::post('contact-setting', 'Admin\GeneralSettingController@contactSettingUpdate');
    Route::get('about-us-setting', 'Admin\GeneralSettingController@aboutSetting');
    Route::post('about-us-setting', 'Admin\GeneralSettingController@aboutSettingUpdate');
    Route::get('terms-condition-setting', 'Admin\GeneralSettingController@termsSetting');
    Route::post('terms-condition-setting', 'Admin\GeneralSettingController@termsSettingUpdate');

    /*Notification Setting Routes*/
    Route::get('notification', 'Admin\GeneralSettingController@notification');
    Route::get('notification/{key}/{val}', 'Admin\GeneralSettingController@notificationUpdate');

    /*Subscriber and Group Email Routes*/
    Route::get('group-email', 'Admin\EmailController@index');
    Route::get('email-config', 'Admin\EmailController@config');
    Route::post('email-config', 'Admin\EmailController@updateSetting');
    Route::post('send-email', 'Admin\EmailController@sendEmail');
    Route::get('subscriber', 'Admin\EmailController@subscriber');
});

Route::get('/coming_soon', function () {
    return view('comming_soon\comming_soon');
})->name('coming_soon');
// ************************************End ADMIN SECTION **********************************************
Route::get('admin/load-sub-category/{category}', 'Admin\CategoryController@loadSubCategory');
Route::get('admin/load-child-category/{subcategory}', 'Admin\SubCategoryController@loadChildCategory');
Route::get('load-attribute-value/{attribute}', 'Admin\AttributeController@loadValue');

//password/mobile

Route::post('/reset/mobile', 'Auth\LoginController@resetMobile')->name('password.mobile');
Route::get('reset/password/mobile', 'Auth\LoginController@showMobileReset');

///
//mobile_update
Route::post('/update/mobile', 'Auth\Logincontroller@updatePasswordMobile')->name('password.mobile_update');

Route::view('password/mobile', 'auth.passwords.mobile');

Route::view('password/select', 'auth.passwords.set');
/*Admin login*/
Route::get('/admin/login', 'HomeController@adminLogin');

Route::get('/admin/login', 'HomeController@adminLogin');


// ************************************ USER SECTION **********************************************
Route::group(['prefix' => 'user',  'middleware' => 'is_user'], function () {
    /*User Dashboard*/
    Route::get('/', 'User\HomeController@index')->name('user.home');

    /*Notification Routes*/
    Route::get('/notifications', 'User\NotificationController@index')->name('user.notification');
    Route::get('/apply-vendor', 'User\VendorController@applyVendor')->name('vendor.apply');
    Route::post('/submit-vendor', 'User\VendorController@submitVendor')->name('vendor.submit');


    /*Change Password Routes*/
    Route::get('/change-password', 'User\ProfileController@changePassword')->name('user.change-password');
    Route::post('/change-password', 'User\ProfileController@updatePassword')->name('user.update-password');


    Route::get('/change-profile', 'User\ProfileController@changeProfile')->name('user.change-profile');
    Route::post('/change-password', 'User\ProfileController@updateProfile')->name('user.update-profile');

    /*Change Password Routes*/
    Route::get('/wish-list', 'User\WishListController@index')->name('user.wishlist');
    Route::get('/wishlist/add-item', 'User\WishListController@addItem')->name('wishlist.add');
    Route::get('/wishlist/remove-item', 'User\WishListController@removeItem')->name('wishlist.remove');

    /*Review Routes*/
    Route::get('/review', 'User\ReviewController@index')->name('user.review');
    Route::get('/review/remove-item', 'User\ReviewController@removeItem')->name('review.remove');

    /*Affiliation Routes*/
    Route::get('/affiliation', 'User\AffiliationController@index')->name('user.affiliation');

    /*Withdraw Routes*/
    Route::get('/withdraw', 'User\AffiliationController@withdraw')->name('user.withdraw');
    Route::get('/withdraw/create', 'User\AffiliationController@createWithdraw')->name('user.withdraw.create');
    Route::post('/withdraw/create', 'User\AffiliationController@storeWithdraw')->name('user.withdraw.store');

    /*OrderRoutes*/
    Route::get('/order', 'User\OrderController@index')->name('user.order');
    Route::post('/order/partial-payment/{order}', 'User\OrderController@partialPayment');

    Route::get('/order/{number}', 'User\OrderController@show')->name('user.order.show');
    Route::get('/order/status/{id}', 'User\OrderController@status')->name('user.order.status');

    /*Ticket Routes*/
    Route::get('/ticket', 'User\TicketController@index')->name('user.ticket');
    Route::get('/load-ticket/{ticket}', 'User\TicketController@loadTicket')->name('user.load-ticket');
    Route::post('/ticket-message/{ticket}', 'User\TicketController@postMessage')->name('user.ticket-message');
    Route::post('/ticket/create', 'User\TicketController@store')->name('user.ticket-store');


    Route::resource('/user-address', 'User\UserAddressController');
    Route::get('/address/delete/{userAddress}', 'User\UserAddressController@deleteAddress');


    Route::get('get-messages/{product}', 'User\MessageController@getMessages');
    Route::post('send-message/{product}', 'User\MessageController@sendMessage')->name('user.product-message');
});

Route::group(['prefix' => 'vendor',  'middleware' => 'is_vendor'], function () {

    Route::get('/', 'Vendor\HomeController@index')->name('vendor.home');
    Route::get('/products', 'Vendor\ProductController@index')->name('vendor.product_list');
    Route::get('/products/create', 'Vendor\ProductController@create')->name('vendor.product_create');
    Route::post('/products/create', 'Vendor\ProductController@store')->name('vendor.product_store');
    Route::get('/products/edit/{product}', 'Vendor\ProductController@edit')->name('vendor.product_edit');
    Route::patch('/products/edit/{product}', 'Vendor\ProductController@update')->name('vendor.product_update');
    Route::delete('/products/{product}', 'Vendor\ProductController@destroy')->name('vendor.product_delete');

    Route::get('product/status/{product}/{status}', 'Vendor\ProductController@updateStatus');
    Route::delete('product/multi/{ids}', 'Vendor\ProductController@multiDelete');
    Route::post('product/multi/{status}/{ids}', 'Vendor\ProductController@multiStatus');
    Route::get('remove-option/{product_id}/{option_id}', 'Vendor\ProductController@removeOption');
    Route::get('remove-option-value/{value_id}', 'Vendor\ProductController@removeOptionValue');
    Route::get('product-import', 'Vendor\ProductController@import');
    Route::post('product-import', 'Vendor\ProductController@importSubmit');


    Route::get('order', 'Vendor\OrderController@index')->name('vendor_order.index');
    Route::get('order/{order}', 'Vendor\OrderController@show')->name('vendor_order.show');
    Route::get('order/status/{order}/{status}', 'Vendor\OrderController@updateStatus');
    Route::get('order/print/{order}', 'Vendor\OrderController@printOrder');
    Route::get('order/payment-status/{order}/{status}', 'Vendor\OrderController@updatePaymentStatus');
    Route::delete('order/multi/{ids}', 'Vendor\OrderController@multiDelete');
    Route::post('order/multi/{status}/{ids}', 'Vendor\OrderController@multiStatus');

    Route::get('/change-profile', 'Vendor\ProfileController@changeProfile')->name('vendor.change-profile');
    Route::post('/change-password', 'Vendor\ProfileController@updateProfile')->name('vendor.update-profile');
});
// Print Order
Route::get('/order/print/{order_number}', 'User\OrderController@print')->name('user.order.print');

// ************************************End USER SECTION **********************************************

// ************************************ Front SECTION **********************************************

/*Home Page*/
Route::get('/', 'Front\HomeController@index')->name('home');
Route::get('/load-home', 'Front\HomeController@loadMore');
/*Track Order*/
Route::get('/check-order-track/{number}', 'User\OrderController@orderTrackCheck')->name('order-track-check');
Route::get('/order-track/{number}', 'User\OrderController@orderTrack')->name('order-track');

/*load Dynamic Content By Ajax Call*/
Route::get('/load-header', 'Front\HomeController@loadHeader')->name('header.load');
Route::get('/load-cart', 'Front\HomeController@loadAsideCart')->name('aside.cart.load');
Route::get('/load-sub-product/{subCategory}', 'Front\HomeController@loadSubProduct');

/*load Trending Category Products*/
Route::get('/load-trending-products/{category}', 'Front\HomeController@loadTrendingProducts')->name('trending.product.load');

/*Search Product On Keyup*/
Route::get('/suggest-search/{key}', 'Front\HomeController@suggestSearch')->name('search.suggest');

/*Set Currency*/
Route::get('/currency/{id}', 'Front\HomeController@currency')->name('front.currency');

/*Set Language*/
Route::get('/language/{id}', 'Front\HomeController@language')->name('front.language');

/*Newsletter Routes*/
Route::get('/subscribe/{email}', 'Front\HomeController@subscribe')->name('subscribe');
Route::get('/unsubscribe/{email}', 'Front\HomeController@unsubscribe')->name('unsubscribe');

/*faq page*/
Route::get('/faq', 'Front\PageController@faq')->name('faq');

/*Contact page*/
Route::get('/contact', 'Front\PageController@contact')->name('contact');

/*Submit Contact Form*/
Route::post('/contact/submit', 'Front\PageController@submitContact')->name('contact.submit');

/*About Us Page*/
Route::get('/about-us', 'Front\PageController@aboutUs')->name('about-us');

/*Terms Condition Page*/
Route::get('/terms-condition', 'Front\PageController@termsCondition')->name('terms-condition');

/*Blog Routes*/
Route::get('/blog', 'Front\BlogController@index')->name('blog');
Route::get('/blog/{slug}', 'Front\BlogController@show')->name('front-blog.show');
Route::post('/blog-comment/{blog}', 'Front\BlogController@comment')->name('blog.comment');
Route::post('/blog-comment-reply/{blogComment}', 'Front\BlogController@commentReply')->name('blog.comment.reply');

/*Home Route*/
Route::get('/home', 'HomeController@index');

/*Compare Page*/
Route::get('/compare', 'Front\CompareListController@index')->name('compare');

/*load Trending Category Products*/
Route::get('/cart', 'Front\CartController@index')->name('cart');

/*Checkout Routes*/
Route::get('/checkout', 'Front\CheckoutController@index')->name('checkout');
Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::post('/checkout/submit', 'Front\CheckoutController@checkoutSubmit')->name('checkout.submit');
});
/*Update Shipping Method in checkout page*/
Route::get('/shipping-update/{shippingMethod}', 'Front\CheckoutController@shippingMethod');

/*Payment Callback RToutes*/
Route::get('/payment/paypal/success', 'Payment\PayPalController@success')->name('paypal.success');
Route::get('/payment/paypal/cancel', 'Payment\PayPalController@cancel')->name('paypal.cancel');
Route::get('/payment/return', 'Payment\PaymentController@payreturn')->name('payment.return');

/*Razorpay Callback*/
Route::post('/razorpay-callback', 'Payment\RazorPayController@razorCallback')->name('razorpay.notify');

/*load Field For Custom Payment Method*/
Route::get('/checkout/load-payment/{paymentGateway}', 'Front\CheckoutController@loadPayment');

/*Order Success Page*/
Route::get('/order/success', 'Front\OrderController@success')->name('order.success');

/*Category Routes */
Route::get('/category/{category:slug?}/{subCategory:slug?}/{childCategory:slug?}', 'Front\CategoryController@index')->name('category');
Route::get('/seller/{category:slug?}/{subCategory:slug?}/{childCategory:slug?}', 'Front\CategoryController@index')->name('seller');
Route::post('/seller/{category:slug?}/{subCategory:slug?}/{childCategory:slug?}', 'Front\CategoryController@filter');
Route::post('/category/{category:slug?}/{subCategory:slug?}/{childCategory:slug?}', 'Front\CategoryController@filter');

/*Category List Page*/
Route::get('/categories', 'Front\CategoryController@categories')->name('categories');

/*Flash Sale Routes*/
Route::get('/offer/{name}', 'Front\CategoryController@flashSale')->name('flash-sale');
Route::post('/sale', 'Front\CategoryController@flashSaleSort');


/*Shope Routes*/
Route::get('/shop/{name}', 'Front\CategoryController@shop')->name('single-shop');
Route::post('/shop/{name}', 'Front\CategoryController@shopSort');

/*Best Sale Routes*/
Route::get('/best-sale', 'Front\CategoryController@bestSale')->name('best-sale');
Route::post('/best-sale', 'Front\CategoryController@bestSaleSort');

/*Product Page*/
Route::get('/product/{slug}', 'Front\ProductController@show')->name('front-product.show');

/*Comment On Product*/
Route::post('/product-comment/{product}', 'Front\ProductController@comment')->name('product.comment');

/*Reply On Product Comment*/
Route::post('/product-comment-reply/{productComment}', 'Front\ProductController@commentReply')->name('product.comment.reply');

/*Review On Product*/
Route::post('/product-review/{product}', 'Front\ProductController@review')->name('product.review');

/*Tag Product Page*/
Route::get('/product/tag/{tag}', 'Front\ProductController@tagProduct')->name('tag.product');
Route::post('/product/tag/{tag}', 'Front\ProductController@tagProductSort');

/*Brand's Product Page*/
Route::get('/product/brand/{brand}', 'Front\ProductController@brandProduct')->name('brand.product');
Route::post('/product/brand/{brand}', 'Front\ProductController@brandProductSort');

/*Cart Routes*/
Route::post('/get-product-price', 'Front\CartController@getPrice')->name('product.price');
Route::post('/cart/add-item', 'Front\CartController@addItem')->name('cart.add');
Route::get('/cart/get-item', 'Front\CartController@getItems')->name('cart.get');
Route::get('/cart/increament/{row}', 'Front\CartController@increament');
Route::get('/cart/decreament/{row}', 'Front\CartController@decreament');
Route::get('/cart/remove/{row}', 'Front\CartController@removeItem');
Route::get('/cart/apply-coupon/{name}', 'Front\CartController@applyCoupon');
Route::get('/cart/remove-coupon', 'Front\CartController@removeCoupon');
Route::get('/cart/load', 'Front\CartController@loadCart');

/*Compare Routes*/
Route::get('/compare/add-item', 'Front\CompareListController@addItem')->name('compare.add');
Route::get('/compare/remove/{row}', 'Front\CompareListController@removeItem');

// offer shop
Route::get('/single-voucher', 'Front\OfferController@singleVoucher')->name('single-voucher');
Route::get('/rocket-shop', 'Front\OfferController@rocketShop')->name('rocket-shop');
Route::get('/offers', 'Front\OfferController@campaigns')->name('offers');
Route::get('/campaigns', 'Front\OfferController@campaignList')->name('campaigns');
Route::get('/campaign/{title}', 'Front\OfferController@singleCampaign')->name('single-campaign');


Route::get('/easy-shop', 'Front\OfferController@shops')->name('shop');

Route::get('/single-campaign', 'Front\OfferController@singleCampaign');
Route::get('/load-address/{userAddress}', 'User\UserAddressController@loadAddress');
/*Auth Routes*/
Auth::routes();
Auth::routes([
    'verify' => true
]);
/*Social Login*/
Route::get('auth/social', 'Auth\LoginController@showLoginForm')->name('social.login');
Route::get('oauth/{driver}', 'Auth\LoginController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');
Route::post('signout', 'Auth\LoginController@signout')->name('signout');


/*CkEditor Routes*/
Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');

/*Dropzone Routes*/
Route::post('dropzone/store', 'DropZoneController@dropzoneStore')->name('dropzone.store');
Route::post('dropzone/remove', 'DropZoneController@dropzoneRemove')->name('dropzone.remove');

/*Maintenance Page*/
Route::get('/maintenance', 'Front\PageController@maintenance')->name('maintenance');

/*Custom Page*/
Route::get('/page/{slug}', 'Front\PageController@show')->name('showPage');

/*Read Notification*/
Route::get('/notification/read/{id}', 'HomeController@readNotification');

Route::get('/verify-purchase', 'PurchaseController@index');
Route::post('/verify-purchase', 'PurchaseController@verify')->name('verify-purchase');
//ssl commerz

Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index');
Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');
