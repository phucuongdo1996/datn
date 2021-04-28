<?php

/**
 * Định nghĩa tên các Routes.
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
const USER_SELL_ITEM = 'user.sell.item';
const USER_WITHDRAW_ITEM = 'user.withdraw.item';
const USER_BUY_ITEM = 'user.buy.item';
const USER_VALIDATE_SELL_ITEM = 'user.validate.sell.item';
const USER_BUY_STEAM_CODE = 'user.buy.steam.code';

const ADMIN_INDEX = 'admin.index';
const ADMIN_EDIT_PRODUCT = 'admin.edit.product';
const ADMIN_ADD_STEAM_CODE = 'admin.add.steam.code';

/**
 * Loại sản phẩm.
 */
const TYPE_ITEM_CATEGORY = 1; // Set dota
const TYPE_SET_CATEGORY = 2; // Item dota

/**
 * Mảng màu.
 */
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
 * URL path Lưu file ảnh.
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

const URL_USER_AVATAR = 'images/avatar_user/';

/**
 * Số bản ghi tối đa.
 */
const MAX_RECORDS_PAGINATE = 30;

/**
 * Trạng thái Session flash.
 */
const STR_FLASH_SUCCESS = 'flash_success';
const STR_FLASH_ERROR = 'flash_error';

/**
 * Trạng thái sản phẩm trên Market.
 */
const TRADE_CANCELED = 0; // Đã huỷ
const TRADE_SELLING = 1; // Đang bán
const TRADE_DONE = 2; // Hoàn tất

const FLAG_ZERO = 0;

/**
 * Tên & màu đặc biệt của sản phẩm.
 */
const SPECIAL_TEXT = ['Common', 'Uncommon', 'Rare', 'Mythical', 'Immortal', 'Legendary', 'Ancient']; // Tên đặc biệt
const SPECIAL_COLOR = ['unset', '#99CCFF', '#3333FF', '#6600CC', '#FF9900', '#FF33CC', '#FF3300']; // Màu đặc biệt

/**
 * Loại doanh thu.
 */
const REVENUE_AGENCY = 1; // Doanh thu từ trung gian giao dịch
const REVENUE_STEAM_CODE = 2; // Doanh thu từ Steam code

/**
 * Lịch sử giao dịch : Loại giao dịch.
 */
const USER_HISTORY_BUY_ITEM = 1; // Mua sản phẩm
const USER_HISTORY_SELL_ITEM = 2; // Bán sản phẩm
const USER_HISTORY_BUY_STEAM_CODE = 3; // Mua stean code
const USER_HISTORY_RECHARGE_MONEY = 4; // Nạp tài khoản.

const STEAM_CODE_5 = 1;
const STEAM_CODE_10 = 2;
const STEAM_CODE_20 = 3;
const STEAM_CODE_50 = 4;
const STEAM_CODE_100 = 5;
const STEAM_CODE_200 = 6;
const STEAM_CODE_250 = 7;

const STEAM_CODE_ARRAY = [
    STEAM_CODE_5 => 'steam_code_5.jpeg',
    STEAM_CODE_10 => 'steam_code_10.jpeg',
    STEAM_CODE_20 => 'steam_code_20.jpeg',
    STEAM_CODE_50 => 'steam_code_50.jpeg',
    STEAM_CODE_100 => 'steam_code_100.jpeg',
    STEAM_CODE_200 => 'steam_code_200.jpeg',
    STEAM_CODE_250 => 'steam_code_250.jpeg'
];

const STEAM_CODE_VALUE = [
    STEAM_CODE_5 => '$ 5',
    STEAM_CODE_10 => '$ 10',
    STEAM_CODE_20 => '$ 20',
    STEAM_CODE_50 => '$ 50',
    STEAM_CODE_100 => '$ 100',
    STEAM_CODE_200 => '$ 200',
    STEAM_CODE_250 => '$ 250'
];

const STEAM_CODE_MONEY = [
    STEAM_CODE_5 => 100000,
    STEAM_CODE_10 => 200000,
    STEAM_CODE_20 => 400000,
    STEAM_CODE_50 => 1000000,
    STEAM_CODE_100 => 2000000,
    STEAM_CODE_200 => 4000000,
    STEAM_CODE_250 => 5000000
];

const STEAM_CODE_FAIL = 0;
const STEAM_CODE_READY = 1;
const STEAM_CODE_USED = 2;
