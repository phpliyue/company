<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
 * 雪球社区管理
 */
Route::any('/login','Admin\LoginController@login');//登录
Route::any('/register','Admin\LoginController@register');//注册
Route::any('/logout','Admin\LoginController@logout');//退出
Route::group(['middleware'=>'adminAuth'],function() {
    Route::get('/admin_index', 'Admin\IndexController@index');//后台首页
    Route::get('/shop_goods', 'Shop\GoodsController@goods');//商品列表
    Route::any('/shop_upgoods/{id?}', 'Shop\GoodsController@upgoods');//上架商品
    Route::post('/shop_upload', 'Shop\GoodsController@upload');//上传图片
    Route::get('/shop_cate', 'Shop\CateController@index');//类目
    Route::any('/shop_addcate/{id?}', 'Shop\CateController@addcate');//新增类目
    Route::get('/snow_news','Snow\NewsController@news');//新闻列表
    Route::any('/snow_addnews/{id?}','Snow\NewsController@addnews');//新增新闻
    Route::get('/snow_delnews/{id}','Snow\NewsController@delnews');//删除新闻
});
