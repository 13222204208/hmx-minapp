<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Traits\ImgUrl;
use Illuminate\Http\Request;

class ActivityController extends Controller
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
            $item= Activity::when($title,function($query) use ($title){
                return $query->where('title','like','%'.$title.'%');
            })->skip($page)->take($limit)->get();
    
            $total= Activity::when($title,function($query) use ($title){
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
    public function store(Request $request)
    {
        try {
            $data= $request->all();
            $data['start_time']= $data['time'][0];
            $data['stop_time']= $data['time'][1];
            $data['content'] = $this->delImgUrl($data['content']);
            unset($data['time']);
            Activity::create(array_filter($data));
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
            $data= Activity::find($id);
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
            $data= $request->all();
            $data['start_time']= $data['time'][0];
            $data['stop_time']= $data['time'][1];
            $data['content'] = $this->delImgUrl($data['content']);
            unset($data['id']);
            unset($data['time']);
            $activity = Activity::find($id);
            $activity->update($data);
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
            Activity::destroy($id);
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
