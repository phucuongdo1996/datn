<?php

namespace App\Repositories\HouseMaterial;

use App\Models\HouseMaterial;
use App\Repositories\BaseRepository;

class HouseMaterialEloquentRepository extends BaseRepository implements HouseMaterialRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return HouseMaterial::class;
    }

    /**
     * get all
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->get()->toArray();
    }
}
