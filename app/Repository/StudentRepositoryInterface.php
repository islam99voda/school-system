<?php

namespace App\Repository;

interface StudentRepositoryInterface{

    //  Get_Student
    public function Get_Student();
    
    // Get Add Form Student
    public function Create_Student();
     
     // Get classrooms
     public function Get_classrooms($id);

     //Get Sections
     public function Get_Sections($id);

     //Store_Student
    public function Store_Student($request);

    public function Show_Student($id);

    public function Upload_attachment($request);
    
    public function Download_attachment($studentsname,$filename);

    //Delete_attachment
    public function Delete_attachment($request);

    public function Open_attachment($studentsname, $filename);
}


