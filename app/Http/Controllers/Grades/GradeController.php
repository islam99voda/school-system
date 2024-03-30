<?php

namespace App\Http\Controllers\Grades;

use App\Http\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Models\Classroom;
use App\Http\Requests\StoreGrades;
use Illuminate\Routing\Controller;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Grades.index',compact('Grades'));
    }


    public function store(StoreGrades $request)
{
        //'exists' method to check if the grade already exists or not
        $existingGrade = Grade::where('Name->ar', $request->Name) //input ar
        ->orWhere('Name->en', $request->Name_en) //input en
        ->exists();

        if ($existingGrade) { //if the grade already exists
        return redirect()->back()->withErrors(trans('Grades_trans.exists'));
        }
        try {
            $validated = $request->validated();
            $grade = new Grade();
            $grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
            $grade->Notes = $request->Notes;
            $grade->save();
            toastr()->success(trans('messages.success'));
          return redirect()->route('Grades.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
}



    public function update(StoreGrades $request)
    {
    try {
        $validated = $request->validated();
        $Grades = Grade::findOrFail($request->id);
        $Grades->update([
            $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
            $Grades->Notes = $request->Notes,
        ]);
        return redirect()->route('Grades.index');
    }
    catch
    (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }



    public function destroy(Request $request)
    {

        $MyClass_id = Classroom::where('Grade_id',$request->id)->pluck('Grade_id');

        if($MyClass_id->count() == 0){ 

            $Grades = Grade::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('Grades.index');        }
        else{
            toastr()->error(trans('Grades_trans.delete_Grade_Error'));
            return redirect()->route('Grades.index');
        }
    }
}
