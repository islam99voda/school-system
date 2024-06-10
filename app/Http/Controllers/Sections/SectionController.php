<?php

namespace App\Http\Controllers\Sections;

use App\Http\Models\Grade;
use App\Http\Models\section;
use App\Http\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Models\Classroom;
use App\Http\Models\Student;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreSections;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
  {
    $Grades = Grade::with(['Sections'])->get();
    $list_Grades = Grade::all();
    $teachers = Teacher::all();
    return view('pages.Sections.Sections',compact('Grades','list_Grades','teachers'));
  }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $Sections = new section();
            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;
            $Sections->Status = 1;
            $Sections->save();
            $Sections->teachers()->attach($request->teacher_id);
            return redirect()->route('Sections.index');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(StoreSections $request)
    {
      try {
        $validated = $request->validated();
        $Sections = Section::findOrFail($request->id);

        $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
        $Sections->Grade_id = $request->Grade_id;
        $Sections->Class_id = $request->Class_id;

        if(isset($request->Status)) {
          $Sections->Status = 1;
        } else {
          $Sections->Status = 2;
        }

        // update pivot tABLE
        if (isset($request->teacher_id)) {
          $Sections->teachers()->sync($request->teacher_id);
      } else {
          $Sections->teachers()->sync(array());
      }


        $Sections->save();
        return redirect()->route('Sections.index');
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
     * @return Response
     */
    public function destroy(request $request)
    {

      Section::findOrFail($request->id)->delete();
      return redirect()->route('Sections.index');

    }

    public function getclasses($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        return $list_classes;
    }

    public function Get_students_table($Grade_id, $Classroom_id, $section_id)
    {
        $students = Student::with('gender', 'grade', 'classroom', 'section')
            ->where("Grade_id", $Grade_id)
            ->where("Classroom_id", $Classroom_id)
            ->where("section_id", $section_id)
            ->get(['id', 'name', 'email', 'gender_id', 'Grade_id', 'Classroom_id', 'section_id', 'academic_year']);
        return response()->json($students);
    }



}
