<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
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
        $rules = [
            'category_id' => 'required',
            'title' => 'required'
        ];
        if ($this->method() == 'POST') {
            return $rules;
        }
        if ($this->method() == 'PUT') {
            $rules['id'] = 'required';
            $rules['user_id'] = 'required';
            $rules['time_open_page'] = 'required';
            return $rules;
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => trans('validation.topic.title'),
            'category_id.required' => trans('validation.simulation.select_required'),
        ];
    }
}
