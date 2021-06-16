<?php

namespace App\Repositories;

use App\Models\ProductBase;

class ProductBaseEloquentRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return ProductBase::class;
    }
}
