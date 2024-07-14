<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quizze extends Model
{
    use HasTranslations;
    public $translatable = ['name'];

    public function teacher()
    {
        return $this->belongsTo('App\Http\Models\Teacher', 'teacher_id');
    }



    public function subject()
    {
        return $this->belongsTo('App\Http\Models\Subject', 'subject_id');
    }


    public function grade()
    {
        return $this->belongsTo('App\Http\Models\Grade', 'grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo('App\Http\Models\Classroom', 'classroom_id');
    }


    public function section()
    {
        return $this->belongsTo('App\Http\Models\Section', 'section_id');
    }

    public function degree()
    {
        return $this->hasMany('App\Http\Models\Degree');
    }
}
