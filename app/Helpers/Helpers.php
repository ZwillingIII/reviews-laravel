<?php

namespace App\Helpers;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helpers
{
    public static function uploadFileFromRequest(UploadedFile $uploadedFile, $disk = 'public', $path = null): File
    {
//        $extension = config('mimetypes')[$uploadedFile->getExtension() ?: $uploadedFile->getClientOriginalExtension()];
        $filename = Str::uuid() . '.' . $uploadedFile->getClientOriginalExtension();
        Storage::disk($disk)->put(implode('/', [$path, $filename]), fopen($uploadedFile, 'r+'));
        $file = new File();
        $file->name = $filename;
        $file->disk = $disk;
        $file->path = $path;
        $file->type = $uploadedFile->getMimeType() ?? $uploadedFile->getClientMimeType();
        $file->original = $uploadedFile->getClientOriginalName();
        $file->size = $uploadedFile->getSize();
        $file->save();
        return $file;
    }
}
