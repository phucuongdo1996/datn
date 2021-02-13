<?php

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use MathPHP\Finance;

if (!function_exists('saveImageInFolder')) {
    /**
     * Save image
     *
     * @param  UploadedFile  $image
     * @param $folderName
     * @param  bool  $update
     * @param  null  $imageName
     * @return array|null
     */
    function saveImageInFolder(UploadedFile $image, $folderName, $update = false, $imageName = null)
    {
        try {
            $imageName = $update ? $imageName : $image->hashName();
            Storage::disk('public')->put('/' . $folderName . '/', $image);
            $imageResize = resizeImage(getimagesize($image));
            Image::make($image->path())->resize($imageResize[FLAG_ZERO], $imageResize[FLAG_ONE])
                ->save(storage_path('/app/public/' . $folderName . '/' . THUMBNAIL_IMAGE_FIRST_NAME . $imageName));
            return [
                'avatar' => $imageName,
                'avatar_thumbnail' => THUMBNAIL_IMAGE_FIRST_NAME . $imageName
            ];
        } catch (\Exception $exception) {
            report($exception);
            return null;
        }
    }
}

if (!function_exists('resizeImage')) {
    /**
     * Resize avatar
     *
     * @param  array  $imageSize
     * @return array
     */
    function resizeImage(array $imageSize)
    {
        do {
            $imageSize[FLAG_ZERO] = $imageSize[FLAG_ZERO] * COEFFICIENT_RESIZE;
            $imageSize[FLAG_ONE] = $imageSize[FLAG_ONE] * COEFFICIENT_RESIZE;
        } while ($imageSize[FLAG_ZERO] > 1000 || $imageSize[FLAG_ONE] > 1000);

        return $imageSize;
    }
}

if (!function_exists('division')) {
    /**
     * @param  float  $value1
     * @param  float  $value2
     * @return float|int
     */
    function division($value1, $value2)
    {
        if (!$value1 || !$value2 || $value1 == "" || $value2 == "" || $value2 == 0) {
            return number_format(0, 2);
        }
        return number_format($value1 / $value2 * 100, 2);
    }
}

if (!function_exists('divisionNumber')) {
    /**
     * @param  float  $value1
     * @param  float  $value2
     * @return float|int
     */
    function divisionNumber($value1, $value2)
    {
        if (!$value1 || !$value2 || $value1 == "" || $value2 == "" || $value2 == 0) {
            return 0;
        }
        return $value1 / $value2;
    }
}

if (!function_exists('displayNumberPage')) {
    /**
     * display number page
     *
     * @param  int  $recordNumber
     * @param  int  $record
     * @return int
     */
    function displayNumberPage($recordNumber, $record)
    {
        $page = FLAG_ONE;
        for ($i = FLAG_ONE; $i <= MAX_NUMBER_PAGE; $i++) {
            $result = ceil($recordNumber / $record);

            if ($result > $i) {
                continue;
            } else {
                $page = $i;
                break;
            }
        }
        return $page;
    }
}

if (!function_exists('removeImagesInFolder')) {
    /**
     * @param $path
     * @param $filename
     */
    function removeImagesInFolder($path, $filename)
    {
        if ($path && $filename) {
            Storage::delete($path . '/' . $filename);
            Storage::delete($path . '/' . THUMBNAIL_IMAGE_FIRST_NAME . $filename);
        }
    }
}

if (!function_exists('convertDateTime')) {
    /**
     * Convert Datetime
     *
     * @param $dateTime
     * @return false|string
     */
    function convertDateTime($dateTime)
    {
        if (($dateTime && $dateTime == "") || $dateTime == null) {
            return "";
        }
        return date("Y/m/d", strtotime($dateTime));
    }
}

if (!function_exists('numberFormatWithUnit')) {
    /**
     * Format number with unit
     *
     * @param $value
     * @param $unit
     * @param  int  $decimal
     * @return string
     */
    function numberFormatWithUnit($value, $unit, $decimal = FLAG_ZERO)
    {
        if ($value && $value == "") {
            return "0" . ' ' . $unit;
        }
        return number_format($value, $decimal) . ' ' . $unit;
    }
}

if (!function_exists('formatArrayOnUrl')) {
    /**
     * format array condition on url
     *
     * @param  array  $array
     *
     * @return string
     */
    function formatArrayOnUrl($array)
    {
        $newString = '';
        foreach ($array as $key => $value) {
            $newString .= '&status%5B' . $key . '%5D=' . $value;
        }
        return $newString;
    }
}

if (!function_exists('getMonthDifferenceNow')) {
    /**
     * get month difference now
     *
     * @param  date-time $date
     *
     * @return float|int
     */
    function getMonthDifferenceNow($date)
    {
        $dateTimeNow = strtotime(date('Y-m-d'));
        $dateTimeLoan = strtotime($date);
        if ($dateTimeLoan > $dateTimeNow) {
            return 0;
        } else {
            return (date('Y', $dateTimeNow) - date('Y', $dateTimeLoan)) * FLAG_MAX_MONTH + date('m', $dateTimeNow) - date(
                'm',
                $dateTimeLoan
            );
        }
    }
}

if (!function_exists('dateTimeFormat')) {
    /**
     * format date time
     *
     * @param date-time $date
     * @return false|string
     */
    function dateTimeFormat($date)
    {
        return date("Y/m/d", strtotime($date));
    }
}

if (!function_exists('dateTimeFormatBorrowing')) {
    /**
     * @param $year
     * @param $month
     * @param $screen
     * @return string
     */
    function dateTimeFormatBorrowing($year, $month, $screen = null)
    {
        $dataReturn = '';
        if ($year) {
            $dataReturn = $dataReturn . $year . trans('attributes.common.year');
        }
        if ($month) {
            $dataReturn = $dataReturn . MONTH[$month];
        }
        if (empty($year) && empty($month) && !$screen) {
            return 'ー';
        }
        return $dataReturn;
    }
}

if (!function_exists('dateTimeFormatTax')) {
    /**
     * @param $year
     * @param $month
     * @return string
     */
    function dateTimeFormatTax($year, $month)
    {
        $dataReturn = '';
        if ($year) {
            $dataReturn = $dataReturn . $year . trans('attributes.common.year');
        }
        if ($month) {
            $dataReturn = $dataReturn . MONTH[$month];
        }
        if (empty($year) && empty($month)) {
            return '';
        }
        return $dataReturn;
    }
}

if (!function_exists('materialFormat')) {
    /**
     * @param $houseMaterial
     * @param $houseRoofType
     * @param  bool  $screen
     * @return string
     */
    function materialFormat($houseMaterial, $houseRoofType, $screen = false)
    {
        if (!empty($houseMaterial) && !empty($houseRoofType)) {
            return $houseMaterial . '/' . $houseRoofType;
        } elseif (!empty($houseMaterial)) {
            return $houseMaterial;
        } elseif (!empty($houseRoofType)) {
            return $houseRoofType;
        } else {
            return $screen ? '' : 'ー';
        }
    }
}

if (!function_exists('nameFormat')) {
    /**
     * @param  string  $firstName
     * @param  string  $lastName
     * @return string
     */
    function nameFormat($lastName = '', $firstName = '')
    {
        if (!empty($lastName) || !empty($firstName)) {
            return ltrim($lastName . ' ' . $firstName);
        }
        return 'ー';
    }
}

if (!function_exists('addressFormat')) {
    /**
     * @param  string  $addressCity
     * @param  string  $addressDistrict
     * @param  string  $addressTown
     * @param  string  $apartmentNumber
     * @param  string  $roomNumber
     * @return string
     */
    function addressFormat(
        $addressCity = '',
        $addressDistrict = '',
        $addressTown = '',
        $apartmentNumber = '',
        $roomNumber = ''
    ) {
        if (!empty($addressCity) || !empty($addressDistrict) || !empty($addressTown) || !empty($apartmentNumber) || !empty($roomNumber)) {
            return ltrim($addressCity . ' ' . $addressDistrict . ' ' . $addressTown . ' ' . $apartmentNumber . ' ' . $roomNumber, ' ');
        }
        return 'ー';
    }
}

if (!function_exists('getNumberYearPassed')) {
    /**
     * get number year passed
     *
     * @param date-time $date
     * @return float
     */
    function getNumberYearPassed($date)
    {
        if (!strtotime($date)) {
            return 0;
        }
        $dateTimeNow = strtotime(date('Y-m-d'));
        $dateTimeLoan = strtotime($date);
        return floor(($dateTimeNow - $dateTimeLoan) / TIME_YEAR_SECONDS);
    }
}

if (!function_exists('getValueByListLimited')) {
    /**
     * get value by list limited
     *
     * @param  int  $realEstateTypeId
     * @param  int  $value
     * @return string
     */
    function getValueByListLimited($realEstateTypeId, $value)
    {
        switch ($realEstateTypeId) {
            case "1":
                if ($value < 3000) {
                    return trans('attributes.balance.limited.office.less_than_3000');
                } elseif ($value >= 3000 && $value < 10000) {
                    return trans('attributes.balance.limited.office.from_3000_to_10000');
                } elseif ($value >= 10000 && $value < 30000) {
                    return trans('attributes.balance.limited.office.from_10000_to_30000');
                } else {
                    return trans('attributes.balance.limited.office.greater_than_30000');
                }
            case "2":
                if ($value < 2000) {
                    return trans('attributes.balance.limited.residence_housing.less_than_2000');
                } elseif ($value >= 2000 && $value < 3000) {
                    return trans('attributes.balance.limited.residence_housing.from_2000_to_3000');
                } elseif ($value >= 3000 && $value < 5000) {
                    return trans('attributes.balance.limited.residence_housing.from_3000_to_5000');
                } else {
                    return trans('attributes.balance.limited.residence_housing.greater_than_5000');
                }
            case "3":
                if ($value < 1000) {
                    return trans('attributes.balance.limited.retail_store.less_than_1000');
                } elseif ($value >= 1000 && $value < 10000) {
                    return trans('attributes.balance.limited.retail_store.from_1000_to_10000');
                } else {
                    return trans('attributes.balance.limited.retail_store.greater_than_10000');
                }
            default:
                if ($value < 5000) {
                    return trans('attributes.balance.limited.other.less_than_5000');
                } elseif ($value >= 5000 && $value < 10000) {
                    return trans('attributes.balance.limited.other.from_5000_to_10000');
                } else {
                    return trans('attributes.balance.limited.other.greater_than_10000');
                }
        }
    }
}

if (!function_exists('getValueByListLimitedToSql')) {
    /**
     * Get value by list limited to sql
     *
     * @param $realEstateTypeId
     * @param $attribute
     * @param $value
     * @return string
     */
    function getValueByListLimitedToSql($realEstateTypeId, $attribute, $value)
    {
        switch ($realEstateTypeId) {
            case "1":
                if ($value < 3000) {
                    return $attribute . ' < 3000';
                } elseif ($value >= 3000 && $value < 10000) {
                    return $attribute . ' >= 3000 and ' . $attribute . ' < 10000';
                } elseif ($value >= 10000 && $value < 30000) {
                    return $attribute . ' >= 10000 and ' . $attribute . ' < 30000';
                } else {
                    return $attribute . ' >= 30000';
                }
            case "2":
                if ($value < 2000) {
                    return $attribute . ' < 2000';
                } elseif ($value >= 2000 && $value < 3000) {
                    return $attribute . ' >= 2000 and ' . $attribute . ' < 3000';
                } elseif ($value >= 3000 && $value < 5000) {
                    return $attribute . ' >= 3000 and ' . $attribute . ' < 5000';
                } else {
                    return $attribute . ' >= 5000';
                }
            case "3":
                if ($value < 1000) {
                    return $attribute . ' < 1000';
                } elseif ($value >= 1000 && $value < 10000) {
                    return $attribute . ' >= 1000 and ' . $attribute . ' < 10000';
                } else {
                    return $attribute . ' >= 10000';
                }
            default:
                if ($value < 5000) {
                    return $attribute . ' < 5000';
                } elseif ($value >= 5000 && $value < 10000) {
                    return $attribute . ' >= 5000 and ' . $attribute . ' < 10000';
                } else {
                    return $attribute . ' >= 10000';
                }
        }
    }
}

if (!function_exists('getYearByListLimited')) {
    /**
     * get year by list limited
     *
     * @param  int  $realEstateTypeId
     * @param  int  $value
     * @return string
     */
    function getYearByListLimited($realEstateTypeId, $value)
    {
        switch ($realEstateTypeId) {
            case "1":
            case "3":
                if ($value < 10) {
                    return trans('attributes.balance.year_limited.less_than_10');
                } elseif ($value >= 10 && $value < 20) {
                    return trans('attributes.balance.year_limited.from_10_to_20');
                } elseif ($value >= 20 && $value < 30) {
                    return trans('attributes.balance.year_limited.from_20_to_30');
                } else {
                    return trans('attributes.balance.year_limited.greater_than_30');
                }
            case "2":
                if ($value < 10) {
                    return trans('attributes.balance.year_limited.less_than_10');
                } elseif ($value >= 10 && $value < 20) {
                    return trans('attributes.balance.year_limited.from_10_to_20');
                } else {
                    return trans('attributes.balance.year_limited.greater_than_20');
                }
            default:
                if ($value < 20) {
                    return trans('attributes.balance.year_limited.less_than_20');
                } else {
                    return trans('attributes.balance.year_limited.greater_than_20');
                }
        }
    }
}

if (!function_exists('getDecade')) {
    /**
     * get decade
     *
     * @param date-time $date
     * @return false|int|string
     */
    function getDecade($date)
    {
        $year = date("Y", strtotime($date));
        return $year - ($year % 10);
    }
}

if (!function_exists('convertStringToNumber')) {
    /**
     * get decade
     *
     * @param date-time $date
     * @return false|int|string
     */
    function convertStringToNumber($string)
    {
        if (!$string || $string == "") {
            return 0;
        }
        return str_replace(',', '', $string);
    }
}

if (!function_exists('sumRentalIncome')) {
    /**
     * sum rental income
     *
     * @param  array  $data
     * @return float|int
     */
    function sumRentalIncome($data)
    {
        return $data['revenue_land_taxes'] + $data['revenue_room_rentals'] + $data['revenue_service_charges'];
    }
}

if (!function_exists('basisCalculationBusinessPlan')) {
    /**
     * basis calculation business plan
     *
     * @param  int  $money
     * @param  int  $acreage
     * @param  int  $month
     * @return float|int
     */
    function basisCalculationBusinessPlan($money, $acreage, $month = FLAG_MIN_MONTH)
    {
        if ($acreage == FLAG_ZERO) {
            return FLAG_ZERO;
        }
        return round($money / $month / convertStringToNumber($acreage));
    }
}

if (!function_exists('calculationPercentBusinessPlan')) {
    /**
     * basis calculation business plan
     *
     * @param  int  $moneyOne
     * @param  int  $moneyTwo
     * @param  string  $unit
     * @param  int  $decimal
     * @return float|int
     */
    function calculationPercentBusinessPlan($moneyOne, $moneyTwo, $decimal = FLAG_TWO)
    {
        if ($moneyTwo == FLAG_ZERO) {
            return '0.00';
        }
        return number_format(($moneyOne / convertStringToNumber($moneyTwo)) * FLAG_ONE_HUNDRED, $decimal);
    }
}

if (!function_exists('getYearLabel')) {
    /**
     * @param $year
     * @return string
     */
    function getYearLabel($year)
    {
        $formatter = new IntlDateFormatter(
            'ja_JP@calendar=japanese',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            'Europe/Madrid',
            IntlDateFormatter::TRADITIONAL,
            'Gy' //Age and year (regarding the age)
        );
        $data = '';

        if ($year) {
            $data = $formatter->format(strtotime($year . '-01-01 Europe/Madrid'));
            $yearNumber = (int)filter_var($data, FILTER_SANITIZE_NUMBER_INT);
            if (strpos($data, HEISEI_LABEL) !== false && $yearNumber > HEISEI_YEAR_MAX) {
                return REIWA_LABEL;
            } else {
                for ($i = 0; $i < count(LIST_YEAR_LABEL); $i++) {
                    if (strpos($data, LIST_YEAR_LABEL[$i]) !== false) {
                        return LIST_YEAR_LABEL[$i];
                        break;
                    }
                }
            }
        }
        return $data;
    }
}

if (!function_exists('getDateAndTheLabel')) {
    /**
     * @param $year
     * @param  null  $type
     * @return string
     */
    function getDateAndTheLabel($year, $type = null)
    {
        $formatter = new IntlDateFormatter(
            'ja_JP@calendar=japanese',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            'Europe/Madrid',
            IntlDateFormatter::TRADITIONAL,
            'Gy' //Age and year (regarding the age)
        );
        $data = '';

        if ($type) {
            $data = $formatter->format(strtotime($year . '-01-01 Europe/Madrid'));
            $yearNumber = (int)filter_var($data, FILTER_SANITIZE_NUMBER_INT);
            if (strpos($data, HEISEI_LABEL) !== false && $yearNumber > HEISEI_YEAR_MAX) {
                $dataYear = ($yearNumber - HEISEI_YEAR_MAX + 1);
                ($dataYear <= 10) ? $data = '0' . $dataYear : $dataYear;
                return '令和' . $data;
            }
            return $data;
        }
        return $data;
    }
}

if (!function_exists('getDateNumberTheLabel')) {
    /**
     * @param $year
     * @return string
     */
    function getDateNumberTheLabel($year)
    {
        $formatter = new IntlDateFormatter(
            'ja_JP@calendar=japanese',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            'Europe/Madrid',
            IntlDateFormatter::TRADITIONAL,
            'Gy' //Age and year (regarding the age)
        );
        $data = '';

        if ($year) {
            $data = $formatter->format(strtotime($year . '-01-01 Europe/Madrid'));
            $yearNumber = (int)filter_var($data, FILTER_SANITIZE_NUMBER_INT);
            if (strpos($data, HEISEI_LABEL) !== false && $yearNumber > HEISEI_YEAR_MAX) {
                $dataYear = ($yearNumber - HEISEI_YEAR_MAX + 1);
                ($dataYear <= 10) ? $data = '0' . $dataYear : $dataYear;
                return $data;
            }
            return (int)filter_var($data, FILTER_SANITIZE_NUMBER_INT);
        } else {
            return $data;
        }
    }
}

if (!function_exists('getDayOfMonth')) {
    /**
     * @param  int  $month
     * @param  null  $year
     * @return int
     */
    function getDayOfMonth($month, $year = null)
    {
        if (!empty($month)) {
            return date('t', mktime(0, 0, 0, $month, 1, empty($year) ? '2019' : $year));
        }
        return '';
    }
}

if (!function_exists('handlingParamUrl')) {
    /**
     * function handling data pagination
     *
     * @param $param
     * @return array
     */
    function handlingParamUrl($param)
    {
        if (isset($param['screen']) && $param['screen'] == 'property') {
            return ['screen' => $param['screen'], 'perPage' => LIMIT_RECORD_LIST_HOUSE_DEFAULT];
        }
        if (isset($param['screen']) && $param['screen'] == 'report') {
            return ['screen' => $param['screen'], 'perPage' => isset($param['option_paginate']) &&
            in_array($param['option_paginate'], array_keys(LIST_OPTION_PAGINATE)) ? $param['option_paginate'] : LIMIT_RECORD_DEFAULT];
        }

        return ['screen' => 'report', 'perPage' => LIMIT_RECORD_DEFAULT];
    }
}

if (!function_exists('getRedirectName')) {
    /**
     * function get name redirect
     *
     * @param  int  $pageIndex
     * @param  array  $request
     * @return string
     */
    function getRedirectName($pageIndex, $request)
    {
        $redirect = 'report';
        $request['option_paginate'] = $request['option_paginate'] ?? LIMIT_RECORD_DEFAULT;
        if (isset($request['screen_annual_performance']) && $request['screen_annual_performance'] == 'annual-performance') {
            return '/annual-performance?option_paginate=' . $request['option_paginate'] . '&page=' . $pageIndex;
        }
        if ($request['screen'] == 'property') {
            $redirect = 'property?page=' . $pageIndex;
        } elseif ($request['screen'] == 'report') {
            $redirect = 'report?option_paginate=' . $request['option_paginate'] . '&page=' . $pageIndex;
        }
        return $redirect;
    }
}

if (!function_exists('buttonBackPages')) {
    /**
     * @param  array  $params
     * @param  null  $propertyId
     * @return string
     */
    function buttonBackPages($params, $propertyId = null)
    {
        if (isset($params['screen'])) {
            switch ($params['screen']) {
                case 'report':
                    if (empty($params['option_paginate']) || empty($params['page'])) {
                        return route(USER_REPORT);
                    }
                    return route(
                        USER_REPORT,
                        ['option_paginate' => $params['option_paginate'], 'page' => $params['page']]
                    );
                    break;
                case 'property':
                    if (empty($params['page'])) {
                        return route(USER_PROPERTY_INDEX);
                    }
                    return route(USER_PROPERTY_INDEX, ['page' => $params['page']]);
                    break;
                case 'list_repair_history':
                    if (empty($params['option_paginate']) || empty($params['page'])) {
                        return route(USER_REPAIR_HISTORY);
                    }
                    return route(
                        USER_REPAIR_HISTORY,
                        [$propertyId, 'option_paginate' => $params['option_paginate'], 'page' => $params['page']]
                    );
                    break;
                case 'list_rent_rolls':
                    if (empty($params['date_year']) || empty($params['date_month'])) {
                        return route(USER_PROPERTY_RENT_ROLL_INDEX, $propertyId);
                    }
                    return route(
                        USER_PROPERTY_RENT_ROLL_INDEX,
                        [$propertyId, 'date_year' => $params['date_year'], 'date_month' => $params['date_month']]
                    );
                    break;
                case 'monthly-balance':
                    if (empty($params['date_year'])) {
                        return route(USER_PROPERTY_MONTHLY_BALANCE_INDEX, [$propertyId]);
                    }
                    return route(
                        USER_PROPERTY_MONTHLY_BALANCE_INDEX,
                        [$propertyId, 'date_year' => $params['date_year']]
                    );
                    break;
                case 'annual-performance':
                    if (empty($params['option_paginate']) || empty($params['page'])) {
                        return route(USER_PROPERTY_ANNUAL_PERFORMANCE_INDEX, [$propertyId]);
                    }
                    return route(
                        USER_PROPERTY_ANNUAL_PERFORMANCE_INDEX,
                        [$propertyId, 'option_paginate' => $params['option_paginate'], 'page' => $params['page']]
                    );
                    break;
                case 'search_bank':
                    $url = [];
                    foreach (ITEM_URL_SEARCH as $item) {
                        if (array_key_exists($item, $params)) {
                            $url[$item] = $params[$item];
                        }
                    }
                    return route(USER_PROPERTY_SEARCH, $url);
                default:
                    return route(USER_REPORT);
                    break;
            }
        }
        return route(USER_HOME);
    }
}

if (!function_exists('buttonBackTopicPages')) {
    /**
     * @param  array  $params
     *
     * @return string
     */
    function buttonBackTopicPages($params)
    {
        if (isset($params['screen'])) {
            switch ($params['screen']) {
                case 'article_text':
                    if (empty($params['option_paginate']) || empty($params['page'])) {
                        return route(USER_ARTICLE_TEXT);
                    }
                    return route(
                        USER_ARTICLE_TEXT,
                        ['option_paginate' => $params['option_paginate'], 'page' => $params['page']]
                    );
                case 'my_page':
                    $dataReturn = '';
                    if (Auth::user()->role == EXPERT) {
                        $dataReturn = 'expert';
                    } elseif (Auth::user()->role == BROKER) {
                        $dataReturn = 'broker';
                    }
                    return route(MY_PAGE, [$dataReturn, Auth::user()->id]);
                case 'photo_list':
                    if (empty($params['page'])) {
                        return route(USER_PHOTO_ARCHIVE_INDEX);
                    }
                    return route(USER_PHOTO_ARCHIVE_INDEX, ['page' => $params['page']]);
                case 'topic_list':
                    $userId = Auth::user()->id;
                    if (empty($params['page'])) {
                        return route(LIST_TOPIC, $userId);
                    }
                    return route(LIST_TOPIC, ['id' => $userId, 'page' => $params['page']]);
                case 'photos':
                    if (empty($params['page']) || empty($params['screen'])) {
                        return route(USER_LIST_PHOTO_INDEX, ['id' => $params['id']]);
                    }
                    return route(USER_LIST_PHOTO_INDEX, ['id' => $params['id'], 'page' => $params['page']]);
                default:
                    return route(USER_ARTICLE_TEXT);
                    break;
            }
        }
        return route(USER_HOME);
    }
}

if (!function_exists('dateYear')) {
    /**
     * date year to 1950 from date year current
     *
     * @return array
     */
    function dateYear()
    {
        return range(DATE_YEAR_MIN, date('Y'));
    }
}

if (!function_exists('displayNumberFloorAndRooms')) {
    /**
     * Display number floor and rooms
     *
     * @param  string  $floor
     * @param  string  $rooms
     * @return string
     */
    function displayNumberFloorAndRooms($floor, $rooms)
    {
        if (!empty($floor) && !empty($rooms)) {
            return $floor . ' / ' . $rooms;
        } elseif (!empty($floor)) {
            return $floor;
        } elseif (!empty($rooms)) {
            return $rooms;
        } else {
            return 'ー';
        }
    }
}

if (!function_exists('calculationMonthBetweenTwoTimeParts')) {
    /**
     * calculation month between two time parts
     *
     * @param date-time $contractStartDate
     * @param date-time $contractEndDate
     * @return false|float|int|string
     */
    function calculationMonthBetweenTwoTimeParts($contractStartDate, $contractEndDate)
    {
        if (!isset($contractStartDate) || strtotime($contractStartDate) > strtotime($contractEndDate)) {
            return 'ー';
        }

        $start = DateTime::createFromFormat('Y-m-d', date($contractStartDate));
        $end = DateTime::createFromFormat('Y-m-d', date($contractEndDate))->modify('+1 day');
        $diff = $start->diff($end);
        $year = $diff->format('%y');
        $month = $diff->format('%m');

        if ($year == FLAG_ZERO) {
            return $month . 'ヶ月';
        } elseif ($month == FLAG_ZERO) {
            return $year . '年';
        } else {
            return $year . '年' . $month . 'ヶ月';
        }
    }
}

if (!function_exists('statsStandardDeviation')) {
    /**
     * This user-land implementation follows the implementation quite strictly;
     * it does not attempt to improve the code or algorithm in any way. It will
     * raise a warning if you have fewer than 2 values in your array, just like
     * the extension does (although as an E_USER_WARNING, not E_WARNING).
     *
     * @param  array  $a
     * @param  bool  $sample  [optional] Defaults to false
     * @return float|bool The standard deviation or false on error.
     */
    function statsStandardDeviation(array $a, $sample = false)
    {
        $n = count($a);
        if ($n === 0) {
            trigger_error("The array has zero elements", E_USER_WARNING);
            return false;
        }
        if ($sample && $n === 1) {
            trigger_error("The array has only 1 element", E_USER_WARNING);
            return false;
        }
        $mean = array_sum($a) / $n;
        $carry = 0.0;
        foreach ($a as $val) {
            $d = ((double)$val) - $mean;
            $carry += $d * $d;
        };
        if ($sample) {
            --$n;
        }
        return sqrt($carry / $n);
    }
}

if (!function_exists('listDateYear')) {
    /**
     * date year to date year current from 1950
     *
     * @return array
     */
    function listDateYear()
    {
        return range(date('Y'), DATE_YEAR_MIN);
    }
}

if (!function_exists('listDateMonth')) {
    /**
     * date year to 1 from 12
     *
     * @return array
     */
    function listDateMonth()
    {
        return range(FLAG_MIN_MONTH, FLAG_MAX_MONTH);
    }
}

if (!function_exists('setArrayDateMonth')) {
    /**
     * set array date month
     *
     * @param $month
     * @return array|false
     */
    function setArrayDateMonth($month)
    {
        $key = range(FLAG_ONE, FLAG_TWELVE);
        if ($month == DEC) {
            $val = range(JAN, DEC);

            return array_combine($key, $val);
        } else {
            $valOne = range($month + FLAG_ONE, DEC);
            $valTwo = range(JAN, $month);

            return array_combine($key, array_merge($valOne, $valTwo));
        }
    }
}

if (!function_exists('displayUnitByType')) {
    /**
     * display unit by type
     *
     * @param  integer  $acreage
     * @param  integer  $type
     * @return float|int
     */
    function displayUnitByType($acreage, $type)
    {
        if ($type == FLAG_ONE_HUNDRED) {
            return floor($acreage / FLAG_ONE_HUNDRED) * FLAG_ONE_HUNDRED;
        }
        return floor($acreage / FLAG_ONE_THOUSAND) * FLAG_ONE_THOUSAND;
    }
}

if (!function_exists('handlingCheckbox')) {
    /**
     * handling check box
     *
     * @param  string  $value
     * @param  array  $params
     * @param  string  $key
     * @return string
     */
    function handlingCheckbox($value, $params, $key)
    {
        return isset($params[$key]) && in_array($value, $params[$key]) ? 'checked' : '';
    }
}

if (!function_exists('displayItemSearch')) {
    /**
     * display item search
     *
     * @param $params
     * @return array
     */
    function displayItemSearch($params)
    {
        $area = isset($params['area']) ? in_array(DATA_ALL, $params['area']) ? DATA_ALL : implode(
            ', ',
            $params['area']
        ) : '';
        $totalFloorArea = isset($params['total_floor_area']) ? in_array(
            DATA_ALL,
            $params['total_floor_area']
        ) ? DATA_ALL : implode(', ', $params['total_floor_area']) : '';
        $houseLongevity = isset($params['house_longevity']) ? in_array(
            DATA_ALL,
            $params['house_longevity']
        ) ? DATA_ALL : implode(', ', $params['house_longevity']) : '';

        return [$params['real_estate_type_search'], $area, $totalFloorArea, $houseLongevity];
    }
}

if (!function_exists('getDateByHouseLongevity')) {
    /**
     * get number year passed
     *
     * @param date-time $date
     * @return float
     */
    function getDateByHouseLongevity($houseLongevity)
    {
        return "'" . date('Y-m-d', strtotime(date('Y-m-d')) - ($houseLongevity * TIME_YEAR_SECONDS)) . "'";
    }
}

if (!function_exists('setMaxLength')) {
    /**
     * Set max length
     * @param $value
     * @param $maxLength
     * @return string
     */
    function setMaxLength($value, $maxLength)
    {
        if (mb_strlen($value) > $maxLength) {
            return mb_substr($value, FLAG_ZERO, $maxLength) . '...';
        }
        return $value;
    }
}

if (!function_exists('formatFileName')) {
    /**
     * Format file name with special characters
     *
     * @param  string  $str  file name
     *
     * @return mixed
     */
    function formatFileName($str)
    {
        return str_replace(['\\', '/', ':', '*', '?', '"', '<', '>', '|'], '_', $str);
    }
}

if (!function_exists('characterFormat')) {
    /**
     * character format
     *
     * @param  array  $character
     * @return string
     */
    function characterFormat($character)
    {
        return implode(", ", array_column($character, 'name'));
    }
}

if (!function_exists('showSelectedValue')) {
    /**
     * @param $value
     * @param $arrayValue
     * @param $defaultValues
     * @return mixed
     */
    function showSelectedValue($value, $arrayValue, $defaultValues)
    {
        if ($value && in_array($value, $arrayValue)) {
            return $value;
        }
        return $defaultValues;
    }
}

if (!function_exists('compareValueRevenue')) {
    /**
     * compare value revenue
     *
     * @param $annual
     * @param $monthly
     * @return string
     */
    function compareValueRevenue($annual, $monthly)
    {
        return (int)$annual !== (int)$monthly ? 'error-flag' : '';
    }
}

if (!function_exists('setTimeLine')) {
    /**
     * @param $monthlyRegister
     * @return array
     */
    function setTimeLine($monthlyRegister)
    {
        if ($monthlyRegister == DEC) {
            return ['month_start' => JAN, 'month_end' => DEC];
        } else {
            return ['month_start' => $monthlyRegister + FLAG_MIN_MONTH, 'month_end' => (int)$monthlyRegister];
        }
    }
}

if (!function_exists('checkDayExitsInMonth')) {
    /**
     * check day exits in month
     *
     * @param $day
     * @return string
     */
    function checkDayExitsInMonth($day)
    {
        $lastDayMonth = Carbon::now()->addMonth()->endOfMonth()->toDateString();

        if ((int)$day > (int)date("d", strtotime($lastDayMonth))) {
            return $lastDayMonth;
        }
        return date("yy-m", strtotime($lastDayMonth)) . (strlen((string)$day) == FLAG_ONE ? '-0' . $day : '-' . $day);
    }
}

if (!function_exists('getDayInNextMonth')) {
    /**
     * Get day in next month
     *
     * @param $date
     * @return string
     */
    function getDayInNextMonth($date)
    {
        $lastDayMonth = Carbon::create(date('Y', strtotime($date)), (int)date('m', strtotime($date)) + 1, FLAG_ONE)->endOfMonth()->toDateString();
        $day = date('d', strtotime($date));
        if ((int)$day > (int)date("d", strtotime($lastDayMonth))) {
            return $lastDayMonth;
        }
        return date("yy-m", strtotime($lastDayMonth)) . (strlen((string)$day) == FLAG_ONE ? '-0' . $day : '-' . $day);
    }
}

if (!function_exists('displayAmountByMemberAndRole')) {
    /**
     * display amount by member and role
     *
     * @param $statusMember
     * @param $role
     * @return int
     */
    function displayAmountByMemberAndRole($statusMember, $role)
    {
        switch ($statusMember) {
            case FREE:
                return FLAG_ZERO;
            case BASIC:
            case TRIALS:
                return $role == INVESTOR ? MONEY_BASIC_BY_INVESTOR : MONEY_BASIC_BY_BROKER_EXPERT;
            case PREMIUM:
                return $role == INVESTOR ? MONEY_PREMIUM_BY_INVESTOR : MONEY_PREMIUM_BY_BROKER_EXPERT;
            default:
                break;
        }
    }
}

if (!function_exists('countAmountPaidAnnually')) {
    /**
     * Public function count amount paid annually
     *
     * @param float $loan
     * @param float $contractLoanPeriod
     * @param float $interestRate
     * @return int
     */
    function countAmountPaidAnnually($loan, $contractLoanPeriod, $interestRate)
    {
        if (empty($loan) || empty($contractLoanPeriod) || empty($interestRate)) {
            return 0;
        } else {
            $temp = pow((1 + $interestRate / 100), $contractLoanPeriod);
            return round($loan * $interestRate / 100 * divisionNumber($temp, ($temp - 1)) + divisionNumber($interestRate / 100, ($temp - 1)) * 0);
        }
    }
}

if (!function_exists('targetUserId')) {
    /**
     * Get id real user action
     *
     * @return mixed
     */
    function targetUserId()
    {
        $user = Auth::user();
        return $user->isSubuser() ? $user['parent_id'] : $user['id'];
    }
}

if (!function_exists('pmt')) {
    /**
     * pmt
     *
     * @param $interestRate
     * @param $contractLoanPeriod
     * @param $loan
     * @return int|string
     */
    function pmt($interestRate, $contractLoanPeriod, $loan)
    {
        return !empty(($interestRate) && ($loan)) ? -Finance::pmt(
            $interestRate / 100,
            $contractLoanPeriod,
            $loan,
            0,
            0
        ) : "";
    }
}

if (!function_exists('excelPMT')) {
    /**
     * PMT
     *
     * @param $rate
     * @param $nper
     * @param $pv
     * @param $fv
     * @param $type
     * @return float|int
     */
    function excelPMT($rate, $nper, $pv, $fv, $type)
    {
        if (!$fv) {
            $fv = 0;
        }
        if (!$type) {
            $type = 0;
        }

        if ($rate == 0) {
            return -($pv + $fv) / $nper;
        }

        $pvif = pow(1 + $rate, $nper);
        $pmt = $rate / ($pvif - 1) * -($pv * $pvif + $fv);

        if ($type == 1) {
            $pmt /= (1 + $rate);
        }
        return $pmt;
    }
}

if (!function_exists('excelFV')) {
    /**
     * FV
     *
     * @param $rate
     * @param $nper
     * @param $pmt
     * @param $pv
     * @param $type
     * @return float|int
     */
    function excelFV($rate, $nper, $pmt, $pv, $type)
    {
        if (!$type) {
            $type = 0;
        }

        $pow = pow(1 + $rate, $nper);
        $fv = 0;

        if ($rate) {
            $fv = ($pmt * (1 + $rate * $type) * (1 - $pow) / $rate) - $pv * $pow;
        } else {
            $fv = -1 * ($pv + $pmt * $nper);
        }
        return $fv;
    }
}

if (!function_exists('excelCUMPRINC')) {
    /**
     * CUMPRINC
     *
     * @param $rate
     * @param $periods
     * @param $value
     * @param $start
     * @param $end
     * @param $type
     * @return float|int
     */
    function excelCUMPRINC($rate, $periods, $value, $start, $end, $type)
    {
        if ($rate <= 0 || $periods <= 0 || $value <= 0) {
            return 0;
        }

        // Return error if start < 1, end < 1, or start > end
        if ($start < 1 || $end < 1 || $start > $end) {
            return 0;
        }

        // Return error if type is neither 0 nor 1
        if ($type !== 0 && $type !== 1) {
            return 0;
        }

        // Compute cumulative principal
        $payment = excelPMT($rate, $periods, $value, 0, $type);
        $principal = 0;
        if ($start === 1) {
            if ($type === 0) {
                $principal = $payment + $value * $rate;
            } else {
                $principal = $payment;
            }
            $start++;
        }
        for ($i = $start; $i <= $end; $i++) {
            if ($type > 0) {
                $principal += $payment - (excelFV($rate, $i - 2, $payment, $value, 1) - $payment) * $rate;
            } else {
                $principal += $payment - excelFV($rate, $i - 1, $payment, $value, 0) * $rate;
            }
        }
        // Return cumulative principal
        return $principal;
    }
}
if (!function_exists('roundAmount')) {
    /**
     * round amount
     *
     * @param $amount
     * @return int
     */
    function roundAmount($amount)
    {
        return $amount < FLAG_FIFTY ? FLAG_ZERO : FLAG_ONE_HUNDRED;
    }
}

if (!function_exists('dateDif')) {
    /**
     * @param $dateStart
     * @param null $dateEnd
     * @return string
     */
    function dateDif($dateStart, $dateEnd = null)
    {
        $start = DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime($dateStart)));
        $end = $dateEnd ?? DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
        return $start->diff($end)->format('%y');
    }
}

if (!function_exists('convertDateToString')) {
    /**
     * @param $date
     * @param null $dateDefault
     * @return string
     */
    function convertDateToString($date, $dateDefault = null)
    {
        if (!isset($date) && isset($dateDefault)) {
            $date = $dateDefault;
        }
        $dateValue = strtotime($date);
        return date('Y', $dateValue) . trans('attributes.common.year') . date('m', $dateValue) . trans('attributes.common.month') . date('d', $dateValue) . trans('attributes.common.day');
    }
}

if (!function_exists('excelRound')) {
    /**
     * @param $value
     * @param $places
     * @return string
     */
    function excelRound($value, $places)
    {
        $pow = pow(FLAG_TEN, -$places);
        return round($value / $pow) * $pow;
    }
}

if (!function_exists('excelRoundDown')) {
    /**
     * @param $value
     * @return string
     */
    function excelRoundDown($value)
    {
        if ($value < FLAG_ZERO) {
            return FLAG_ZERO;
        }
        $value = FLOOR($value);
        $pow = pow(FLAG_TEN, 1 - strlen($value));
        return FLOOR($value * $pow) / $pow;
    }
}

if (!function_exists('getImageArticle')) {
    /**
     * @param $images
     * @return string
     */
    function getImageArticle($images)
    {
        foreach ($images as $image) {
            if (isset($image)) {
                return PATH_SRC_ARTICLE_PHOTO . $image;
            }
        }
        return asset('images/user_default.png');
    }
}

if (!function_exists('getAmountFee')) {
    function getAmountFee($role, $memberStatus, $totalSub, $discount)
    {
        $amountMemberStatus = AMOUNT_BY_ROLE_MEMBER_STATUS[$role][$memberStatus];
        $amountBasic = $amountMemberStatus +  AMOUNT_SUB_USER_BY_ROLE[$role] * $totalSub;
        $amountDiscount = round($amountBasic * $discount / FLAG_ONE_HUNDRED, FLAG_ZERO);
        $amountTax = round(($amountBasic - $amountDiscount) * TAX_PERSONAL, FLAG_ZERO);
        $amountTotal = round($amountBasic - $amountDiscount + $amountTax);
        return [
            'amounts_by_member' => $amountMemberStatus,
            'total_sub' => $totalSub,
            'amounts_by_sub_user' => AMOUNT_SUB_USER_BY_ROLE[$role],
            'amount_basic' => $amountBasic,
            'discount' => $discount,
            'discount_value' => $amountDiscount,
            'tax' => $amountTax,
            'total_amount' => $amountTotal,
        ];
    }
}

if (!function_exists('getIndexSort')) {
    /**
     * @param $index
     * @return string
     */
    function getIndexSort($index)
    {
        return isset(BASEMENT_RENT_ROLL[$index]) ? ALPHABET[floor($index / 26)] . ALPHABET[$index % 26] : $index;
    }
}
