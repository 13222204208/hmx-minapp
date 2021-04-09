<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseType;
use Illuminate\Http\Request;

class CourseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $all= $request->all();
            if(empty($all)){
                $data= CourseType::all();
                return $this->success($data); 
            }
            $limit = $all['limit'];
            $page = ($all['page'] -1)*$limit;
        
            $item= CourseType::skip($page)->take($limit)->get();
    
            $total= CourseType::count();
    
            $data['item'] = $item;
            $data['total'] = $total;
            return $this->success($data); 
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data= $request->all();
            CourseType::create($data);
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data= CourseType::find($id);
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());   
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data= $request->only('title','sort');
            $channel = CourseType::find($id);
            $channel->update($data);
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            CourseType::destroy($id);
       
            Course::where("course_type_id",$id)->delete();
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
