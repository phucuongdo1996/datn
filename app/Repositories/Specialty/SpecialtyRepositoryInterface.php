<?php

namespace App\Repositories\Specialty;

interface SpecialtyRepositoryInterface
{
    /**
     * @param bool $isExpert
     * @return mixed
     */
    public function getAllFromType($isExpert = true);
}
