<?php

namespace App\Models;

use App\Traits\ImgUrl;
use App\Models\BasicModel;

class Content extends BasicModel
{
    use ImgUrl;

    public function channel()
    {
        return $this->hasOne('App\Models\Channel','id','channel_id');
    }

    public function getContentAttribute($value)
    {
        return $this->replaceImgUrl($value);
    }
}
