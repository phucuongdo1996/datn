<?php

namespace App\Repositories\LandRight;

use App\Models\LandRight;
use App\Repositories\BaseRepository;

class LandRightEloquentRepository extends BaseRepository implements LandRightRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return LandRight::class;
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
