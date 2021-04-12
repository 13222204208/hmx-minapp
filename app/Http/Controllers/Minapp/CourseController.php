<?php

namespace App\Http\Controllers\Minapp;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\Banner;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function course(Request $request)
    {
        try {
            $courseId= intval($request->course_id);
            if($courseId != 0){
                $data= Course::find($courseId);
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
                $data= Course::orderBy('created_at','desc')->skip($page)->take($size)->get();
                return $this->success($data);
            }

            $data= Course::orderBy('created_at','desc')->where('is_recommend',1)->get();
            return $this->success($data);

            
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }

    public function courseShop(Request $request)
    {
        try {
            $courseId= intval($request->course_id);
            if($courseId != 0){
                $data= Course::find($courseId);
                return $this->success($data);
            }

            $size = 10;
            if($request->size){
                $size = $request->size;
            }
    
            $page = 0;
            if($request->page){
                $page = ($request->page -1)*$size;
            }
            $courseTypeID = intval($request->course_type_id);
            if($courseTypeID){

                $data= Course::orderBy('created_at','desc')->skip($page)->take($size)->where("course_type_id",$courseTypeID)->get();
                return $this->success($data);
            }
            $courseType=  CourseType::first();
            $data= Course::orderBy('created_at','desc')->skip($page)->take($size)->where("course_type_id",$courseType->id)->get();
            return $this->success($data);

            
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }

    public function courseType()
    {
        try {
           $data= CourseType::orderBy("sort")->get(["id","title"]);
           return $this->success($data); 
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }

    public function courseCover()
    {
        try {
           $data= Banner::select("img_url")->first();
           return $this->success($data); 
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
