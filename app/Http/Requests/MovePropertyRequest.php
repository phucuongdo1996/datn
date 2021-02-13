<?php

namespace App\Http\Requests;

use App\Rules\CheckUserRule;
use App\Rules\CheckMemberStatusForUser;
use App\Rules\EmailProfileValidateRule;
use Illuminate\Foundation\Http\FormRequest;

class MovePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email_to' => ['bail', 'required', new EmailProfileValidateRule(), 'exists:users,email', new CheckUserRule(true, true, false), new CheckMemberStatusForUser(true)],
            'property' => ['required']
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email_to.required' => trans('validation.register.email.required'),
            'email_to.exists' => trans('validation.register.email.exists'),
            'property.required' => trans('validation.profile.required'),
        ];
    }
}
