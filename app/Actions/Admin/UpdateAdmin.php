<?php

namespace App\Actions\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UpdateAdmin
{
    public function execute($data)
    {
        $admin= auth('admin')->user();
        $state= Hash::check( $data['oldPassword'],$admin->password);
        if($state){
           $info= Admin::find($admin->id);
           $info->password = Hash::make($data['password']);
           return $info->save();
        }else{
            return false;
        }
    }
}