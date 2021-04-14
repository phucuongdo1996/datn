<?php

/**
 * Define const for route name
 */

const SHOW_LOGIN = 'show.login';
const LOGIN = 'login';
const LOGOUT = 'logout';
const TOP = 'dota';

const DOTA_LIST_ITEM = 'dota.list.item';
const DOTA_LIST_SET = 'dota.list.set';
const DOTA_HOME = 'dota.home';
const DOTA_DETAIL = 'dota.detail';

const STEAM_CODE_INDEX = 'steam.code.index';

const USER_LIST_ITEM = 'user.list.item';
const USER_STORE_PRODUCT = 'user.store.product';
const USER_HISTORY = 'user.history';
const USER_INFO = 'user.info';
const USER_RECHARGE_MONEY = 'user.recharge.money';

const ADMIN_INDEX = 'admin.index';
const ADMIN_EDIT_PRODUCT = 'admin.edit.product';
const ADMIN_ADD_STEAM_CODE = 'admin.add.steam.code';

/**
 * Define const for type item
 */
const TYPE_ITEM_CATEGORY = 1;
const TYPE_SET_CATEGORY = 2;

const ARRAY_COLOR = [
    '#2F868C', '#E56C9B', '#f7a35c', '#0377FF', '#FF0000',
    '#D28CD4', '#90ed7d', '#6AF9C4', '#fdec6d', '#24CBE5',
    '#EF2081', '#91e8e1', '#C1DB05', '#F96E00', '#8085e9',
    '#434348', '#4861BF', '#DFBF1D', '#C9E7B6', '#5219A9',
    '#F2D7D5', '#82E0AA', '#F8C471', '#5D6D7E', '#D98880',
    '#F7DC6F', '#85929E', '#85C1E9', '#27AE60', '#ED7569',
    '#EC9E00', '#95A5A6', '#8E44AD', '#BA4A00', '#1ABC9C',
    '#2E86C1', '#1F618D', '#943126', '#2D6D49', '#B9770E',
    '#ee9900', '#bb1122', '#669933', '#b7e6ea', '#f4bfb0',
    '#f2d4a6', '#e6a8d7', '#673147', '#8b4513', '#c10024'
];
const ARRAY_COLOR_1 = [
    '#2F868C', '#E56C9B', '#f7a35c', '#0377FF', '#FF0000',
];

/**
 * Define const for folder images
 */
const URL_DOTA_IMAGES_ITEM = 'images/dota_images/item/';
const URL_DOTA_IMAGES_ITEM_INFU = 'images/dota_images/item_infu/';
const URL_DOTA_IMAGES_ITEM_TAUNT = 'images/dota_images/item_taunt/';
const URL_DOTA_IMAGES_ITEM_COURIER = 'images/dota_images/courier/';
const URL_DOTA_IMAGES_WARDS = 'images/dota_images/wards/';
const URL_DOTA_IMAGES_SET = 'images/dota_images/set/';
const URL_SLIDE_IMAGES = 'images/slide_images/';
const URL_DOTA_HERO_IMAGES = 'images/dota_images/heros/';

const ARRAY_URL_ITEM_IMAGES = [
    1 => URL_DOTA_IMAGES_ITEM,
    2 => URL_DOTA_IMAGES_ITEM_INFU,
    3 => URL_DOTA_IMAGES_ITEM_TAUNT,
    4 => URL_DOTA_IMAGES_ITEM_COURIER,
    5 => URL_DOTA_IMAGES_ITEM_COURIER,
    6 => URL_DOTA_IMAGES_WARDS,
];

const IMAGES_SLIDES = ['1.png', '2.png', '3.png', '4.png', '5.png', '6.png'];


/**
 * Define const for Session flash
 */
const STR_FLASH_SUCCESS = 'flash_success';
const STR_FLASH_ERROR = 'flash_error';

const TRADE_CANCELED = 0;
const TRADE_SELLING = 1;
const TRADE_DONE = 2;
