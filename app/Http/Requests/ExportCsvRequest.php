<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportCsvRequest extends FormRequest
{
    /**
     * Validated Form
     *
     * @return mixed
     */
    public function validatedForm()
    {
        return \request()->validate(
            $this->rules(),
            $this->messages()
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role' => 'required',
            'status' => 'required',
            'date_from_registration' => ['nullable', 'date_format:Y/m/d'],
            'date_to_registration' => ['nullable', 'date_format:Y/m/d'],
            'date_from_last_payment' => ['nullable', 'date_format:Y/m/d'],
            'date_to_last_payment' => ['nullable', 'date_format:Y/m/d'],
            'date_from_last_login' => ['nullable', 'date_format:Y/m/d'],
            'date_to_last_login' => ['nullable', 'date_format:Y/m/d'],
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
            'role.required' => trans('validation.export_csv.please_choose'),
            'status.required' => trans('validation.export_csv.please_choose'),
            'date_from_registration.date_format' => trans('validation.simulation.date_format'),
            'date_to_registration.date_format' => trans('validation.simulation.date_format'),
            'date_from_last_payment.date_format' => trans('validation.simulation.date_format'),
            'date_to_last_payment.date_format' => trans('validation.simulation.date_format'),
            'date_from_last_login.date_format' => trans('validation.simulation.date_format'),
            'date_to_last_login.date_format' => trans('validation.simulation.date_format'),
        ];
    }
}
