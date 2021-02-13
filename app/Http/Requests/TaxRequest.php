<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NumberOneByteRule;
use Illuminate\Http\Request;

class TaxRequest extends FormRequest
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
            'rent' => ['nullable', new NumberOneByteRule()],
            'key_money' => ['nullable', new NumberOneByteRule()],
            'total_income' => ['nullable', new NumberOneByteRule()],
            'taxes_dues' => ['nullable', new NumberOneByteRule()],
            'non_life_insurance_premiums' => ['nullable', new NumberOneByteRule()],
            'repair_costs' => ['nullable', new NumberOneByteRule()],
            'depreciation' => ['nullable', new NumberOneByteRule()],
            'borrowing_interest' => ['nullable', new NumberOneByteRule()],
            'payment_rent' => ['nullable', new NumberOneByteRule()],
            'salary_wage' => ['nullable', new NumberOneByteRule()],
            'total_required_expenses' => ['nullable', new NumberOneByteRule()],
            'balance' => ['nullable', new NumberOneByteRule()],
            'year' => 'required',
            'month' => 'required',
            'other_income' => ['nullable', new NumberOneByteRule()],
            'maintenance_management_fee' => ['nullable', new NumberOneByteRule()],
            'utilities_expenses' => ['nullable', new NumberOneByteRule()],
            'management_fee' => ['nullable', new NumberOneByteRule()],
            'commission_paid' => ['nullable', new NumberOneByteRule()],
            'loan_loss' => ['nullable', new NumberOneByteRule()],
            'other_expenses' => ['nullable', new NumberOneByteRule()],
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
            'year.required' => trans('validation.tax.choose_year'),
            'month.required' => trans('validation.tax.choose_month'),
        ];
    }
}
