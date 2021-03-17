<?php

namespace App\Models;

use App\Models\BasicModel;

class Enroll extends BasicModel
{
   public function activity()
   {
       return $this->hasOne('App\Models\Activity','id','activity_id');
   }
}
