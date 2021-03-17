<?php

namespace App\Actions\Banner;

use App\Models\Banner;

class DeleteBanner
{
    public function execute($id)
    {
        Banner::destroy($id);
    }
}