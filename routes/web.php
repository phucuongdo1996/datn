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
Route::get('/test', function () {
    dd(strtotime('2021/01/03'), time());
});
Route::get('login', 'Auth\LoginController@create')->name(SHOW_LOGIN);
Route::post('login', 'Auth\LoginController@login')->name(LOGIN);
Route::get('logout', 'Auth\LoginController@logout')->name(LOGOUT);
Route::get('/', 'TopController@index')->name(TOP);
/**
 * Admin routes.
 */
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', 'AdminController@index')->name(ADMIN_INDEX);
        Route::get('/edit-product', 'AdminController@editProduct')->name(ADMIN_EDIT_PRODUCT);
        Route::post('/add-product-new', 'AdminController@addProductNew')->name(ADMIN_ADD_PRODUCT_NEW);
        Route::post('/add-product-best-seller', 'AdminController@addProductBestSeller')->name(ADMIN_ADD_PRODUCT_BEST_SELLER);
        Route::post('/add-product-remarkable', 'AdminController@addProductRemarkable')->name(ADMIN_ADD_PRODUCT_REMARKABLE);
        Route::post('/add-product-new', 'AdminController@addProductNew')->name(ADMIN_ADD_PRODUCT_NEW);
        Route::get('/add-steam-code', 'AdminController@addSteamCode')->name(ADMIN_ADD_STEAM_CODE);
        Route::post('/add-steam-code', 'AdminController@storeSteamCode')->name(ADMIN_STORE_STEAM_CODE);
        Route::delete('/delete-steam-code/{id}', 'AdminController@deleteSteamCode')->name(ADMIN_DELETE_STEAM_CODE);
        Route::post('/get-data-revenue', 'AdminController@getDataRevenue')->name(ADMIN_GET_DATA_REVENUE);
    });
});


/**
 * User routes
 */
Route::prefix('dota')->group(function () {
    /**
     * Global routes
     */
    Route::get('/', 'TopController@index')->name(DOTA_HOME);
    Route::get('/list-item', 'TopController@dotaListItem')->name(DOTA_LIST_ITEM);
    Route::get('/list-set', 'TopController@dotaListSet')->name(DOTA_LIST_SET);
    Route::get('/detail/{id}', 'DotaController@detail')->name(DOTA_DETAIL);
    Route::post('/get-data-detail', 'ChartController@getDataChartDetail');

    /**
     * Auth routes
     */
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/list-item', 'UserController@listItem')->name(USER_LIST_ITEM);
            Route::get('/store-product', 'UserController@storeProduct')->name(USER_STORE_PRODUCT);
            Route::get('/history', 'UserController@history')->name(USER_HISTORY);
            Route::get('/info', 'UserController@info')->name(USER_INFO);
            Route::get('/recharge-money', 'UserController@rechargeMoney')->name(USER_RECHARGE_MONEY);
            Route::post('/validation-sell-item', 'UserController@validateSellItem')->name(USER_VALIDATE_SELL_ITEM);
            Route::post('/sell-item', 'UserController@sellItem')->name(USER_SELL_ITEM);
            Route::post('/withdraw-item', 'UserController@withdrawItem')->name(USER_WITHDRAW_ITEM);
            Route::post('/buy-item', 'UserController@buyItem')->name(USER_BUY_ITEM);
            Route::post('/get-url-bao-kim', 'UserController@getUrlBaoKim');
            Route::post('/buy-steam-code', 'UserController@buySteamCode')->name(USER_BUY_STEAM_CODE);
        });
    });
});
Route::prefix('steam-code')->group(function () {
    Route::get('/', 'SteamCodeController@index')->name(STEAM_CODE_INDEX);
});
