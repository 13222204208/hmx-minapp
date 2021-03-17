<?php

namespace App\Actions\Banner;

use App\Models\Banner;

class AddBanner
{
    public function execute($data)
    {
        return  Banner::create($data);
    }
}