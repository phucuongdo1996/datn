<?php

namespace App\Repositories;

use App\Models\ProductRemarkable;
use App\Traits\showProduct;

class ProductRemarkableEloquentRepository extends BaseRepository
{
    use showProduct;

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return ProductRemarkable::class;
    }
}
