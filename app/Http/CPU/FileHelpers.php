<?php

namespace App\Http\CPU;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileHelpers
{
    public static function handleImage($file, $path, $oldImage = null, bool $preferOriginalName = false)
    {
        if ($file) {

            // Get the file's original name and extension
            $file_name = $file->getClientOriginalName();
            $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Generate a new unique file name
            if ($preferOriginalName) {
                $originalBase = pathinfo($file_name, PATHINFO_FILENAME);
                $safeBase = Str::slug($originalBase, '-');
                $fileName = ($safeBase === '' ? (string) time() : $safeBase) . '.' . $extension;
            } else {
                $fileName = time() . '.' . $extension;
            }

            // Upload the new file
            $put = Storage::disk('public')->put($path . $fileName, File::get($file));

            // If upload is successful
            if ($put) {
                // If it's an update (old image exists), delete the old image
                if ($oldImage) {
                    // Check if the old image exists before trying to delete it
                    $oldImagePath = storage_path('app/public/' . $oldImage->path);

                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);  // Delete the old image file
                    }
                }
                // Return a new Image instance for saving in the relationship
                return ['path' => $path . $fileName];
            }
        }

        // If no file is uploaded or upload fails, return null
        return null;
    }


    public static function fileSize($file, $precision = 2)
    {
        $size = $file->getSize();
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }
        return $size;
    }

    public static function deleteImage($path)
    {
        if ($path) {
            $image_path = storage_path('app/public/' . $path);
            if (file_exists($image_path)) {
                unlink($image_path);
            }else{
                $image_path = public_path($path);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }
    }
}
