<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Models\Quizze;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExamsController extends Controller
{

    public function index()
    {
        $quizzes = Quizze::where('grade_id', auth()->user()->Grade_id)
            ->where('classroom_id', auth()->user()->Classroom_id)
            ->where('section_id', auth()->user()->section_id)
            ->orderBy('id', 'DESC')
            ->get();
        return view('pages.Students.dashboard.exams.index', compact('quizzes'));
    }

    public function show($quizze_id)
    {
        $student_id = Auth::user()->id;
        return view('pages.Students.dashboard.exams.show',compact('quizze_id','student_id'));
    }

}
