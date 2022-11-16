<?php

namespace App\Http\Common;

use Illuminate\Support\Facades\Storage;

class Common
{
    public static function handleUploadFile($uploadPath, $name, $request)
    {
        $fullPath = '';
        if (!$request->hasFile($name)) {
            return $fullPath;
        }

        $file = $request->file($name);
        $saveName = $file->hashName();
        $fullPath = $uploadPath . $saveName;
        if (!Storage::disk()->exists($uploadPath)) {
            Storage::disk()->makeDirectory($uploadPath);
        }
        Storage::disk()->put($fullPath, file_get_contents($file));
        return $fullPath;
    }

    public static function handleDeleteFile($name, $request)
    {
        $fileDelete = $request->get($name);
        if (Storage::disk()->exists($fileDelete)) {
            Storage::disk()->delete($fileDelete);
        }
        return $fileDelete;
    }
}
