<?php

namespace App\Repositories
;

use App\Api\Pay\PayApiInterface;
use App\Events\Pay;
use App\Mail\ChangeMemberStatus;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Profile\ProfileEloquentRepository;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\ResetPassword\ResetPasswordRepositoryInterface;
use App\Repositories\SubUserPermission\SubUserPermissionRepositoryInterface;
use App\Repositories\SubUserProperty\SubUserPropertyEloquentRepository;
use App\Repositories\VerifiedRegister\VerifiedRegisterRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            ->orderBy('id', 'DESC')->paginate(MAX_RECORDS_PAGINATE);
    }

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
}
