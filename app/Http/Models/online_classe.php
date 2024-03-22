<?php

namespace App\Http\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class online_classe extends Model
{
    //protected $guarded=[''];
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
