<?php

namespace App\Http\Requests;

use App\Rules\EmailProfileValidateRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailValidationRule;
use App\Rules\ValidationMailOfNetwork;
use App\Rules\PasswordValidationRule;

class UserRegisterRequest extends FormRequest
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
            'email' => ['bail', 'required', 'max:60', new EmailProfileValidateRule(), 'unique:users,email', new ValidationMailOfNetwork()],
            'password' => ['bail', 'required', 'min:8', 'max:30', new PasswordValidationRule()],
        ];
    }

    /**
     * Message Respone Validation user store
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => trans('validation.register.email.required'),
            'email.max' => trans('validation.register.email.max'),
            'email.unique' => trans('validation.register.email.unique'),
            'password.required' => trans('validation.register.password.required'),
            'password.min' => trans('validation.register.password.min_max'),
            'password.max' => trans('validation.register.password.min_max'),
        ];
    }
}
