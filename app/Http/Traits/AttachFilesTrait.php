<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{
        public function uploadFile($request,$name,$folder)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/',$folder.'/'.$file_name,'library');
        //store as take two parameters (path, name, disk)
    }

    public function deleteFile($name)
    {
        $exists = Storage::disk('library')->exists('attachments/library/'.$name);

        if($exists)
        {
            Storage::disk('library')->delete('attachments/library/'.$name);
        }
    }

    public function downloadfile($name)
    {
        return Storage::disk('library')->download('attachments/library/'.$name);
    }
    
}
