<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserEloquentRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Lấy sản phẩm sở hữu bởi User.
     *
     * @param $params
     * @return mixed
     */
    public function getProductsByUser($params)
    {
        $productSellingIds = Auth::user()->marketSeller()->where('status', TRADE_SELLING)->pluck('product_id')->toArray();
        return Auth::user()->products()
            ->whereNotIn('id', $productSellingIds)
            ->when(isset($params['product_name']), function ($query) use ($params) {
                return $query->whereHas('productBase', function ($query) use ($params) {
                    return $query->where('name', 'like', '%' . $params['product_name'] . '%');
                });
            })
            ->when(isset($params['category_id']), function ($query) use ($params) {
                return $query->whereHas('productBase', function ($query) use ($params) {
                    return $query->where('category_id', $params['category_id']);
                });
            })
            ->when(isset($params['hero_id']), function ($query) use ($params) {
                return $query->whereHas('productBase', function ($query) use ($params) {
                    return $query->where('hero_id', $params['hero_id']);
                });
            })
            ->orderBy('updated_at', 'DESC')->paginate(MAX_RECORDS_PAGINATE);
    }

    /**
     * Lấy sản phẩm đang bán sở hữu bởi User.
     *
     * @param $params
     * @return mixed
     */
    public function getProductsSellingByUser($params)
    {
        return Auth::user()->marketSeller()->where('status', TRADE_SELLING)
            ->when(isset($params['product_name']), function ($query) use ($params) {
                return $query->whereHas('product.productBase', function ($query) use ($params) {
                    return $query->where('name', 'like', '%' . $params['product_name'] . '%');
                });
            })
            ->when(isset($params['category_id']), function ($query) use ($params) {
                return $query->whereHas('product.productBase', function ($query) use ($params) {
                    return $query->where('category_id', $params['category_id']);
                });
            })
            ->when(isset($params['hero_id']), function ($query) use ($params) {
                return $query->whereHas('product.productBase', function ($query) use ($params) {
                    return $query->where('hero_id', $params['hero_id']);
                });
            })
            ->orderBy('id', 'DESC')->paginate(MAX_RECORDS_PAGINATE);
    }

    /**
     * Cộng tiền nạp cho User.
     *
     * @param $money
     * @return bool
     */
    public function addMoneyUser($money)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $user->money_own += $money;
            $user->save();
            resolve(UserHistoryEloquentRepository::class)->create([
                'user_id' => $user->id,
                'purchase_money' => $money,
                'type' => USER_HISTORY_RECHARGE_MONEY
            ]);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    public function buySteamCode($type)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $money = STEAM_CODE_MONEY[$type];
            $steamCode = resolve(SteamCodeEloquentRepository::class)->buySteamCode($type);
            if ($user->money_own >= $money && $steamCode) {
                $user->money_own -= $money;
                $user->userHistory()->create([
                    'steam_code_id' => $steamCode->id,
                    'purchase_money' => $money,
                    'type' => USER_HISTORY_BUY_STEAM_CODE
                ]);
                $user->save();
                DB::commit();
                return [
                    'save' => true,
                    'data' => $steamCode->toArray()
                ];
            }
            DB::rollBack();
            return ['save' => false];
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return ['save' => false];
        }
    }
}
