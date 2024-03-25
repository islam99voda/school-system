<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Translatable\HasTranslations;

class My_Parent extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name_Father','Job_Father','Name_Mother','Job_Mother']; //دول هيتم ترجمتهم
    protected $table = 'my__parents';
    protected $guarded = [];
}
