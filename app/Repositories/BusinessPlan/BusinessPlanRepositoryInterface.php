<?php

namespace App\Repositories\BusinessPlan;

interface BusinessPlanRepositoryInterface
{
    /**
     * save data
     *
     * @param array $params
     * @return bool
     */
    public function saveData($params);

    /**
     * check data exists by property id
     *
     * @param integer $propertyId
     * @return mixed
     */
    public function checkDataExistsByPropertyId($propertyId);

    /**
     * Get data business plan  with property_id
     *
     * @param integer $propertyId
     * @return mixed
     */
    public function getObjectBusinessPlanByPropertyId($propertyId);

}
