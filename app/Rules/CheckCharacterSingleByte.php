<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckCharacterSingleByte implements Rule
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
        if (mb_strlen($value) == strlen($value)) {
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
        return trans('validation.profile.check_url_single_byte');
    }
}
