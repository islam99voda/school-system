<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait AttachFilesTrait
{


    public function saveImage(UploadedFile $image, $path)
    {
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        Storage::putFileAs($path, $image, $filename);

        return $filename;
    }



    public function uploadFile($file, $name, $folder, $disk)
    {
        define('dinamicfolder', 'attachments/');
        $file->storeAs(dinamicfolder, $folder . '/' . $name, $disk);
    }
    




    public function delete_one_file($disk, $folder) //use to delete folder has one file only
    {
        $path = 'attachments/' . $folder;
        if(!empty($path))
        Storage::disk($disk)->deleteDirectory($path);
}



public function deleteFile($disk, $folder,$name )
{
    $path = Storage::disk($disk)->exists('attachments/',$folder .'/'.$name,);
    if($path)
    {
        Storage::disk($disk)->delete('attachments/',$folder .'/'.$name,);
    }
}

public function downloadfile($name)
    {
        return Storage::disk('library')->download('attachments/library/'.$name);
    }
    
}
