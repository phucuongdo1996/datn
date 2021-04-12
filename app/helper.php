<?php

if (!function_exists('getImageUrl')) {
    /**
     * @param $item
     * @return string
     */
    function getImageUrl($item)
    {
        if (!is_array($item)) {
            if ($item->productBase->type == TYPE_SET_CATEGORY) {
                return URL_DOTA_IMAGES_SET . $item->productBase->image;
            }
            return ARRAY_URL_ITEM_IMAGES[$item->productBase->category_id] . $item->productBase->image;
        }
        if ($item['product_base']['type'] == TYPE_SET_CATEGORY) {
            return URL_DOTA_IMAGES_SET . $item['product_base']['image'];
        }
        return ARRAY_URL_ITEM_IMAGES[$item['product_base']['category_id']] . $item['product_base']['image'];
    }
}

if (!function_exists('convertNumber')) {
    function convertNumber($text)
    {
        return mb_ereg_replace(',', '', $text);
    }
}
