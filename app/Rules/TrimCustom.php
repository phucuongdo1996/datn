<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TrimCustom implements Rule
{
    private $message;

    /**
     * TrimCustom constructor.
     *
     * @param null|string $message
     */
    public function __construct($message = null)
    {
        $this->message = $message;
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
        return mb_ereg_replace(
            '^[[:space:]]*([\s\S]*?)[[:space:]]*$', '\1', $value );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->message != null) {
            return $this->message;
        }

        return trans('validation.property.required');
    }
}
