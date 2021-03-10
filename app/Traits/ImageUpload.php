<?php


namespace App\Traits;


use Illuminate\Support\Str;

trait ImageUpload
{
    public function NodeImageUpload($query) // Taking input image as parameter
    {
        $fullName = $query->getClientOriginalName();
        $uploadPath = 'userfiles/nodes/';
        $success = $query->move($uploadPath, $fullName);

        return $uploadPath. $fullName;
    }
}
