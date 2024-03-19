<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiptStudent extends Model
{
    public function student()
    {
        return $this->belongsTo('App\Http\Models\Student', 'student_id');
    }
}
