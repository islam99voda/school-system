<?php

namespace App\Http\Controllers\Grades;

use App\Http\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Models\Classroom;
use App\Http\Requests\StoreGrades;
use Illuminate\Routing\Controller;
use App\Models\Grade as ModelsGrade;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGrades $request)
{
        // Use the 'exists' method to check if a grade with the given name exists
        $existingGrade = Grade::where('Name->ar', $request->Name)
        ->orWhere('Name->en', $request->Name_en)
        ->exists();

        if ($existingGrade) {
        return redirect()->back()->withErrors(trans('Grades_trans.exists'));
        }
        try {
            $validated = $request->validated();
            $grade = new Grade();
            $grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
            $grade->Notes = $request->Notes;
            $grade->save();
            return redirect()->back()->with('success', 'Grade created successfully.');
        }
        
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        
}
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // المرحلة الدراسية اللي جايلك موجود في جدول الصفوف هاته id قبل ماتحذف لو لقيت  
        $MyClass_id = Classroom::where('Grade_id',$request->id)->pluck('Grade_id');
  
        if($MyClass_id->count() == 0){ //لو ملقتوش أحذف عادي
  
            $Grades = Grade::findOrFail($request->id)->delete();
            return redirect()->route('Grades.index');
        }

        else{
            return redirect()->route('Grades.index');
  
        }
  
    }
}
