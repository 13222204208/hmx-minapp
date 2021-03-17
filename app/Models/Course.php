<?php

namespace App\Models;

use App\Models\BasicModel;
use App\Traits\ImgUrl;

class Course extends BasicModel
{
    use ImgUrl;

    public function getContentAttribute($value)
    {
        return $this->replaceImgUrl($value);
    }
 
}
