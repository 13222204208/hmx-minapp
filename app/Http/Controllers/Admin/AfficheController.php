<?php

namespace App\Http\Controllers\Admin;

use App\Models\Affiche;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddAfficheRequest;

class AfficheController extends Controller
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
            $limit = $all['limit'];
            $page = ($all['page'] -1)*$limit;
          
            $item= Affiche::skip($page)->take($limit)->get();
    
            $total= Affiche::count();
    
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
    public function store(AddAfficheRequest $request)
    {
        try {
            $data= $request->only('content','time');
            $data['start_time']= $data['time'][0];
            $data['stop_time']= $data['time'][1];
            unset($data['time']);
            Affiche::create($data);
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
            $data= Affiche::find($id);
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
    public function update(AddAfficheRequest $request, $id)
    {
        try {
            $data= $request->only('content','time');
            $data['start_time']= $data['time'][0];
            $data['stop_time']= $data['time'][1];
            unset($data['time']);
            Affiche::where('id',$id)->update($data);
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
            Affiche::destroy($id);
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
