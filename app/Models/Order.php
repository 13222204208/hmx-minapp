<?php

namespace App\Models;

use App\Models\BasicModel;


class Order extends BasicModel
{
    public function user()
    {
        return $this->hasOne("App\Models\User","id","user_id");
    }
}
