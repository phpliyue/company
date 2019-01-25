<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
 * 公众号接口
 */
Route::get('wx_index','Api\WxtoolController@index');//公众号入口
Route::get('setFooterButton','Api\WxtoolController@setFooterButton');//设置底部导航栏
Route::get('delFooter','Api\WxtoolController@delFooter');//删除底部导航栏
