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
Route::apiResource('shops', 'Api\ShopController')->only('index');
Route::get('shop/{shop}/products', 'Api\ShopController@product')->name('shop_products');
Route::apiResource('campaigns', 'Api\CampaignController')->only('index');
Route::get('campaign/{campaign}/products', 'Api\CampaignController@product')->name('campaign_products');
Route::apiResource('products', 'Api\ProductController')->only('show');
Route::get('products/search/{key}', 'Api\ProductController@search')->name('search_product');
Route::apiResource('slides', 'Api\SliderController')->only('index');