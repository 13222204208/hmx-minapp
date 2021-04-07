<?php

namespace App\Http\Controllers\Minapp;

use Carbon\Carbon;
use App\Models\Enroll;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function myActivity(Request $request)
    {
        try {
            $user = auth('api')->user();
            $allID = Enroll::where("user_id",$user->id)->pluck("activity_id");

            if($request->has("activity_time")){
                $activityTime = intval($request->activity_time);
                $time=Carbon::now()->toDateTimeString();
                $size = 10;
                if($request->size){
                    $size = $request->size;
                }
        
                $page = 0;
                if($request->page){
                    $page = ($request->page -1)*$size;
                }
             
                if($activityTime == 1){
             
                    $data = Activity::whereIn('id', $allID)->skip($page)->take($size)->where("start_time",">",$time)->get();
                }else if($activityTime == 2){
                  
                    $data = Activity::whereIn('id', $allID)->skip($page)->take($size)->where("start_time","<",$time)->where("stop_time",">",$time)->get();
                }else if($activityTime == 3){
                
                    $data = Activity::whereIn('id', $allID)->skip($page)->take($size)->where("stop_time","<",$time)->get();
                }
                return $this->success($data);
            }
           return $this->failed("缺少参数");
           
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
