<?php

namespace App\Repositories;

use App\Models\Hero;
use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductEloquentRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return Product::class;
    }
}
