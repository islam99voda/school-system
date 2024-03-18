<?php


namespace App\Repository;

use App\Http\Models\Grade;
use App\Http\Models\Student;



class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface
{

    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.Students.Graduated.index',compact('students'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('pages.Students.Graduated.create',compact('Grades'));
    }

    public function SoftDelete($request)
    {
        $students = student::
        where('Grade_id',$request->Grade_id)
        ->where('Classroom_id',$request->Classroom_id)
        ->where('section_id',$request->section_id)
        ->get();

        if($students->count() == 0){
            return redirect()->back()->with('error_Graduated', __('لا يوجد طلاب بهذه المواصفات '));
        }

        foreach ($students as $student){
            $ids = explode(',',$student->id);
            student::whereIn('id', $ids)->Delete();
        }

        toastr()->success(trans('messages.success'));
        return redirect()->route('Graduated.index');
    }

    
    public function ReturnData($request)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->restore(); //زي ماكان null رجعله لأصله 
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    public function destroy($request)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }


}

