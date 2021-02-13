<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckPermissionUpdateProperty;

class UpdateNetProfitRequest extends FormRequest
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
            'net_profit' => ['nullable', 'regex:/^[0-9.]*$/'],
            'property_id' => [new CheckPermissionUpdateProperty()]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'net_profit.regex' => trans('validation.profile.phone.format')
        ];
    }
}
