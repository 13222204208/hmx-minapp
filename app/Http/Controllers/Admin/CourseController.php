<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCourseRequest;
use App\Traits\ImgUrl;

class CourseController extends Controller
{
    use ImgUrl;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $all= $request->all();
            $limit = $all['limit'];
            $page = ($all['page'] -1)*$limit;
            $title = false;
            if(isset($all['title'])){
                $title = $all['title'];
            }
            $item= Course::when($title,function($query) use ($title){
                return $query->where('title','like','%'.$title.'%');
            })->skip($page)->take($limit)->get();
    
            $total= Course::when($title,function($query) use ($title){
                return $query->where('title','like','%'.$title.'%');
            })->count();
    
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
    public function store(AddCourseRequest $request)
    {
        try {
            $data= $request->only('title','cover','content','price','sort','is_recommend');
            $data['content']= $this->delImgUrl($data['content']);
            Course::create($data);
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
            $data= Course::find($id);
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
    public function update(AddCourseRequest $request, $id)
    {
        try {
            $data= $request->only('title','cover','content','price','sort','is_recommend');
            $data['content']= $this->delImgUrl($data['content']);
            Course::where('id',$id)->update($data);
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
            Course::destroy($id);
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
