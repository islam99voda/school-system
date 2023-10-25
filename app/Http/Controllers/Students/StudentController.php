<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentsRequest;
use App\Repository\StudentRepositoryInterface;

class StudentController extends Controller
{
    protected $Student; //interfaceاللي جوه ال functionsهخزن فيها كل ال

    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Student = $Student;
    }



    
    public function index()
    {
       return $this->Student->Get_Student();
    }
    

    
    public function create()
    {
       return $this->Student->Create_Student();
    }




    public function store(StoreStudentsRequest $request)
    {
       return $this->Student->Store_Student($request);
    }




    public function show($id)
    {
        //
    }

    


    public function edit($id)
    {
        //
    }




    public function update(Request $request, $id)
    {
        //
    }

    


    public function destroy($id)
    {
        //
    }
    
    public function Get_classrooms($id)
    {
       return $this->Student->Get_classrooms($id);
    }

    public function Get_Sections($id)
    {
        return $this->Student->Get_Sections($id);
    }
}
