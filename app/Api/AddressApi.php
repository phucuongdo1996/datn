<?php

namespace App\Api;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class AddressApi
{
    /**
     * @var $client
     */
    private static $client;

    /**
     * get instance
     *
     * @return Client
     */
    public static function getInstance()
    {
        if (self::$client == null) {
            self::$client = new Client();
        }
        return self::$client;
    }

    /**
     * get request api address
     *
     * @param $params
     * @param $uri
     * @return mixed
     */
    public function getRequest($uri, $params = null)
    {
        $request = $this->getInstance()->get(config('address.base_uri') . $uri, [
            'headers' => ['x-api-key' => config('address.x_api_key')],
            'query' => $params,
        ]);
        return json_decode($request->getBody()->getContents(), true);
    }

    /**
     * store address cache
     *
     * @param string $address
     * @param array $value
     */
    public function storeAddressCache($address, $value)
    {
        Cache::put($address, $value, Carbon::now()->addDays(FLAG_TWO));
    }

    /**
     * get prefecture data
     *
     * @return array|false
     */
    public function getDataPrefecture()
    {
        if (!Cache::has('prefectures')) {
            $this->storeAddressCache('prefectures', $this->getRequest('/api/v1/prefectures')['result']);
        }
        $prefectures = Cache::get('prefectures');
        return array_combine(
            array_column($prefectures, 'prefCode'),
            array_column($prefectures, 'prefName')
        );
    }

    /**
     * get district data
     *
     * @return array|false
     */
    public function getDataDistrict()
    {
        if (!Cache::has('district')) {
            $this->storeAddressCache('district', $this->getRequest('/api/v1/cities', ['prefCode' => FLAG_ZERO])['result']);
        }
        $district = Cache::get('district');
        return array_combine(
            array_column($district, 'cityCode'),
            array_column($district, 'cityName')
        );
    }
}
