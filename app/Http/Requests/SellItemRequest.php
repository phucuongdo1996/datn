<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellItemRequest extends FormRequest
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
            'price' => ['required','numeric', 'min:1', 'max:1000000000'],
            'check_submit' => ['required']
        ];
    }

    public function messages()
    {
        return [
          'price.required' => 'Giá bán không thể trống!',
          'price.min' => 'Giá bán phải lớn hơn 0!',
          'price.max' => 'Giá bán quá cao!',
          'check_submit.required' => 'Cần xác nhận!',
        ];
    }
}
