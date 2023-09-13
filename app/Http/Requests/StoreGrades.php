<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrades extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'Name' => 'required',
            'Name_en' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'Name.required' => trans('validation.required'),
            'Name_en.required' => trans('validation.required'),
        ];
    }
}
