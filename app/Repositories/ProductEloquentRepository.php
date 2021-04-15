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

    /**
     * @param $params
     * @return mixed
     */
    public function getListItems($params)
    {
        $ids = resolve(MarketEloquentRepository::class)->getListItems($params);
        return $this->model->whereIn('id', $ids)->with('productBase.hero')->paginate(60);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getListSet($params)
    {
        $ids = resolve(MarketEloquentRepository::class)->getListSet($params);
        return $this->model->whereIn('id', $ids)->with('productBase.hero')->paginate(60);
    }
}
