<?php


if (!function_exists('image_path')) {
    function image_path($folder, $imageName)
    {
        return asset('storage/attachments/' . $folder . '/' . $imageName);
    }
}
