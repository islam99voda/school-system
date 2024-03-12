<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $fillable= ['filename','imageable_id','imageable_type'];

    public function imageable() //اسم العلاقة
    {
        return $this->morphTo();
    }
}
