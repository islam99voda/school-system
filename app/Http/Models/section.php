<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class section extends Model
{
    use HasTranslations;
    public $translatable = ['Name_Section'];
    protected $fillable=['Name_Section','Grade_id','Class_id'];

    protected $table = 'sections';
    public $timestamps = true;


    // علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول الاقسام
    public function My_classs()
    {
        return $this->belongsTo('App\Http\Models\Classroom', 'Class_id');
    }

    // علاقة الاقسام مع المعلمين
    public function teachers() 
    {
        return $this->belongsToMany('App\Http\Models\Teacher','teacher_section'); //teacher_sectionاللي اسمه bivit table لازم احط اسم ال
    }
}
