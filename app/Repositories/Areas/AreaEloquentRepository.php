<?php

namespace App\Repositories\Areas;

use App\Models\Areas;
use App\Repositories\BaseRepository;

class AreaEloquentRepository extends BaseRepository implements AreaRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return Areas::class;
    }

    /**
     * Get region acreage year
     *
     * @param $params
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getRegionAcreageYear($params)
    {
        $bankType = BANK_TYPES[$params['real_estate_type_id']];
        $record = $this->model
            ->where([
                'provincial' => $params['provincial'],
            ])
            ->where(function ($query) use ($params) {
                return $query->where('district', $params['district'])
                    ->orWhere('district', '');
            })
            ->first();
        if ($record) {
            if ($record->{$bankType} == "") {
                return trans('attributes.balance.orther_type');
            }
            return $record->{$bankType};
        }
        $record = $this->model
            ->where([
                'provincial' => $params['provincial'],
            ])
            ->first();
        if ($record) {
            return trans('attributes.balance.orther_type');
        }
        return null;
    }

    /**
     * Get region acreage year for save
     *
     * @param $params
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getRegionAcreageYearForSave($params)
    {
        $bankType = BANK_TYPES[$params['real_estate_type_id']];
        $record = $this->model
            ->where([
                'provincial' => $params['address_city'],
            ])
            ->where(function ($query) use ($params) {
                return $query->where('district', $params['address_district'])
                    ->orWhere('district', '');
            })
            ->first();
        if ($record) {
            if ($record->{$bankType} == "") {
                return trans('attributes.balance.orther_type');
            }
            return $record->{$bankType};
        }
        $record = $this->model
            ->where([
                'provincial' => $params['address_city'],
            ])
            ->first();
        if ($record) {
            return trans('attributes.balance.orther_type');
        }
        return null;
    }

    /**
     * get condition by real estate type
     *
     * @param array $params
     * @return string
     */
    private function getConditionByRealEstateType($params)
    {
        switch ($params) {
            case "1":
                return 'office_area';
            case "2":
                return 'house_area';
            case "3":
                return 'store_area';
            default:
                return 'regional_area';
        }
    }

    /**
     * get condition by area
     *
     * @param array $params
     * @return mixed
     */
    private function getConditionByArea($params)
    {
        if (in_array(DATA_ALL, $params)) {
            array_shift($params);
            return $params;
        }
        return $params;
    }

    /**
     * get data by areas
     *
     * @param array $params
     * @return mixed
     */
    public function getDataByAreas($params)
    {
        return $this->model->selectRaw('provincial, district')
                        ->whereIn($this->getConditionByRealEstateType($params['real_estate_type_search']), $this->getConditionByArea($params['area']))
                        ->when(in_array($params['real_estate_type_search'], [FLAG_ONE, FLAG_TWO]), function ($query) use ($params) {
                            return $query->orWhereIn('regional_area', $this->getConditionByArea($params['area']));
                        })
                        ->get()->toArray();
    }
}
