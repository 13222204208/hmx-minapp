<?php

namespace App\Http\Controllers\Minapp;

use App\Models\User;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateInfoRequest;

class UserInfoController extends Controller
{
    use UploadImage;

    public function uploadImg(Request $request)
    {
        try {
            $imgUrl= $this->getNewFile($request->file);
            return $this->success($imgUrl); 
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }

    public function updateInfo(UpdateInfoRequest $request)
    {
        try {
           $data= $request->only('avatar','nickname');
           $user= auth('api')->user();
           User::where('id',$user->id)->update($data);
           return $this->success(); 
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
