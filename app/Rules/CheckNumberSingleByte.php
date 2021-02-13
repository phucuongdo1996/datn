<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckNumberSingleByte implements Rule
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
        if (preg_match("/^[0-9]{1,6}$/", $value)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.profile.license_single_byte');
    }
}
