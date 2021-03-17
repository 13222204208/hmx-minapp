<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Traits\ImgUrl;
use Illuminate\Http\Request;

class ContentController extends Controller
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
            $item= Content::when($title,function($query) use ($title){
                return $query->where('title','like','%'.$title.'%');
            })->with('channel:id,title')->skip($page)->take($limit)->get();
    
            $total= Content::when($title,function($query) use ($title){
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
            $data= $request->only('title','content','channel_id');
            $data['content']= $this->delImgUrl($data['content']);
            Content::create($data);
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
            $data= Content::find($id);
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
            $data= $request->only('title','content','channel_id');
            $data['content']= $this->delImgUrl($data['content']);
            $content = Content::find($id);
            $content->update($data);
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
            Content::destroy($id);
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
