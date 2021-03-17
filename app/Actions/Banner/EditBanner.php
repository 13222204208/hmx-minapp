<?php

namespace App\Actions\Banner;

use App\Models\Banner;

class EditBanner
{
    public function execute($id)
    {
        return Banner::find($id);
    }
}