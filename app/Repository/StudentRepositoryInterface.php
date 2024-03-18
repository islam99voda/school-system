<?php

namespace App\Repository;

interface StudentRepositoryInterface{

    //  Get_Student
    public function Get_Student();
    
    // Get Add Form Student
    public function Create_Student();
     
     // Edit_Student
    public function Edit_Student($id);

     // Get classrooms
     public function Get_classrooms($id);

     //Get Sections
     public function Get_Sections($id);

     //Store_Student
    public function Store_Student($request);

    public function Show_Student($id);
    
    //Update_Student
    public function Update_Student($request);

    //Delete_Student
    public function Delete_Student($request);

    public function Upload_attachment($request);
    
    public function Download_attachment($studentsname,$filename);

    //Delete_attachment
    public function Delete_attachment($request);

    public function Open_attachment($studentsname, $filename);
}


