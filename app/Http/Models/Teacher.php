<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];
    protected $guarded=[];

    // علاقة بين المعلمين والتخصصات لجلب اسم التخصص
    public function specializations()
    {
        return $this->belongsTo('App\Http\Models\Specialization', 'Specialization_id');
    }

    // علاقة بين المعلمين والانواع لجلب جنس المعلم
    public function genders()
    {
        return $this->belongsTo('App\Http\Models\Gender', 'Gender_id');
    }

    // علاقة المعلمين مع الاقسام
    public function Sections()
    {
        return $this->belongsToMany('App\Http\Models\Section','teacher_section');
    }
}

