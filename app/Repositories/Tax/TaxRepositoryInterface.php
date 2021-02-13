<?php

namespace App\Repositories\Tax;

interface TaxRepositoryInterface
{
    /**
     * get all
     *
     * @return mixed
     */
    public function getAll();

    /**
     *get list tax by mont and year
     *
     * @param $params
     *
     * @return mixed
     */
    public function getByMonthAndYear($params);
}
