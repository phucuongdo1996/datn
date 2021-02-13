<?php

namespace App\Rules;

use App\Repositories\SubUserProperty\SubUserPropertyEloquentRepository;
use Illuminate\Contracts\Validation\Rule;

class CheckPermissionUpdateProperty implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!resolve(SubUserPropertyEloquentRepository::class)->handleCheckPermission($value, EDIT_SCREEN)) {
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
        return trans('messages.sub_user.edit_property_permission_denied');
    }
}
