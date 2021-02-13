<?php

namespace App\Repositories\RealEstateType;

use App\Models\RealEstateType;
use App\Repositories\BaseRepository;

class RealEstateTypeEloquentRepository extends BaseRepository implements RealEstateTypeRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return RealEstateType::class;
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
