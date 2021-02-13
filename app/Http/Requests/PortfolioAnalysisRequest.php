<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumberValidateRule;
use Illuminate\Foundation\Http\FormRequest;

class PortfolioAnalysisRequest extends FormRequest
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
            'route_price' => [new PhoneNumberValidateRule()],
            'land_tax_assessment' => [new PhoneNumberValidateRule()],
            'tax_valuation' => [new PhoneNumberValidateRule()],
            'correction_factor' => ['regex: /^[0-9.]*$/'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return ['correction_factor.regex' =>  trans('validation.profile.phone.format')];
    }
}
