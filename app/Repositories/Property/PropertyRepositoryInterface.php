<?php

namespace App\Repositories\Property;

interface PropertyRepositoryInterface
{
    /**
     * Update property by id
     *
     * @param array $request
     * @param int|\App\Models\Property $property
     *
     * @return mixed
     */
    public function updateRecord($property, array $request);
}
