<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroom extends FormRequest
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
            'List_Classes.*.Name' => 'required',
            'List_Classes.*.Name_class_en' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'List_Classes.*.Name.required' => trans('My_Classes_trans.class_ar_required'),
            'List_Classes.*.Name_class_en.required' => trans('My_Classes_trans.class_en_required'),
        ];
    }
}
