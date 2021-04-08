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
}
