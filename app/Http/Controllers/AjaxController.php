<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Classroom;
use App\Http\Models\section;

class AjaxController extends Controller
{
    // Get Classrooms
    public function getClassrooms($id)
    {
        return Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
    }

    //Get Sections
    public function Get_Sections($id){
        return section::where("Class_id", $id)->pluck("Name_Section", "id");
    }
}
