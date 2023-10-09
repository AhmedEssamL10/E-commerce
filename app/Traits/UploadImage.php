<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadImage
{
    public function upload($input, $typeName, $folder)
    {

        $image = $input;
        $extention = $image->getClientOriginalExtension();
        $imageName = $typeName . uniqid() . '.' . $extention;
        $path = public_path('images/' . $folder);
        $image->move($path, $imageName);
        return $imageName;
    }
}
