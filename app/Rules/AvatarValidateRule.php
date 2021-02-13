<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AvatarValidateRule implements Rule
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
        if (!is_file($value)) {
            return true;
        }
        if ($value->getSize() > MAX_SIZE_AVATAR) {
            $this->message = trans('validation.profile.avatar.max_size');
            return false;
        }
        if (!in_array($value->extension(), EXTENSION_IMAGE)) {
            $this->message = trans('validation.profile.avatar.extension');
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
        return $this->message;
    }
}
