<?php

namespace App\Repositories\GeneralInfoProperty;

interface GeneralInfoPropertyRepositoryInterface
{
    /**
     * Create general info Property
     *
     * @param array $data
     * @return mixed
     */
    public function createRecord($data);
}
