<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee_invoice extends Model
{
    protected $guarded = [];
    public function grade()
    {
        return $this->belongsTo('App\Http\Models\Grade', 'Grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo('App\Http\Models\Classroom', 'Classroom_id');
    }


    public function section()
    {
        return $this->belongsTo('App\Http\Models\Section', 'section_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Http\Models\Student', 'student_id');
    }

    public function fees()
    {
        return $this->belongsTo('App\Http\Models\Fee', 'fee_id');
    }
}
