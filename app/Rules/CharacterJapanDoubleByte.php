<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CharacterJapanDoubleByte implements Rule
{
    /**
     * Message return
     *
     * @var
     */
    private $message;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (preg_match('/[^ぁ-んー-龠ーァ-ヶー]/u', $value) == 0 ) {
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
        return trans('validation.profile.characters_japan_double_byte');
    }
}
