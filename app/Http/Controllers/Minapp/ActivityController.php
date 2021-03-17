<?php

namespace App\Http\Controllers\Minapp;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function activity(Request $request)
    {
        try {
            $activityId= intval($request->activity_id);
            if($activityId != 0){
                $data= Activity::where('id',$activityId)->get();
                return $this->success($data);
            }

            if($request->type === "more"){
                $size = 10;
                if($request->size){
                    $size = $request->size;
                }
        
                $page = 0;
                if($request->page){
                    $page = ($request->page -1)*$size;
                }

                $data= Activity::orderBy('created_at','desc')->skip($page)->take($size)->get();
                return $this->success($data);
            }

            $data= Activity::where('is_recommend',1)->get();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
