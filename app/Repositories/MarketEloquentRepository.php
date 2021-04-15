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
     * Get new items
     *
     * @return mixed
     */
    public function getNewItems()
    {
        return $this->model->whereHas('product.productBase', function ($query) {
            return $query->where('type', TYPE_ITEM_CATEGORY);
        })->where('status', TRADE_SELLING)->limit(50)->get()->toArray();
    }

    /**
     * Get new sets
     *
     * @return mixed
     */
    public function getNewSets()
    {
        return $this->model->whereHas('product.productBase', function ($query) {
            return $query->where('type', TYPE_SET_CATEGORY);
        })->where('status', TRADE_SELLING)->limit(50)->get()->toArray();
    }

    /**
     * Get product new
     *
     * @return mixed
     */
    public function getProductNew()
    {
        $productBaseIds = resolve(ProductNewEloquentRepository::class)->getIdsItems();
        return $this->model->whereHas('product.productBase', function ($query) use ($productBaseIds) {
            return $query->whereIn('id', $productBaseIds);
        })->where('status', TRADE_SELLING)->limit(15)->get()->toArray();
    }

    /**
     * Get product bestseller
     *
     * @return mixed
     */
    public function getProductBestseller()
    {
        $productBaseIds = resolve(ProductBestsellerEloquentRepository::class)->getIdsItems();
        return $this->model->whereHas('product.productBase', function ($query) use ($productBaseIds) {
            return $query->whereIn('id', $productBaseIds);
        })->where('status', TRADE_SELLING)->limit(15)->get()->toArray();
    }

    /**
     * Get product remarkable
     *
     * @return mixed
     */
    public function getProductRemarkable()
    {
        $productBaseIds = resolve(ProductRemarkableEloquentRepository::class)->getIdsItems();
        return $this->model->whereHas('product.productBase', function ($query) use ($productBaseIds) {
            return $query->whereIn('id', $productBaseIds);
        })->where('status', TRADE_SELLING)->limit(15)->get()->toArray();
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
        return $this->model->whereHas('product', function ($query) use ($params) {
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
                });
        })->when(isset($params['price_from']), function ($query) use ($params) {
            $query->where('price', '>=', convertNumber($params['price_from']));
        })->when(isset($params['price_to']), function ($query) use ($params) {
            $query->where('price', '<=', convertNumber($params['price_to']));
        })
            ->where('status', TRADE_SELLING)->paginate(30);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getListSet($params)
    {
        return $this->model->whereHas('product', function ($query) use ($params) {
            return $query->whereHas('productBase', function ($query) {
                return $query->where('type', TYPE_SET_CATEGORY);
            })
                ->when(isset($params['hero_id']), function ($query) use ($params) {
                    return $query->whereHas('productBase', function ($query) use ($params) {
                        $query->where('hero_id', $params['hero_id']);
                    });
                });
        })->where('status', TRADE_SELLING)->paginate(30);
    }

    /**
     * @param $id
     * @return array
     */
    public function getProductDetailSelling($id)
    {
        $record = $this->model->where('id', $id)->where('status', TRADE_SELLING)->first();
        return $record ? $record->append('seller_name')->toArray() : [];
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

    public function getSameProducts($productBaseId, $productId)
    {
        return $this->model->with('product')
            ->where('product_id', '<>', $productId)
            ->whereHas('product', function ($query) use ($productBaseId) {
                return $query->where('product_base_id', $productBaseId);
            })->where('status', TRADE_SELLING)->orderBy('price')->paginate(10);
    }
}
