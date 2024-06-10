<?php

namespace App\Repository;
use App\Http\Models\Grade;
use App\Http\Models\Image;
use App\Http\Models\Gender;
use App\Http\Models\section;
use App\Http\Models\Student;
use App\Http\Models\Classroom;
use App\Http\Models\My_Parent;
use App\Http\Models\Type_Blood;
use App\Http\Models\Nationalitie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface{

    public function Get_Student()
    {
        $students = Student::all();
        return view('pages.Students.index',compact('students'));
    }


    public function Create_Student(){
        $data['my_classes'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();
        return view('pages.Students.add',$data);
     }

     public function Edit_Student($id)
     {
         $data['Grades'] = Grade::all();
         $data['parents'] = My_Parent::all();
         $data['Genders'] = Gender::all();
         $data['nationals'] = Nationalitie::all();
         $data['bloods'] = Type_Blood::all();
         $Students =  Student::findOrFail($id);
         return view('pages.Students.edit',$data,compact('Students'));
     }

     public function Update_Student($request)
    {
        try {
            $Edit_Students = Student::findorfail($request->id);
            $Edit_Students->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Edit_Students->email = $request->email;
            $Edit_Students->password = bcrypt($request->password);
            $Edit_Students->gender_id = $request->gender_id;
            $Edit_Students->nationalitie_id = $request->nationalitie_id;
            $Edit_Students->blood_id = $request->blood_id;
            $Edit_Students->Date_Birth = $request->Date_Birth;
            $Edit_Students->Grade_id = $request->Grade_id;
            $Edit_Students->Classroom_id = $request->Classroom_id;
            $Edit_Students->section_id = $request->section_id;
            $Edit_Students->parent_id = $request->parent_id;
            $Edit_Students->academic_year = $request->academic_year;
            $Edit_Students->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Delete_Student($request)
    {

        Student::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Students.index');
    }

     public function Get_classrooms($id){

        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        return $list_classes;

    }

    //Get Sections
    public function Get_Sections($id){

        $list_sections = section::where("Class_id", $id)->pluck("Name_Section", "id");
        return $list_sections;
    }
    public function Store_Student($request)
    {
        DB::beginTransaction(); //start transaction

        try {
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();

            // Create directory if it doesn't exist
            $directory = 'attachments/students/' . $students->name;
            // Insert img
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    // Store the file
                    $file->storeAs($directory, $name, 'upload_attachments');
                    // Insert in image_table
                    $image = new Image();
                    $image->filename = $name;
                    $image->imageable_id = $students->id;
                    $image->imageable_type = 'App\Http\Models\Student';
                    $image->save();
                }
            }
            DB::commit(); //end transaction
            toastr()->success(trans('messages.success'));
            return redirect()->route('Students.create');
        } catch (\Exception $e) {
            DB::rollBack(); //rollback if have error
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Show_Student($id)
    {
        $Student = Student::findorfail($id);

        return view('pages.Students.show',compact('Student'));
    }


    public function Upload_attachment($request)
    {
        foreach($request->file('photos') as $file)
        {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/'.$request->student_name, $file->getClientOriginalName(),'upload_attachments');
            // insert in image_table
            $images= new image();
            $images->filename=$name; // image name
            $images->imageable_id = $request->student_id; // student_id
            $images->imageable_type = 'App\Http\Models\Student'; // student model
            $images->save();
        }
            toastr()->success(trans('messages.success'));
            return redirect()->route('Students.show',$request->student_id);
    }



    public function Download_attachment($studentsname, $filename)
    {
        return response()->download(public_path('attachments/students/'.$studentsname.'/'.$filename));
    }



    public function Delete_attachment($request)
    {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);

        // Delete in data
        image::where('id',$request->id)->where('filename',$request->filename)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Students.show',$request->student_id);
    }

    public function Open_attachment($studentsname, $filename) {
        $filePath = 'attachments/students/' . $studentsname . '/' . $filename;

        if (Storage::disk('upload_attachments')->exists($filePath)) {
            return response()->file(storage_path($filePath));
        } else {
            abort(404, "File not found");
        }
    }
















}

