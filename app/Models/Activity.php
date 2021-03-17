<?php

namespace App\Models;

use App\Traits\ImgUrl;
use App\Models\BasicModel;

class Activity extends BasicModel
{
    use ImgUrl;

    public function getContentAttribute($value)
    {
        return $this->replaceImgUrl($value);
    }
}
