<?php

namespace App\Http\Requests;

use App\Rules\CharacterJapanDoubleByte;
use App\Rules\EmailProfileValidateRule;
use App\Rules\ValidationMailOfNetwork;
use Illuminate\Foundation\Http\FormRequest;

class AdminInviteUserRequest extends FormRequest
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
            'person_charge_first_name' => ['required', new CharacterJapanDoubleByte()],
            'person_charge_last_name' => ['required', new CharacterJapanDoubleByte()],
            'email' => ['bail', 'required', 'max:60', new EmailProfileValidateRule(), 'unique:users,email', new ValidationMailOfNetwork()],
        ];
    }

    /**
     * Message Response Validation user store
     *
     * @return array
     */
    public function messages()
    {
        return [
            'person_charge_first_name.required' => trans('validation.profile.required'),
            'person_charge_last_name.required' => trans('validation.profile.required'),
            'email.required' => trans('validation.register.email.required'),
            'email.max' => trans('validation.register.email.max'),
            'email.unique' => trans('validation.register.email.unique'),
        ];
    }
}
