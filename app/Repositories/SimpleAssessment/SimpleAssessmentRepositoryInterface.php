<?php

namespace App\Repositories\SimpleAssessment;


interface SimpleAssessmentRepositoryInterface
{
    /**
     * Save simple assessment data
     *
     * @param $params
     * @return mixed
     */
    public function saveData($params);

    /**
     * Get simple assessment data with id
     *
     * @param $simpleAssessmentId
     * @return mixed
     */
    public function getObjectSimpleAssessmentById($simpleAssessmentId);
}
