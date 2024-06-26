<?php

namespace App\Repository;

use App\Http\Models\Grade;
use App\Http\Models\Library;
use App\Http\Traits\AttachFilesTrait;

class LibraryRepository implements LibraryRepositoryInterface
{

    use AttachFilesTrait;

    public function index()
    {
        $books = Library::all();
        return view('pages.library.index',compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.library.create',compact('grades'));
    }

    public function store($request)
    {
        try {
            $books = new Library();
            $books->title = $request->title;
            $books->file_name =  $request->file('file_name')->getClientOriginalName();
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = 1;
            $books->save();
            $this->uploadFile($request,'file_name','library'); // upload file take three parameters (request,file_name,folder_name)
            toastr()->success(trans('messages.success'));
            return redirect()->route('library.create');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $grades = Grade::all();
        $book = library::findorFail($id);
        return view('pages.library.edit',compact('book','grades'));
    }

    public function update($request)
    {
        try {
            $book = library::findorFail($request->id);
            $book->title = $request->title;
            if($request->hasfile('file_name')){
                $this->deleteFile($book->file_name);
                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $this->uploadFile($request,'file_name','library'); // upload file take three parameters (request,file_name,folder_name)

                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            }

            $book->Grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $this->deleteFile($request->file_name);
        library::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('library.index');
    }

    public function show($filename)
    {
        $file_path = storage_path('app/attachments/library/' . $filename);

        if (file_exists($file_path)) {
            return response()->file($file_path);
        } else {
            abort(404, 'File not found');
        }
    }

    public function download($filename)
    {
        $file_path = storage_path('app/attachments/library/' . $filename);
        if (file_exists($file_path)) {
            return response()->download($file_path);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }
    
}
