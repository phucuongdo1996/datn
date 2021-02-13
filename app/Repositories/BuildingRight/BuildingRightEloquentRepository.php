<?php

namespace App\Repositories\BuildingRight;

use App\Models\BuildingRight;
use App\Repositories\BaseRepository;

class BuildingRightEloquentRepository extends BaseRepository implements BuildingRightRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return BuildingRight::class;
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
