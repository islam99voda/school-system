<?php

namespace App\Repository;

use Exception;
use App\Http\Models\Gender;
use App\Http\Models\Teacher;
use App\Http\Models\Specialization;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{

    public function getAllTeachers(){
        return Teacher::all();
    }

    public function Getspecialization(){
        return Specialization::all();
    }

    public function GetGender(){
       return Gender::all();
    }
    

    public function StoreTeachers($request){

        try {
                $Teachers = new Teacher();
                $Teachers->Email = $request->Email;
                $Teachers->Password =  Hash::make($request->Password);
                $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
                $Teachers->Specialization_id = $request->Specialization_id;
                $Teachers->Gender_id = $request->Gender_id;
                $Teachers->Joining_Date = $request->Joining_Date;
                $Teachers->Address = $request->Address;
                $Teachers->save();
                return redirect()->route('Teachers.create');
            }
            catch (Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }


    public function editTeachers($id)
    {
        return Teacher::findOrFail($id);
    }    


    public function UpdateTeachers($request)
    {
        try {
            $Teachers = Teacher::findOrFail($request->id);
            $Teachers->Email = $request->Email;
            $Teachers->Password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            return redirect()->route('Teachers.index');
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function DeleteTeachers($request)
    {
        Teacher::findOrFail($request->id)->delete();
        return redirect()->route('Teachers.index');
    }

}