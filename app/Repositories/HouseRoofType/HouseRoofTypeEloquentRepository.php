<?php

namespace App\Repositories\HouseRoofType;

use App\Models\HouseRoofType;
use App\Repositories\BaseRepository;

class HouseRoofTypeEloquentRepository extends BaseRepository implements HouseRoofTypeRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return HouseRoofType::class;
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
