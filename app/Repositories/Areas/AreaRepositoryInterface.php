<?php

namespace App\Repositories\Areas;

interface AreaRepositoryInterface
{
    /**
     * get data by areas
     *
     * @param array $params
     * @return mixed
     */
    public function getDataByAreas($params);

}
