<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SteamCodeRequest extends FormRequest
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
            'steam_code' => ['required', 'size:14'],
            'steam_seri' => ['required', 'size:14'],
            'type' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'steam_code.required' => 'Trường này không thể trống!',
            'steam_code.size' => 'Dữ liệu không chính xác, mã gồm 12 ký tự.',
            'steam_seri.required' => 'Trường này không thể trống!',
            'steam_seri.size' => 'Dữ liệu không chính xác, mã gồm 12 ký tự.',
            'type.required' => 'Chọn mệnh giá !.',
        ];
    }
}
