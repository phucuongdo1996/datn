<?php

namespace App\Repositories\User;

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

class UserEloquentRepository extends BaseRepository implements UserRepositoryInterface
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
     * Find record by email
     *
     * @param $email
     * @return mixed|null
     */
    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Find record by verifiedToken
     *
     * @param $verifiedToken
     * @return mixed|null
     */
    public function findByVerifiedToken($verifiedToken)
    {
        $verifiedRegister = resolve(VerifiedRegisterRepositoryInterface::class)
            ->findByAttribute('verified_token', $verifiedToken);
        if ($verifiedRegister) {
            return $this->findByEmail($verifiedRegister->email);
        }
        return null;
    }

    /**
     * check user code
     *
     * @param $userCode
     * @return bool
     */
    public function checkUserCode($userCode)
    {
        return $this->model->where('user_code', $userCode)->count() == FLAG_ZERO ? false : true;
    }

    /**
     * Check subUser blocked
     *
     * @param $email
     * @return bool
     */
    public function checkSubUserBlocked($email)
    {
        $user = $this->findByEmail($email);
        if ($user && $user->isSubUser() && $user->status != OPEN) {
            return true;
        }
        return false;
    }

    /**
     * make user code
     *
     * @param $role
     * @return string
     */
    public function makeUserCode($role)
    {
        $date = date('Ym');
        do {
            $userCode = $date . ROLES_CHAR[$role] . str_pad(rand(0, 999999), FLAG_SIX, "0", STR_PAD_LEFT);
        } while ($this->checkUserCode($userCode));
        return $userCode;
    }

    /**
     * Update password in users table and update uses in password_resets table
     *
     * @param array $data
     * @return bool
     */
    public function updatePassword(array $data)
    {
        try {
            $resetPassword = resolve(ResetPasswordRepositoryInterface::class)
                ->findByAttribute('token', $data['token']);
            if ($resetPassword->used == FLAG_ONE) {
                return false;
            }
            $resetPassword->update(['used' => FLAG_ONE]);
            $record = $this->findByEmail($resetPassword->email);
            if ($record) {
                $record->update(['password' => Hash::make($data['password'])]);
            }
            return true;
        } catch (\Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * get by user code
     *
     * @param int $id
     * @return mixed
     */
    public function getByUserCode($id)
    {
        return $this->model->select('user_code')
                        ->where('id', $id)
                        ->first();
    }

    /**
     * Get role of user and check
     *
     * @param int $id
     * @param null $role
     * @return mixed
     */
    public function getTypeOfUserById($id, int $role = null)
    {
        if ($role) {
            return $this->model->where(['id' => $id, 'role' => $role])
                ->has('profile')->with('profile')->first();
        }

        return $this->model->where(['id' => $id])
            ->has('profile')->with('profile')->first();
    }

    /**
     * Get role user by id
     *
     * @param int $id
     * @return mixed
     */
    public function getRoleUserById($id)
    {
        return $this->model->where('id', $id)
            ->select('role')
            ->first();
    }

    /**
     * public function get list user for manage screen
     *
     * @param $param
     * @param $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getListUserForManager($param, $perPage)
    {
        return DB::table('users')->leftjoin('profiles', 'users.id', 'profiles.user_id')
            ->when(isset($param['role']), function ($query) use ($param) {
                return $query->where('users.role', in_array($param['role'], array_keys(ROLES_USER)) ? $param['role'] : INVESTOR);
            })
            ->when(isset($param['member_status']), function ($query) use ($param) {
                return $query->where('users.member_status', in_array($param['member_status'], array_keys(MEMBER_STATUS)) ? $param['member_status'] : FREE);
            })
            ->when(isset($param['block_user']), function ($query) use ($param) {
                $operator = (in_array($param['block_user'], array_keys(USER_BLOCK)) ? $param['block_user'] : IN_USE) == IN_USE ? '=' : '<>';
                return $query->where('users.deleted_at', $operator, null);
            })
            ->select(['users.id', 'users.email', 'users.role', 'users.member_status', 'users.last_login', 'users.created_at', 'users.deleted_at', 'profiles.person_charge_last_name', 'profiles.person_charge_first_name' ])
            ->selectRaw('users.id as user_id, (SELECT COUNT(id) FROM users
            WHERE user_id = users.`parent_id` AND users.`deleted_at` is NULL) as sub_user, CONCAT(profiles.person_charge_last_name, profiles.person_charge_first_name) as full_name')
            ->when(isset($param['nick_name']), function ($query) use ($param) {
                return $query->whereRaw("(CONCAT(profiles.person_charge_last_name, profiles.person_charge_first_name) like '%" . $param['nick_name'] . "%' OR users.email like '%" . $param['nick_name'] . "%')");
            })
            ->whereIn('users.role', [INVESTOR, BROKER, EXPERT])
            ->where('users.parent_id', null)
            ->orderBy('users.id', 'desc')
            ->paginate($perPage);
    }

    /**
     * Check role is one user
     *
     * @param int $userId
     *
     * @return mixed|bool
     */
    public function isRoleUser($userId)
    {
        return $this->model->withTrashed()->findOrFail($userId)->isUser();
    }

    /**
     * Update and Block user
     *
     * @param $params
     * @param $id
     * @return bool
     */
    public function blockUserById($params, $id)
    {
        DB::beginTransaction();
        try {
            $params['deleted_at'] = date('Y-m-d h:i:s', time());
            $user = $this->update($id, $params);
            resolve(ProfileRepositoryInterface::class)->block($user->profile()->first());
            resolve(PropertyRepositoryInterface::class)->block($user->property());
            $user->articlePhotos()->update(['deleted_at' => $params['deleted_at']]);
            $user->topics()->update(['deleted_at' => $params['deleted_at']]);
            $user->taxes()->update(['deleted_at' => $params['deleted_at']]);
            $this->blockSubUserOfMainUser($id);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Delete user by id
     *
     * @param $params
     * @param $id
     * @return bool
     */
    public function deleteUserById($params, $id)
    {
        DB::beginTransaction();
        try {
            $data = $this->update($id, $params);
            $data->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Unblock User
     *
     * @param $id
     * @return bool
     */
    public function unblockUser($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->find($id, true);
            if ($user) {
                $user->restore();
                resolve(ProfileRepositoryInterface::class)->unblock($user->profile()->withTrashed()->first());
                resolve(PropertyRepositoryInterface::class)->unblock($user->property()->withTrashed()->where('unblock_status', FLAG_ZERO));
                $user->articlePhotos()->withTrashed()->where('unblock_status', FLAG_ZERO)->restore();
                $user->topics()->withTrashed()->where('unblock_status', FLAG_ZERO)->restore();
                $user->taxes()->withTrashed()->where('unblock_status', FLAG_ZERO)->restore();
                $this->unblockSubUserOfMainUser($id);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * function data user by id with trashed
     * @param $id
     * @return mixed
     */
    public function getDataUser($id)
    {
        return $this->model->withTrashed()->where('id', $id)
            ->with(['profile' => function ($query) {
                return $query->withTrashed()->select(['user_id', 'person_charge_first_name', 'person_charge_last_name']);
            }])
            ->first()->toArray();
    }

    /**
     * delete sub user of main user
     *
     * @param $mainUserId
     */
    public function deleteSubUserOfMainUser($mainUserId)
    {
        DB::beginTransaction();
        try {
            $subUser = $this->model->where('parent_id', $mainUserId);
            $subUser->update(['unblock_status' => true]);
            $subUser->delete();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
        }
    }

    /**
     * Block subUser of MainUser
     *
     * @param $mainUserId
     */
    public function blockSubUserOfMainUser($mainUserId)
    {
        $this->model->where('parent_id', $mainUserId)->update(['deleted_at' => date('Y-m-d h:i:s', time())]);
    }

    /**
     * Unblock subUser of MainUser
     *
     * @param $mainUserId
     */
    public function unblockSubUserOfMainUser($mainUserId)
    {
        $this->model->withTrashed()->where([
            'parent_id' => $mainUserId,
            'unblock_status' => FLAG_ZERO
        ])->restore();
    }

    /**
     * Create sub user
     *
     * @param $data
     * @param $parentUser
     * @return bool
     */
    public function createSubUser($data, $parentUser)
    {
        DB::beginTransaction();
        try {
            $data['password'] = rand(11111111, 99999999);
            $data['hash_password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            resolve(VerifiedRegisterRepositoryInterface::class)->createVerifySubUser($data, $parentUser);
            $this->create([
                'user_code' => $this->makeUserCode(SUB_USER),
                'email' => $data['email'],
                'password' => $data['hash_password'],
                'role' => $parentUser->role,
                'parent_id' => $parentUser->id,
                'group_code' => $parentUser->user_code,
                'status' => FLAG_ONE,
            ]);
            resolve(ProfileEloquentRepository::class)->saveProfileSubUser($data);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Crontab destroy sub users
     */
    public function destroySubUsers()
    {
        DB::beginTransaction();
        try {
            $subUsers = DB::table('users')->where('status', FLAG_ZERO)
                ->whereNotNull('parent_id')
                ->where('verified_status', FLAG_ZERO)
                ->where('created_at', '<=', Carbon::now()->subDay(1)->format('Y-m-d H:i:s'));
            DB::table('profiles')->whereIn('user_id', $subUsers->pluck('id')->toArray())->delete();
            DB::table('verified_registers')->whereIn('email', $subUsers->pluck('email')->toArray())->delete();
            $subUsers->delete();

            DB::commit();
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
        }
    }

    /**
     * Get data profile of user
     *
     * @param $id
     * @return array
     */
    public function getDataUserById($id)
    {
        $user = $this->model->withTrashed()->with(['profile' => function ($query) {
                return $query->withTrashed();
        }, 'property:user_id,house_name,property_code'])->findOrFail($id);

        resolve(ProfileEloquentRepository::class)->getSpecialties($user->profile);
        return $user->toArray();
    }

    /**
     * Get data sub users by id parent user
     *
     * @param $parentId
     * @return mixed
     */
    public function getDataSubUsersById($parentId)
    {
        return $this->model
            ->select(['id', 'email', 'user_code', 'created_at', 'updated_at', 'last_login', 'status'])
            ->where('parent_id', $parentId)
            ->with('profile:user_id,person_charge_last_name,person_charge_first_name', 'subUserPermission')
            ->has('profile')
            ->orderBy('id', 'desc')->get();
    }

    /**
     * Delete one sub user of main user
     *
     * @param $id
     * @param $parentId
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function deleteOneSubUserOfMainUser($id, $parentId)
    {
        return $this->where('id', $id)->where('parent_id', $parentId)->first()->delete();
    }

    /**
     * Move sub user
     *
     * @param $user
     * @param $subUsers
     * @return bool
     */
    public function moveSubUser($user, $subUsers)
    {
        DB::beginTransaction();
        try {
            if (!$user) {
                return false;
            }
            $this->model->withTrashed()->whereIn('id', $subUsers)->update(['parent_id' => $user->id, 'group_code' => $user->group_code, 'role' => $user->role]);
            resolve(SubUserPermissionRepositoryInterface::class)->deleteSubUserPermission($subUsers);
            resolve(SubUserPropertyEloquentRepository::class)->deleteRelationshipAfterMoveSubUser($subUsers);
            DB::commit();
            return $this->model->withTrashed()->with('profile:user_id,person_charge_first_name,person_charge_last_name')->whereIn('id', $subUsers)->get()->toArray();
        } catch (Exception $exception) {
            DB::rollBack();
            report($exception);
            return false;
        }
    }

    /**
     * count membership by role
     *
     * @param $condition
     * @return mixed
     */
    public function countMembershipByRole($condition = null)
    {
        return $this->model->withTrashed()->selectRaw('role, count(*) as total')
                        ->where('role', '<>', ADMIN)
                        ->where('parent_id', $condition == SUB_USER ? '<>' : '=', null)
                        ->groupBy('role')
                        ->get()->toArray();
    }

    /**
     * Get data sub users by id with profile
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getDataUserWithProfile($id)
    {
        return $this->model->with('profile:user_id,nick_name,person_charge_last_name,person_charge_first_name')
                           ->findOrFail($id);
    }

    /**
     * Count sub user of main user
     *
     * @param $userId
     * @return mixed
     */
    public function countSubUserNotPaid($userId)
    {
        return $this->model
            ->where('parent_id', $userId)
            ->where('status', '<>', DISABLE)
            ->count();
    }

    /**
     * Get data time update
     *
     * @param $userId
     * @return mixed
     */
    public function getDataTimeUpdated($userId)
    {
        return $this->model->find($userId, ['updated_at']);
    }

    /**
     * Send mail change member status
     *
     * @param $user
     * @param $status
     */
    public function sendMailChangeMemberStatus($user, $status)
    {
        $infoSendMail = [
            'lastName' => $user->profile->person_charge_last_name,
            'firstName' => $user->profile->person_charge_first_name,
            'email' => $user['email']
        ];
        if ($status == FLAG_ZERO) {
            resolve(ChangeMemberStatus::class)->sendMailChangeToFree($infoSendMail);
        }
        if ($status == FLAG_ONE) {
            resolve(ChangeMemberStatus::class)->sendMailChangeToFee($infoSendMail);
        }
        if ($status == FLAG_TWO) {
            resolve(ChangeMemberStatus::class)->sendMailChangeToPremium($infoSendMail);
        }
    }

    /**
     * Get user data by id to support
     *
     * @param $userId
     * @return mixed
     */
    public function getDataUserByIdToSupport($userId)
    {
        return $this->model->select(['id', 'user_code', 'email'])
            ->with('profile.specialties')
            ->findOrFail($userId)->toArray();
    }

    /**
     * get data user to payment
     *
     * @param $userId
     * @return mixed
     */
    public function getDataUserToPayment($userId)
    {
        return $this->model->selectRaw('id, role, member_status, email, (select count(parent_id) from users where parent_id = ' . $userId . ' and status <> ' . DISABLE . ' and deleted_at is null ) as total_sub')
                                ->where('id', $userId)
                                ->with('profile:user_id,nick_name,person_charge_last_name,person_charge_first_name', 'userSubscription:user_id,discount')
                                ->first()->toArray();
    }

    /**
     * get data user to payment
     *
     * @param $userId
     * @param $status
     * @return mixed
     */
    public function getDataUserChangeStatusFail($userId, $status)
    {
        $data = $this->getDataUserToPayment($userId);
        $data['member_status'] = $status;
        return $data;
    }

    /**
     * Calculate amount by sub user and account
     *
     * @param $userId
     * @param null $memberStatus
     * @return array
     */
    public function calculateAmountBySubUserAndAccount($userId, $memberStatus = null)
    {
        $user = $this->find($userId);
        if (!isset($memberStatus)) {
            $memberStatus = $user->getMemberStatus();
        }
        $amountMemberStatus = AMOUNT_BY_ROLE_MEMBER_STATUS[$user->role][$memberStatus];
        $countSub =  $this->model->where('parent_id', $user->id)
            ->where('status', '<>', DISABLE)
            ->count();
        $amountBasic = $amountMemberStatus + AMOUNT_SUB_USER_BY_ROLE[$user->role] * $countSub;
        $discount = isset($user->userSubscription->discount) ? $user->userSubscription->discount : FLAG_ZERO;
        $amountDiscount = round($amountBasic * $discount / FLAG_ONE_HUNDRED, FLAG_ZERO);
        $amountTax = round(($amountBasic - $amountDiscount) * TAX_PERSONAL, FLAG_ZERO);
        $amountTotal = round($amountBasic - $amountDiscount + $amountTax);
        return [
            'amounts_by_member' => $amountMemberStatus,
            'total_sub' => $countSub,
            'amounts_by_sub_user' => AMOUNT_SUB_USER_BY_ROLE[$user->role],
            'amount_basic' => $amountBasic,
            'discount' => $discount,
            'discount_value' => $amountDiscount,
            'tax' => $amountTax,
            'total_amount' => $amountTotal,
        ];
    }

    /**
     * function handle send mail after pay success
     *
     * @param $user
     * @param $memberStatus
     */
    public function handleSendEmailAfterPay($user, $memberStatus)
    {
        $this->sendMailChangeMemberStatus($user, $memberStatus);
        event(new Pay(true, $this->getDataUserToPayment($user['id']), $this->calculateAmountBySubUserAndAccount($user['id'])));
    }

    /**
     * Open close subUser
     *
     * @param $parentId
     * @param $typeProcess
     */
    public function openCloseSubUser($parentId, $typeProcess)
    {
        $this->model->where([
            'parent_id' => $parentId,
            'status' => $typeProcess == CLOSE ? OPEN : CLOSE,
        ])->update(['status' => $typeProcess]);
    }

    /**
     * Update member status
     *
     * @param $userId
     * @param $typeChange
     * @return bool
     */
    public function updateMemberStatus($userId, $typeChange)
    {
        try {
            $user = $this->find($userId);
            if ($user->canTrial()) {
                if (resolve(PayApiInterface::class)->createTrial($user, $typeChange)) {
                    $this->sendMailChangeMemberStatus($user, $typeChange);
                    return true;
                };
                return false;
            }
            if ($user->member_status == TRIALS) {
                if ($typeChange == FREE) {
                    return resolve(PayApiInterface::class)->downgrade($user, $typeChange);
                } else {
                    return resolve(PayApiInterface::class)->upgrade($user, $typeChange);
                }
            } else {
                if ($user->member_status > $typeChange) {
                    return resolve(PayApiInterface::class)->downgrade($user, $typeChange);
                } else {
                    return resolve(PayApiInterface::class)->upgrade($user, $typeChange);
                }
            }
        } catch (\Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * Change status User
     *
     * @param $id
     * @param $typeStatus
     */
    public function changeStatusUser($id, $typeStatus)
    {
        $this->find($id)->update(['status' => $typeStatus]);
    }

    /**
     * get list subUser by parentId
     *
     * @param $parentId
     * @return mixed
     */
    public function getListSubUserByParentId($parentId)
    {
        return $this->model->select('id')
                        ->with('profile:user_id,person_charge_last_name,person_charge_first_name')
                        ->where('parent_id', $parentId)
                        ->where('status', '<>', DISABLE)
                        ->orderBy('created_at', 'DESC')
                        ->get()->toArray();
    }

    /**
     * Delete user dont have profile
     *
     * @return mixed
     */
    public function deleteUserDontHaveProfile()
    {
        return $this->model->where('role', '<>', ADMIN)
            ->where('parent_id', '=', null)
            ->where('deleted_at', '=', null)
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime('-1 day', time())))
            ->doesntHave('profile')->forceDelete();
    }

    /**
     * Get sub user show home
     *
     * @param $user
     * @return array
     */
    public function getSubUserShowHome($user)
    {
        if ($user && $user->isMainUser()) {
            return $this->model->where('parent_id', $user->id)
                ->with('profile:user_id,person_charge_last_name,person_charge_first_name,avatar_thumbnail')
                ->orderBy('created_at', 'DESC')
                ->get()->toArray();
        }
        return [];
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getListDataDownCsv($params)
    {
        return $this->model->withTrashed()
            ->with('profile.specialties')
            ->with('userSubscription')
            ->where('role', array_flip(ROLE)[$params['role']])
            ->when(isset($params['status']) && $params['status'] == BLOCK_USER, function ($query) {
                return $query->whereIn('status', [CLOSE, DISABLE]);
            })
            ->when(isset($params['status']) && $params['status'] == NO_BLOCK_USER, function ($query) {
                return $query->where('status', OPEN);
            })
            ->when(isset($params['date_from_last_login']), function ($query) use ($params) {
                return $query->where('last_login', '>=', date("Y-m-d", strtotime($params['date_from_last_login'])) . TIME_START);
            })
            ->when(isset($params['date_to_last_login']), function ($query) use ($params) {
                return $query->where('last_login', '<=', date("Y-m-d", strtotime($params['date_to_last_login'])) . TIME_END);
            })
            ->when(isset($params['date_from_registration']), function ($query) use ($params) {
                return $query->where('created_at', '>=', date("Y-m-d", strtotime($params['date_from_registration'])) . TIME_START);
            })
            ->when(isset($params['date_to_registration']), function ($query) use ($params) {
                return $query->where('created_at', '<=', date("Y-m-d", strtotime($params['date_to_registration'])) . TIME_END);
            })
            ->when(isset($params['date_from_last_payment']) || isset($params['date_to_last_payment']), function ($query) use ($params) {
                return $query->whereHas('userSubscription', function ($query) use ($params) {
                    return $query->when(isset($params['date_from_last_payment']), function ($query) use ($params) {
                        return $query->where('finish_date', '>=', date("Y-m-d", strtotime($params['date_from_last_payment'])) . TIME_START);
                    })->when(isset($params['date_to_last_payment']), function ($query) use ($params) {
                        return $query->where('finish_date', '<=', date("Y-m-d", strtotime($params['date_to_last_payment'])) . TIME_END);
                    });
                });
            })
            ->get()->each->setAppends(['total_sub'])
            ->when(isset($params['min_sub_users']), function ($query) use ($params) {
                return $query->where('last_login', '>=', $params['min_sub_users']);
            })
            ->when(isset($params['max_sub_users']), function ($query) use ($params) {
                return $query->where('total_sub', '<=', $params['max_sub_users']);
            })
            ->toArray();
    }
}
