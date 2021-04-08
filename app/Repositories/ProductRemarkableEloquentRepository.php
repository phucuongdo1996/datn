<?php

namespace App\Repositories;

use App\Models\Hero;
use App\Models\Product;
use App\Models\ProductBestseller;
use App\Models\ProductNew;
use App\Models\ProductRemarkable;
use App\Repositories\BaseRepository;
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
