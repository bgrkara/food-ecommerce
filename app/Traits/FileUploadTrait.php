<?php
namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait FileUploadTrait{

    function uploadImage(Request $request, $inputName, $oldPath = NULL,  $path = '/uploads/user'){
        if ($request->hasFile($inputName)){
            $image = $request->{$inputName};
            $iname = str_replace(' ','-',pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
            $ext = $image->getClientOriginalExtension();
            $imageName = $iname.'-'.'media-'.uniqid().'.'.$ext;

            $image->move(public_path($path), $imageName);

            /* Delete Previous File if Exists */
            if ($oldPath && File::exists(public_path($oldPath))){
                File::delete(public_path($oldPath));
            }

            return $path. '/'. $imageName;
        }
        return NULL;
    }
    /*
     * Remove File
     */
    function removeImage(string $path) : void{
        if (File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }

}

