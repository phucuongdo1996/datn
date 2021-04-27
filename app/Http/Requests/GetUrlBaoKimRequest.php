<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetUrlBaoKimRequest extends FormRequest
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
            'total_amount' => ['required'],
        ];
    }

    public function messages()
    {
        return [
          'total_amount.required' => 'Hãy chọn mức nạp !',
        ];
    }
}
