<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentStudent extends Model
{
    public function student()
    {
        return $this->belongsTo('App\Http\Models\Student', 'student_id');
    }
}
