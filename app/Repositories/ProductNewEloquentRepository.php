<?php

namespace App\Repositories;

use App\Models\ProductNew;
use App\Traits\ShowProduct;

class ProductNewEloquentRepository extends BaseRepository
{
    use ShowProduct;

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return ProductNew::class;
    }
}
