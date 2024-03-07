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
            'Name' => 'required|unique:grades,name->ar,'.$this->id, //coulm ar
            'Name_en' => 'required|unique:grades,name->en,'.$this->id, //coulm en
        ];
    }

    public function messages()
    {
        return [
            'Name.required' => trans('Grades_trans.grade_ar_required'),
            'Name.unique' => trans('Grades_trans.grade_unique_ar'),
            'Name_en.required' => trans('Grades_trans.grade_en_required'),
            'Name_en.unique' => trans('Grades_trans.grade_unique_en'),
        ];
    }
}
