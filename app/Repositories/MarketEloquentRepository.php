<?php

namespace App\Repositories;

use App\Models\Market;
use Illuminate\Support\Facades\Auth;
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
     * Lấy data [Item đang bán] hiển thị ở Màn hình chính.
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
     * Lấy data [Set đang bán] hiển thị ở Màn hình chính.
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
     * Lấy data [Sản phẩm Mới cập nhật] hiển thị ở Màn hình chính.
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
     * Lấy data [Sản phẩm Bán chạy nhất] hiển thị ở Màn hình chính.
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
     * Lấy data [Sản phẩm Đáng chú ý] hiển thị ở Màn hình chính.
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
     * Lấy data [Các item đang bán]
     *
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
            ->where('status', TRADE_SELLING)
            ->orderBy('price')->paginate(30);
    }

    /**
     * Lấy data [Các Set đang bán]
     *
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
        })
            ->where('status', TRADE_SELLING)
            ->orderBy('price')->paginate(30);
    }

    /**
     * Lấy data [Chi tiết sản phẩm đang bán]
     *
     * @param $id
     * @return array
     */
    public function getProductDetailSelling($id)
    {
        $record = $this->model->where('id', $id)->where('status', TRADE_SELLING)->first();
        return $record ? $record->append('seller_name')->toArray() : [];
    }

    /**
     * Lấy dữ liệu [Biểu đồ giá biên động sản phẩm]
     *
     * @param $productBaseId
     * @return array
     */
    public function getDataChartProductDetail($productBaseId)
    {
        $date = new \DateTime('-30 days');
        $date = $date->format('Y-m-d');
        $sql = "select DATE(market.updated_at) as date,  AVG(market.price) as avg_price
                from market, products, products_base 
                where market.product_id = products.id and products.product_base_id = products_base.id and products_base.id = ? and market.updated_at > ? and market.status = 2
                group by DATE(market.updated_at) order by DATE(market.updated_at)";
        return DB::select($sql, [$productBaseId, $date]);
    }

    /**
     * Lấy data [Các sản phẩm tương tự]
     *
     * @param $productBaseId
     * @param $productId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSameProducts($productBaseId, $productId)
    {
        return $this->model->with('product')
            ->where('product_id', '<>', $productId)
            ->whereHas('product', function ($query) use ($productBaseId) {
                return $query->where('product_base_id', $productBaseId);
            })->where('status', TRADE_SELLING)->orderBy('price')->paginate(10);
    }

    /**
     * Xử lý Logic [Rao bán item]
     *
     * @param $data
     * @return bool
     */
    public function sellItem($data)
    {
        DB::beginTransaction();
        $user = Auth::user();
        try {
            $user->marketSeller()->create([
                'product_id' => $data['product_id'],
                'price' => $data['price'],
                'price_real' => $data['price'] * 0.9,
                'status' => TRADE_SELLING
            ]);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Xử lý Logic [Thu hồi item]
     *
     * @param $data
     * @return bool
     */
    public function withdrawItem($data)
    {
        DB::beginTransaction();
        try {
            $this->update($data['market_id'], [
                'status' => TRADE_CANCELED
            ]);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Xử lý Logic [Mua item]
     *
     * @param $data
     * @return bool
     */
    public function buyItem($data)
    {
        DB::beginTransaction();
        $userBuyer = Auth::user();
        try {
            $marketProduct = $this->find($data['market_id']);
            $userSeller = resolve(UserEloquentRepository::class)->find($marketProduct->seller_id);
            if ($userBuyer->money_own >= $marketProduct->price) {
                $userBuyer->money_own -= $marketProduct->price;
                $marketProduct->status = TRADE_DONE;
                $userSeller->money_own += $marketProduct->price_real;
                $marketProduct->product()->update([
                    'user_id' => $userBuyer->id
                ]);
                $userSeller->save();
                $userBuyer->save();
                $marketProduct->save();
                resolve(AdminRevenueEloquentRepository::class)->create([
                    'type' => REVENUE_AGENCY,
                    'value' => $marketProduct->price - $marketProduct->price_real
                ]);
                resolve(UserHistoryEloquentRepository::class)->createMultiple([
                    [
                        'user_id' => $userBuyer->id,
                        'partner_id' => $userSeller->id,
                        'product_id' => $marketProduct->product_id,
                        'purchase_money' => $marketProduct->price,
                        'type' => USER_HISTORY_BUY_ITEM
                    ],
                    [
                        'user_id' => $userSeller->id,
                        'partner_id' => $userBuyer->id,
                        'product_id' => $marketProduct->product_id,
                        'purchase_money' => $marketProduct->price_real,
                        'type' => USER_HISTORY_SELL_ITEM
                    ]
                ]);
                DB::commit();
                return true;
            }
            DB::rollBack();
            return false;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }
}
