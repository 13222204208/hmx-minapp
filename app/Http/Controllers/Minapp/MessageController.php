<?php

namespace App\Http\Controllers\Minapp;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function myMessage(Request $request)
    {
        try {
            $size = 10;
            if($request->size){
                $size = $request->size;
            }
    
            $page = 0;
            if($request->page){
                $page = ($request->page -1)*$size;
            }   

            $user = auth('api')->user();
            $data= Message::orderBy('created_at','desc')->where("user_id",0)->orWhere("user_id",$user->id)->skip($page)->take($size)->get();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
