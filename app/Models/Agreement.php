<?php

namespace App\Models;

use App\Traits\ImgUrl;

class Agreement extends BasicModel
{
    use ImgUrl;

    public function getContentAttribute($value)
    {
        return $this->replaceImgUrl($value);
    }
}
