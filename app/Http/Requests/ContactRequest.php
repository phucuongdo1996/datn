<?php

namespace App\Http\Requests;

use App\Rules\EmailProfileValidateRule;
use App\Rules\PhoneNumberValidateRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'house_name' => 'required',
            'user_name' => 'required',
            'email' => ['required', new EmailProfileValidateRule()],
            'phone_number' => ['required', new PhoneNumberValidateRule()],
            'note' => 'required',
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
            'house_name.required' => trans('validation.support.please_enter_here'),
            'user_name.required' => trans('validation.support.please_enter_here'),
            'email.required' => trans('validation.support.please_enter_here'),
            'phone_number.required' => trans('validation.support.please_enter_here'),
            'note.required' => trans('validation.support.please_enter_here'),
        ];
    }
}
