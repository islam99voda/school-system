<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Authenticatable
{
    use SoftDeletes;
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded =[];

    // علاقة بين الطلاب والانواع لجلب اسم النوع في جدول الطلاب
    public function gender()
    {
        return $this->belongsTo('App\Http\Models\Gender', 'gender_id');
    }

    // علاقة بين الطلاب والمراحل الدراسية لجلب اسم المرحلة في جدول الطلاب
    public function grade()
    {
        return $this->belongsTo('App\Http\Models\Grade', 'Grade_id');
    }

    // علاقة بين الطلاب الصفوف الدراسية لجلب اسم الصف في جدول الطلاب

    public function classroom()
    {
        return $this->belongsTo('App\Http\Models\Classroom', 'Classroom_id');
    }

    // علاقة بين الطلاب الاقسام الدراسية لجلب اسم القسم  في جدول الطلاب

    public function section()
    {
        return $this->belongsTo('App\Http\Models\Section', 'section_id');
    }

    // علاقة بين الطلاب والصور لجلب اسم الصور  في جدول الطلاب
    public function images()
{
    return $this->morphMany('App\Http\Models\Image', 'imageable');
}


    // علاقة بين الطلاب والجنسيات  لجلب اسم الجنسية  في جدول الجنسيات
    public function Nationality()
    {
        return $this->belongsTo('App\Http\Models\Nationalitie', 'nationalitie_id');
    }

    // علاقة بين الطلاب والاباء لجلب اسم الاب في جدول الاباء
    public function myparent()
    {
        return $this->belongsTo('App\Http\Models\My_Parent', 'parent_id');
    }

        // علاقة بين جدول سدادت الطلاب وجدول الطلاب لجلب اجمالي المدفوعات والمتبقي
        public function student_account()
        {
            return $this->hasMany('App\Http\Models\StudentAccount', 'student_id');
        }

           // علاقة بين جدول الطلاب وجدول الحضور والغياب
    public function attendance()
    {
        return $this->hasMany('App\Http\Models\Attendance', 'student_id');
    }
}
