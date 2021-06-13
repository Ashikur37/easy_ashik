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
Route::apiResource('campaigns', 'Api\CampaignController')->only('index');
Route::get('campaign/{campaign}/products', 'Api\CampaignController@product')->name('campaign_products');
Route::apiResource('products', 'Api\ProductController')->only('show');
Route::get('products/search/{key}', 'Api\ProductController@search')->name('search_product');
Route::get('top-products', 'Api\ProductController@topProducts')->name('top_product');

Route::apiResource('slides', 'Api\SliderController')->only('index');

//login routes

Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

Route::post('register-otp','Api\UserController@registerOtp');

//auth routes

Route::group([ 'middleware' => 'auth:sanctum'], function () {
    Route::resource('checkout','Api\CheckoutController');
    Route::post('create-address','Api\UserController@createAddress');
    Route::post('update-basic','Api\UserController@updateBasic');
    Route::get('get-address','Api\UserController@getAddress');
    Route::get('get-address/{userAddress}','Api\UserController@getSingleAddress');
    Route::get('orders/{order}','Api\OrderController@show');
    Route::get('orders','Api\OrderController@index');
    Route::get('/user',function(Request $request){
        return $request->user();
    });
});


Route::post('/cart/get-item-price', 'Api\CartController@getItemPrice')->name('cart.get_price');

