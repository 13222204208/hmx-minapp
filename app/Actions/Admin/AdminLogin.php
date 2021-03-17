<?php

namespace App\Actions\Admin;

use App\Models\Admin;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;

class AdminLogin
{
    use ApiResponse;
    public function execute($data)
    {
        $user= Admin::where('username',$data['username'])->first();

        if(!$user){
            return  $this->failed('用户不存在');
        }
  
        if (!Hash::check($data['password'],$user->password)) {
            return  $this->failed('密码不正确');
        }
          
        if (!$token = auth('admin')->attempt($data)) {
            return  $this->failed();
        }

        $xToken['token'] = $token;
        return $xToken;
    }
}