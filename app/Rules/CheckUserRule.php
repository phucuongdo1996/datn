<?php

namespace App\Rules;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Validation\Rule;

class CheckUserRule implements Rule
{
    private $checkProfileUser;

    private $checkMainUser;

    private $checkPremiumUser;

    /**
     * CheckUserPremiumRule constructor.
     *
     * @param $checkProfileUser
     * @param $checkMainUser
     * @param $checkPremiumUser
     */
    public function __construct($checkProfileUser, $checkMainUser, $checkPremiumUser)
    {
        $this->checkProfileUser = $checkProfileUser;
        $this->checkMainUser = $checkMainUser;
        $this->checkPremiumUser = $checkPremiumUser;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = resolve(UserRepositoryInterface::class)->findByEmail($value);
        if (!$user) {
            return false;
        }
        if ($this->checkProfileUser && !$user->profile) {
            return false;
        }
        if ($this->checkMainUser && $user->isSubUser()) {
            return false;
        }
        if ($this->checkPremiumUser && $user->member_status == FREE) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.register.email.illegal');
    }
}
