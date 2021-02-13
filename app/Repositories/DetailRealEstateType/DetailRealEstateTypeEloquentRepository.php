<?php

namespace App\Repositories\DetailRealEstateType;

use App\Models\DetailRealEstateType;
use App\Repositories\BaseRepository;

class DetailRealEstateTypeEloquentRepository extends BaseRepository implements DetailRealEstateTypeRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return DetailRealEstateType::class;
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
