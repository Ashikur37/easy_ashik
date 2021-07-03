<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('categories', 'Api\CategoryController')->only('index');
Route::get('category/{category}/products', 'Api\CategoryController@product')->name('category_products');
Route::get('sub_category/{subCategory}/products', 'Api\CategoryController@subCatProduct')->name('sub_category_products');

//
Route::get('category/{category}/sub_categories', 'Api\CategoryController@subCategory')->name('category_sub_categories');
Route::apiResource('shops', 'Api\ShopController')->only('index');
Route::get('shop/{shop}/products', 'Api\ShopController@product')->name('shop_products');
Route::get('store/{product}/products', 'Api\ShopController@storeProduct');
Route::get('merchant/{user}/products', 'Api\ShopController@merchantProduct');
Route::get('stores/{store}/products', 'Api\ShopController@storeProducts');

Route::get('store/{product}', 'Api\ShopController@store');
Route::get('merchant/{user}', 'Api\ShopController@merchant');
Route::get('vendors', 'Api\ShopController@vendorList');

Route::apiResource('campaigns', 'Api\CampaignController')->only('index');
Route::get('campaign/{campaign}/products', 'Api\CampaignController@product')->name('campaign_products');
Route::apiResource('products', 'Api\ProductController')->only('show');
Route::get('products/search/{key}', 'Api\ProductController@search')->name('search_product');
Route::get('top-products', 'Api\ProductController@topProducts')->name('top_product');

Route::apiResource('slides', 'Api\SliderController')->only('index');
Route::apiResource('offers', 'Api\OfferController')->only('index');
Route::get('offer/{flashSale}/products', 'Api\OfferController@product')->name('offer_products');
Route::get('offer/{flashSale}/shops', 'Api\OfferController@shops')->name('offer_shops');

Route::get('offer/{flashSale}/brands', 'Api\OfferController@brands')->name('offer_brands');
Route::get('brand/{brand}/products', 'Api\BrandController@product');



//login routes

Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

Route::post('register-otp', 'Api\UserController@registerOtp');

//auth routes
Route::get('pay-now/{partialPayment}', 'Api\OrderController@payScreen');
Route::get('orders/{order}', 'Api\OrderController@show');
Route::get('order/{order}/pay-delivery', 'Api\OrderController@deliveryPayment');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('checkout', 'Api\CheckoutController');
    Route::post('create-address', 'Api\UserController@createAddress');
    Route::post('upload-image', 'Api\UserController@uploadImage');
    Route::post('change-password', 'Api\UserController@changePassword');

    Route::post('update-basic', 'Api\UserController@updateBasic');
    Route::get('get-address', 'Api\UserController@getAddress');
    Route::get('get-chat', 'Api\MessageController@getChat');
    Route::get('get-messages/{product}', 'Api\MessageController@getMessages');
    Route::post('send-message/{product}', 'Api\MessageController@sendMessage');


    Route::get('get-address/{userAddress}', 'Api\UserController@getSingleAddress');
    Route::get('wish-list/products', 'Api\UserController@wishListProduct');
    Route::get('wish-list/add/{product}', 'Api\UserController@addWishListProduct');

    Route::get('orders', 'Api\OrderController@index');
    Route::post('order/{order}/cancel-order', 'Api\OrderController@cancelOrder');
    Route::post('order/{order}/change-address', 'Api\OrderController@changeAddress');


    Route::post('order/{order}/partial-payment', 'Api\OrderController@partialPayment');
    Route::get('order/{order}/pay-with-balance', 'Api\OrderController@payWithBalance');

    Route::get('order/{order}/confirm-order', 'Api\OrderController@confirmOrder');


    Route::post('order/{order}/cash-on-delivery', 'Api\OrderController@cashOnDelivery');
    //cash-on-delivery

    //payScreen
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


Route::post('/cart/get-item-price', 'Api\CartController@getItemPrice')->name('cart.get_price');
