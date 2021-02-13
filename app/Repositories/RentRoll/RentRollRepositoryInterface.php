<?php

namespace App\Repositories\RentRoll;

interface RentRollRepositoryInterface
{
    public function insertData($params);

    /**
     * check data exists by property id
     *
     * @param integer $propertyId
     * @return mixed
     */
    public function checkDataExistsByPropertyId(int $propertyId);

    /**
     * get list by conditions
     *
     * @param integer $userId
     * @return mixed
     */
    public function getListByConditions(int $userId);

    /**
     * get all data
     *
     * @param integer $propertyId
     * @param array $params
     * @return mixed
     */
    public function getAllData(int $propertyId, array $params);

    /**
     * array score inside the house
     *
     * @param int $propertyId
     * @param array $params
     * @return mixed
     */
    public function arrayScoreInsideTheHouse(int $propertyId, array $params);

    /**
     * set array total by real estate types
     *
     * @param integer $propertyId
     * @param array $params
     * @return array
     */
    public function setArrayTotalByRealEstateTypes(int $propertyId, array $params);
}
