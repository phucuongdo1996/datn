<?php

namespace App\Repositories;

use App\Models\Market;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class MarketEloquentRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return Market::class;
    }

    /**
     * @return mixed
     */
    public function getNewItems()
    {
        return $this->model->select('product_id')->whereHas('product.productBase', function ($query) {
            return $query->where('type', TYPE_ITEM_CATEGORY);
        })->where('status', TRADE_SELLING)->get()->toArray();
    }

    /**
     * @return mixed
     */
    public function getNewSets()
    {
        return $this->model->select('product_id')->whereHas('product.productBase', function ($query) {
            return $query->where('type', TYPE_SET_CATEGORY);
        })->where('status', TRADE_SELLING)->get()->toArray();
    }

    /**
     * @param $productBaseIds
     * @param $typeTrade
     * @return mixed
     */
    public function getProductByProductBaseIds($productBaseIds, $typeTrade)
    {
        return $this->model->select('product_id')->whereHas('product.productBase', function ($query) use ($productBaseIds) {
            return $query->whereIn('id', $productBaseIds);
        })->where('status', $typeTrade)->get()->toArray();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getListItems($params)
    {
        return $this->model->select('product_id')->whereHas('product', function ($query) use ($params) {
            return $query->whereHas('productBase', function ($query) {
                return $query->where('type', TYPE_ITEM_CATEGORY);
            })
                ->when(isset($params['product_name']), function ($query) use ($params) {
                    return $query->whereHas('productBase', function ($query) use ($params) {
                        $query->where('name', 'like', '%' . $params['product_name'] . '%');
                    });
                })->when(isset($params['hero_id']), function ($query) use ($params) {
                    return $query->whereHas('productBase', function ($query) use ($params) {
                        $query->where('hero_id', $params['hero_id']);
                    });
                })->when(isset($params['category_id']), function ($query) use ($params) {
                    return $query->whereHas('productBase', function ($query) use ($params) {
                        $query->where('category_id', $params['category_id']);
                    });
                })->when(isset($params['price_from']), function ($query) use ($params) {
                    $query->where('price', '>=', convertNumber($params['price_from']));
                })->when(isset($params['price_to']), function ($query) use ($params) {
                    $query->where('price', '<=', convertNumber($params['price_to']));
                });
        })->where('status', TRADE_SELLING)->get()->toArray();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getListSet($params)
    {
        return $this->model->select('product_id')->whereHas('product', function ($query) use ($params) {
            return $query->whereHas('productBase', function ($query) {
                return $query->where('type', TYPE_SET_CATEGORY);
            })
                ->when(isset($params['hero_id']), function ($query) use ($params) {
                    return $query->whereHas('productBase', function ($query) use ($params) {
                        $query->where('hero_id', $params['hero_id']);
                    });
                });
        })->where('status', TRADE_SELLING)->get()->toArray();
    }

    /**
     * @param $productId
     * @return |null
     */
    public function getProductDetailSelling($productId)
    {
        $record = $this->model->select('product_id')->where('product_id', $productId)->where('status', TRADE_SELLING)->first();
        return $record ? $record->product_id : null;
    }

    public function getDataChartProductDetail($productBaseId)
    {
        $date = new \DateTime('-30 days');
        $date = $date->format('Y-m-d');
        $sql = "select DATE(market.created_at) as date,  AVG(market.price) as avg_price
                from market, products, products_base 
                where market.product_id = products.id and products.product_base_id = products_base.id and products_base.id = ? and market.created_at > ? and market.status = 2
                group by DATE(market.created_at) order by DATE(market.created_at)";
        return DB::select($sql, [$productBaseId, $date]);
    }
}
