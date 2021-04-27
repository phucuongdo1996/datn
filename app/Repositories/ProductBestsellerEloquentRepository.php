<?php

namespace App\Repositories;

use App\Models\ProductBestseller;
use App\Traits\showProduct;

class ProductBestsellerEloquentRepository extends BaseRepository
{
    use showProduct;

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return ProductBestseller::class;
    }
}
