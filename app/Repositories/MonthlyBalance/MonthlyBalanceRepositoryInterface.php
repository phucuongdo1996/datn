<?php

namespace App\Repositories\MonthlyBalance;

interface MonthlyBalanceRepositoryInterface
{

    /**
     * save data
     *
     * @param array $params
     * @return bool
     */
    public function saveData($params);

    /**
     * get list date year by property id
     *
     * @param integer $propertyId
     * @return array
     */
    public function getListDateYearByPropertyId(int $propertyId);

    /**
     * get list by conditions
     *
     * @param integer $propertyId
     * @param array $params
     * @return array
     */
    public function getListByConditions(int $propertyId, array $params);

    /**
     * get list by conditions
     *
     * @param integer $userId
     * @return mixed
     */
    public function getListPropertyIdByUserId(int $userId);

    /**
     * get calculate the total data by year
     *
     * @param integer $propertyId
     * @param array $params
     * @return mixed
     */
    public function getCalculateTheTotalDataByYear(int $propertyId, array $params);

}
