<?php

namespace App\Repositories\RepairHistory;

interface RepairHistoryRepositoryInterface
{
    /**
     * Get all data by HouseId
     *
     * @param $houseId
     * @param $optionPaginate
     * @return mixed
     */
    public function getListDataByHouseId($houseId, $optionPaginate);

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findByAttribute($attribute, $value);

    /**
     * Check house has repair history
     *
     * @param $houseId
     * @return mixed
     */
    public function checkHasRepair($houseId);

    /**
     * Get record by propertyId
     *
     * @param $id
     * @param $propertyId
     * @return mixed
     */
    public function getDataByPropertyId($id, $propertyId);

    /**
     * Delete repair history of property
     *
     * @param $id
     * @param $propertyId
     * @return mixed
     */
    public function deleteByPropertyId($id, $propertyId);

    /**
     * Get Page Number
     *
     * @param $params
     * @return float|int
     */
    public function getPageNumber($params);
}
