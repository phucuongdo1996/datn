<?php

namespace App\Repositories\TypeRental;

use App\Models\TypeRental;
use App\Repositories\BaseRepository;

class TypeRentalEloquentRepository extends BaseRepository implements TypeRentalRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return TypeRental::class;
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
