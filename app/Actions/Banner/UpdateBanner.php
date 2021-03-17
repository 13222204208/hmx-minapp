<?php

namespace App\Actions\Banner;

use App\Models\Banner;
use Illuminate\Support\Facades\Hash;

class UpdateBanner
{
    public function execute($data,$id)
    {
        Banner::where('id',$id)->update($data);
    }
}