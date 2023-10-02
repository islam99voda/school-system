<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable=['Name','Notes'];
    protected $table = 'Grades';
    public $timestamps = true;

    // علاقة المراحل الدراسية لجلب الاقسام المتعلقة بكل مرحلة
    public function Sections()
    {
        return $this->hasMany('App\Http\Models\section', 'Grade_id');
    }
    
}
