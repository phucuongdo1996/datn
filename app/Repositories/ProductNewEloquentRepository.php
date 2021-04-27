<?php

namespace App\Repositories;

use App\Models\ProductNew;
use App\Traits\showProduct;

class ProductNewEloquentRepository extends BaseRepository
{
    use showProduct;

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
