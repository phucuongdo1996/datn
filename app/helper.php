<?php

if (!function_exists('getImageUrl')) {
    /**
     * @param $item
     * @return string
     */
    function getImageUrl($item)
    {
        if ($item['product_base']['type'] == TYPE_SET_CATEGORY) {
            return URL_DOTA_IMAGES_SET . $item['product_base']['image'];
        }
        return ARRAY_URL_ITEM_IMAGES[$item['product_base']['category_id']] . $item['product_base']['image'];
    }
}
