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
     * @return mixed
     */
    public function getNewItems()
    {
        $ids = resolve(MarketEloquentRepository::class)->getNewItems();
        return $this->model->whereIn('id', $ids)->with('productBase.hero')->limit(100)->get()->toArray();
    }

    /**
     * @return mixed
     */
    public function getNewSets()
    {
        $ids = resolve(MarketEloquentRepository::class)->getNewSets();
        return $this->model->whereIn('id', $ids)->with('productBase.hero')->limit(100)->get()->toArray();
    }

    /**
     * @return mixed
     */
    public function getProductNew()
    {
        $productBaseIds = resolve(ProductNewEloquentRepository::class)->getIdsItems();
        $ids = resolve(MarketEloquentRepository::class)->getProductByProductBaseIds($productBaseIds, TRADE_SELLING);
        return $this->model->whereIn('id', $ids)->with('productBase.hero')->orderBy('price')->limit(20)->get()->toArray();
    }

    /**
     * @return mixed
     */
    public function getProductBestseller()
    {
        $productBaseIds = resolve(ProductBestsellerEloquentRepository::class)->getIdsItems();
        $ids = resolve(MarketEloquentRepository::class)->getProductByProductBaseIds($productBaseIds, TRADE_SELLING);
        return $this->model->whereIn('id', $ids)->with('productBase.hero')->orderBy('price')->limit(20)->get()->toArray();
    }

    /**
     * @return mixed
     */
    public function getProductRemarkable()
    {
        $productBaseIds = resolve(ProductRemarkableEloquentRepository::class)->getIdsItems();
        $ids = resolve(MarketEloquentRepository::class)->getProductByProductBaseIds($productBaseIds, TRADE_SELLING);
        return $this->model->whereIn('id', $ids)->with('productBase.hero')->orderBy('price')->limit(20)->get()->toArray();
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
