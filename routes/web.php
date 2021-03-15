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

use Illuminate\Support\Facades\Route;

/*
| Web Routes no need to login
*/
Route::get('/', 'TopController@index')->name(TOP);

Route::prefix('dota')->group(function () {
    Route::get('/', 'TopController@dotaHome')->name(DOTA_HOME);
    Route::get('/list-item', 'TopController@dotaListItem')->name(DOTA_LIST_ITEM);
    Route::get('/list-set', 'TopController@dotaListSet')->name(DOTA_LIST_SET);
    Route::get('/detail', 'DotaController@detail')->name(DOTA_DETAIL);
    Route::prefix('user')->group(function () {
        Route::get('/list-item', 'UserController@listItem')->name(USER_LIST_ITEM);
        Route::get('/store-product', 'UserController@storeProduct')->name(USER_STORE_PRODUCT);
        Route::get('/history', 'UserController@history')->name(USER_HISTORY);
        Route::get('/info', 'UserController@info')->name(USER_INFO);
        Route::get('/recharge-money', 'UserController@rechargeMoney')->name(USER_RECHARGE_MONEY);
    });
});
