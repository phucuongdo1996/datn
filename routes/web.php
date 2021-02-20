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
Route::get('/dota', 'TopController@dotaHome')->name(DOTA_HOME);
Route::get('/dota/list-item', 'TopController@dotaListItem')->name(DOTA_LIST_ITEM);
