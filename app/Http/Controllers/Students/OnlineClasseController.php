<?php

namespace App\Http\Controllers\Students;

use App\Http\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Models\online_classe;
use App\Http\Controllers\Controller;

class OnlineClasseController extends Controller
{
    public function index()
    {
        $online_classes = online_classe::all();
        return view('pages.online_classes.index', compact('online_classes'));
    }


    public function indirectCreate()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.indirect', compact('Grades'));
    }


    public function storeIndirect(Request $request)
    {
        try {
            online_classe::create([
                'integration' => false,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'meeting_id' => $request->meeting_id, 
                'topic' => $request->topic, 
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            return redirect()->route('online_classes.index');
        }  catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }




    public function destroy(Request $request)
    {
        try {
            // Find the online_classe record by ID and delete it
            online_classe::findorfail($request->id)->delete();
    
            toastr()->success(trans('messages.Delete'));

            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the process
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
    
    
