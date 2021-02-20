<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_code',
        'name',
        'email',
        'role',
        'password',
        'status',
        'verified_status',
        'member_status',
        'last_login',
        'parent_id',
        'reason_delete',
        'group_code',
        'sub_user_deleted',
        'unblock_status',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Role id of user
     */
    protected const ROLES_USER = [INVESTOR, BROKER, EXPERT];

    /**
     * Relationship with property table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function property()
    {
        return $this->hasMany(Property::class, 'user_id', 'id');
    }

    /**
     * Relationship with property table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taxes()
    {
        return $this->hasMany(Tax::class, 'user_id', 'id');
    }

    /**
     * Relationship with portfolio_analysis table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function portfolioAnalysis()
    {
        return $this->hasMany(PortfolioAnalysis::class, 'user_id', 'id');
    }

    /**
     * Relationship with profile table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    /**
     * Relationship with user_subscription table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userSubscription()
    {
        return $this->hasOne(UserSubscription::class, 'user_id', 'id');
    }

    /**
     * Relationship with articlePhoto table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articlePhotos()
    {
        return $this->hasMany(ArticlePhoto::class, 'user_id', 'id');
    }

    /**
     * Relationship with topics table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics()
    {
        return $this->hasMany(Topic::class, 'user_id', 'id');
    }

    /**
     * Relationship with payments_of_main_user table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }

    /**
     * Check role is user
     *
     * @return bool
     */
    public function isUser(): bool
    {
        return in_array($this->getAttribute('role'), self::ROLES_USER);
    }

    /**
     * Check role is admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->getAttribute('role') == ADMIN;
    }

    /**
     * Check role is investor
     *
     * @return bool
     */
    public function isInvestor(): bool
    {
        return $this->getAttribute('role') == INVESTOR;
    }

    /**
     * Check role is broker
     *
     * @return bool
     */
    public function isBroker(): bool
    {
        return $this->getAttribute('role') == BROKER;
    }

    /**
     * Check role is expert
     *
     * @return bool
     */
    public function isExpert(): bool
    {
        return $this->getAttribute('role') == EXPERT;
    }

    /**
     * Check role is sub user
     *
     * @return bool
     */
    public function isSubUser(): bool
    {
        return $this->getAttribute('parent_id') != null;
    }

    /**
     * Check role is main user
     *
     * @return bool
     */
    public function isMainUser(): bool
    {
        return !$this->isAdmin() && $this->getAttribute('parent_id') == null;
    }

    /**
     * Check role
     *
     * @param array $roles List role name
     *
     * @return bool
     */
    public function hasRole($roles): bool
    {
        return in_array(ROLES[$this->getAttribute('role')], $roles);
    }

    /**
     * Check plan
     *
     * @param $plans
     * @return bool
     */
    public function hasPlan($plans): bool
    {
        return in_array(PLAN_NAME[$this->getMemberStatus()], $plans);
    }

    /**
     * Check member status is trials
     *
     * @return bool
     */
    public function isTrial(): bool
    {
        return $this->getAttribute('member_status') == TRIALS;
    }

    /**
     * Check member status is free
     *
     * @return bool
     */
    public function isFreeMember(): bool
    {
        return $this->getMemberStatus() == FREE;
    }

    /**
     * Check member status is paid member
     *
     * @return bool
     */
    public function isBasicMember(): bool
    {
        return $this->getMemberStatus() == BASIC;
    }

    /**
     * Check member status is premium
     *
     * @return bool
     */
    public function isPremiumMember(): bool
    {
        return $this->getMemberStatus() == PREMIUM;
    }

    /**
     * check user in trial
     *
     * @return bool
     */
    public function inTrial()
    {
        return $this->userSubscription()->where('is_trial', true)->count() != FLAG_ZERO;
    }

    /**
     * Check can trial
     *
     * @return bool
     */
    public function canTrial()
    {
        return $this->userSubscription()->withTrashed()->count() == FLAG_ZERO;
    }

    /**
     * Relationship with supports table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function supports()
    {
        return $this->hasMany(Support::class, 'user_id', 'id');
    }

    /**
     * get member status
     *
     * @return mixed
     */
    public function getMemberStatus()
    {
        if ($this->isTrial()) {
            return $this->userSubscription->trial_status;
        }
        return $this->getAttribute('member_status');
    }

    /**
     * Relationship with sub_user_permissions table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subUserPermission()
    {
        return $this->hasOne(SubUserPermission::class, 'id_sub_user', 'id');
    }

    /**
     * Relationship with subUserProperty table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subUserProperty()
    {
        return $this->hasMany(SubUserProperty::class, 'user_id', 'id');
    }

    /**
     * Check has Permission Property
     *
     * @param $permissions
     * @return bool
     */
    public function hasPermissionProperty($permissions)
    {
        if (count(array_intersect($this->subUserProperty()->pluck('permission')->toArray(), $permissions))) {
            return true;
        }
        return false;
    }

    /**
     * Get permission
     *
     * @return array
     */
    public function getPermission()
    {
        $permissions = [];
        if ($this->subUserPermission['change_property'] == true) {
            array_push($permissions, CHANGE_PROPERTY);
        }
        if ($this->subUserPermission['change_sub_user'] == true) {
            array_push($permissions, CHANGE_SUB_USER);
        }
        if ($this->subUserPermission['change_plan'] == true) {
            array_push($permissions, CHANGE_PLAN);
        }
        if ($this->subUserPermission['change_mypage'] == true) {
            array_push($permissions, CHANGE_MYPAGE);
        }
        return $permissions;
    }

    /**
     * Check has permission
     *
     * @param mixed ...$permission
     * @return bool
     */
    public function hasPermission(...$permission)
    {
        if (!$this->isSubUser()) {
            return false;
        }
        if (count(array_intersect($permission, $this->getPermission())) != FLAG_ZERO) {
            return true;
        }
        return false;
    }

    /**
     * Get parent User
     *
     * @return mixed
     */
    public function getParentUser()
    {
        return User::find($this->getAttribute('parent_id'));
    }

    /**
     * Get user Proxy
     *
     * @param mixed ...$permission
     * @return $this|mixed|null
     */
    public function userProxy(...$permission)
    {
        if (!$this->isSubUser()) {
            return $this;
        }
        if ($this->hasPermission(...$permission)) {
            return $this->getParentUser();
        }
        return null;
    }

    /**
     * @return array
     */
    public function getAmountFeeAttribute()
    {
        if ($this->isAdmin()) {
            return [];
        }
        $amountMemberStatus = AMOUNT_BY_ROLE_MEMBER_STATUS[$this->role][$this->getMemberStatus()];
        $countSub =  User::where('parent_id', $this->id)
            ->where('status', '<>', DISABLE)
            ->count();
        $amountBasic = $amountMemberStatus +  AMOUNT_SUB_USER_BY_ROLE[$this->role] * $countSub;
        $discount = isset($this->userSubscription->discount) ? $this->userSubscription->discount : FLAG_ZERO;
        $amountDiscount = round($amountBasic * $discount / FLAG_ONE_HUNDRED, FLAG_ZERO);
        $amountTax = round(($amountBasic - $amountDiscount) * TAX_PERSONAL, FLAG_ZERO);
        $amountTotal = round($amountBasic - $amountDiscount + $amountTax);
        return [
            'amounts_by_member' => $amountMemberStatus,
            'total_sub' => $countSub,
            'amounts_by_sub_user' => AMOUNT_SUB_USER_BY_ROLE[$this->role],
            'amount_basic' => $amountBasic,
            'discount' => $discount,
            'discount_value' => $amountDiscount,
            'tax' => $amountTax,
            'total_amount' => $amountTotal,
        ];
    }

    /**
     * @return array
     */
    public function getTotalSubAttribute()
    {
        if ($this->isAdmin()) {
            return [];
        }
        return  User::where('parent_id', $this->id)
            ->where('status', '<>', DISABLE)
            ->count();
    }
}
