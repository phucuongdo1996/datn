<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AddressValidateRule implements Rule
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
        if ( preg_match('/[^ぁ-んーァ-ヶー-龠ーｧ-ﾝﾞﾟー０-９Ａ-ｚa-zA-Z0-9-―‐]/u', $value) == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.profile.address_regex');
    }
}
