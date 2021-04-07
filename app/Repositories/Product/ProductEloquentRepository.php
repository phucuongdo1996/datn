<?php

namespace App\Repositories\Product;

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

    public function getNewItems()
    {
        return $this->model->whereHas('productBase', function ($query) {
            return $query->where('type', 1);
        })->with('productBase.hero')->limit(100)->get()->toArray();
    }

    public function getNewSets()
    {
        return $this->model->whereHas('productBase', function ($query) {
            return $query->where('type', 2);
        })->with('productBase.hero')->limit(100)->get()->toArray();
    }
}
