<?php

namespace App\Actions\Admin;

use App\Models\Admin;

class DeleteAdmin
{
    public function execute($id)
    {
        Admin::destroy($id);
    }
}