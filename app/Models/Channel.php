<?php

namespace App\Models;

use App\Models\BasicModel;


class Channel extends BasicModel
{
    public function content()
    {
        return $this->hasMany('App\Models\Content','channel_id','id');
    }
}
