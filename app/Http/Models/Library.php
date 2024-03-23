<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $table="library";

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

    public function teacher()
    {
        return $this->belongsTo('App\Http\Models\Teacher', 'teacher_id');
    }


}
