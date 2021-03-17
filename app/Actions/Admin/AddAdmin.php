<?php

namespace App\Actions\Admin;

use App\Models\Admin;

class AddAdmin
{
    public function execute($data)
    {
        return  Admin::create($data);
    }
}