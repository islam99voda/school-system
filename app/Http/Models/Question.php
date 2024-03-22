<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function quizze()
    {
        return $this->belongsTo('App\Http\Models\Quizze');
    }
}
