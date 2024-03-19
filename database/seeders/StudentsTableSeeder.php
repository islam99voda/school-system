<?php

namespace Database\Seeders;

use App\Http\Models\Type_Blood;
use App\Http\Models\my_Parent;
use App\Http\Models\Grade;
use App\Http\Models\section;
use App\Http\Models\Student;
use App\Http\Models\Classroom;
use Illuminate\Database\Seeder;
use App\Http\Models\Nationalitie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->delete();
        $students = new Student();
        $students->name = ['ar' => 'احمد ابراهيم', 'en' => 'Ahmed Ibrahim'];
        $students->email = 'Ahmed_Ibrahim@yahoo.com';
        $students->password = Hash::make('12345678');
        $students->gender_id = 1;
        $students->nationalitie_id = Nationalitie::all()->unique()->random()->id;
        $students->blood_id =Type_Blood::all()->unique()->random()->id;
        $students->Date_Birth = date('1995-01-01');
        $students->Grade_id = Grade::all()->unique()->random()->id;
        $students->Classroom_id =Classroom::all()->unique()->random()->id;
        $students->section_id = section::all()->unique()->random()->id;
        $students->parent_id = my_Parent::all()->unique()->random()->id;
        $students->academic_year ='2021';
        $students->save();
    }
}
