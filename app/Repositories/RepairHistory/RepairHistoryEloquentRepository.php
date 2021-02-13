<?php

namespace App\Repositories\RepairHistory;

use App\Models\RepairHistory;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class RepairHistoryEloquentRepository extends BaseRepository implements RepairHistoryRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return RepairHistory::class;
    }

    /**
     * Get data by HouseId and option paginate
     *
     * @param $houseId
     * @param $optionPaginate
     * @return mixed|null
     */
    public function getListDataByHouseId($houseId, $optionPaginate)
    {
        $data = $this->model->where('property_id', $houseId)->select('*')->simplePaginate($optionPaginate);
        if ($data) {
            return $data;
        }
        return null;
    }

    /**
     *  Find by attribute
     *
     * @param $attribute
     * @param $value
     * @return mixed|null
     */
    public function findByAttribute($attribute, $value)
    {
        $record = $this->model->where($attribute, $value)->first();
        if ($record) {
            return $record;
        }
        return null;
    }

    /**
     * Check house has repair history
     *
     * @param $houseId
     * @return bool|mixed
     */
    public function checkHasRepair($houseId)
    {
        if ($this->findByAttribute('property_id', $houseId)) {
            return true;
        }
        return false;
    }

    /**
     * Function get data by PropertyId
     *
     * @param $id
     * @param $propertyId
     * @return array|mixed
     */
    public function getDataByPropertyId($id, $propertyId)
    {
        try {
            return $this->model->where('id', $id)->where('property_id', $propertyId)->first();
        } catch (Exception $e) {
            report($e);
            return [];
        }
    }

    /**
     * Delete repair history of property
     *
     * @param $id
     * @param $propertyId
     * @return bool|void
     */
    public function deleteByPropertyId($id, $propertyId)
    {
        DB::beginTransaction();
        try {
            $result = $this->model->where('id', $id)->where('property_id', $propertyId)->first();
            if (empty($result)) {
                return false;
            } else {
                $result->update(['unblock_status' => true]);
                $result->delete();
                DB::commit();
                return true;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return false;
        }
    }

    /**
     * Get Page Number
     *
     * @param $params
     * @return float|int
     */
    public function getPageNumber($params)
    {
        $totalRecords = $this->model->where('property_id', $params['property_id'])->count();
        if (request()->isMethod('put')) {
            $data = $this->model->where('property_id', $params['property_id'])->pluck('id')->toArray();
            if (!$data || !in_array($params['id'], $data)) {
                return FLAG_ZERO;
            }
            return intval(ceil((array_search($params['id'], $data) + FLAG_ONE) / $params['option_paginate']));
        } elseif (request()->isMethod('delete')) {
            if ($totalRecords == ($params['page'] - 1) * $params['option_paginate']) {
                return $params['page'] - 1;
            }
            return $params['page'];
        } else {
            return ceil($totalRecords / ($params['option_paginate'] ?? LIMIT_RECORD_DEFAULT));
        }
    }
}
