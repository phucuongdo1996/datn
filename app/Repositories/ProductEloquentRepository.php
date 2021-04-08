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

    public function getNewItems()
    {
        return $this->model->whereHas('productBase', function ($query) {
            return $query->where('type', TYPE_ITEM_CATEGORY);
        })->with('productBase.hero')->limit(100)->get()->toArray();
    }

    public function getNewSets()
    {
        return $this->model->whereHas('productBase', function ($query) {
            return $query->where('type', TYPE_SET_CATEGORY);
        })->with('productBase.hero')->limit(100)->get()->toArray();
    }

    public function getProductNew()
    {
        $ids = resolve(ProductNewEloquentRepository::class)->getIdsItems();
        return $this->model->with('productBase')->whereIn('product_base_id', $ids)->orderBy('price')->limit(20)->get()->toArray();
    }

    public function getProductBestseller()
    {
        $ids = resolve(ProductBestsellerEloquentRepository::class)->getIdsItems();
        return $this->model->with('productBase')->whereIn('product_base_id', $ids)->orderBy('price')->limit(20)->get()->toArray();
    }

    public function getProductRemarkable()
    {
        $ids = resolve(ProductRemarkableEloquentRepository::class)->getIdsItems();
        return $this->model->with('productBase')->whereIn('product_base_id', $ids)->orderBy('price')->limit(20)->get()->toArray();
    }

    public function getListItems($params)
    {
        return $this->model->whereHas('productBase', function ($query) {
            return $query->where('type', TYPE_ITEM_CATEGORY);
        })->when(isset($params['product_name']), function ($query) use ($params) {
            return $query->whereHas('productBase', function ($query) use ($params) {
                $query->where('name', 'like', '%' . $params['product_name'] . '%');
            });
        })
            ->with('productBase.hero')->paginate(60);
    }

    public function getListSet($params)
    {
        return $this->model->whereHas('productBase', function ($query) {
            return $query->where('type', TYPE_SET_CATEGORY);
        })->when(isset($params['hero_id']), function ($query) use ($params) {
            return $query->whereHas('productBase', function ($query) use ($params) {
                $query->where('hero_id', $params['hero_id']);
            });
        })
            ->with('productBase.hero')->orderBy('price')->paginate(60);
    }
}
