<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{

    use HasTranslations;
    public $translatable = ['Name_Class'];


    protected $table = 'Classrooms';
    public $timestamps = true;
    protected $fillable=['Name_Class','Grade_id'];


    // علاقة بين الصفوف المراحل الدراسية لجلب اسم المرحلة في جدول الصفوف

    public function Grades()
    {
        return $this->belongsTo('App\Http\Models\Grade', 'Grade_id');
    }

}