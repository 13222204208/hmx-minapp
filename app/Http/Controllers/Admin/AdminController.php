<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Actions\Admin\AddAdmin;
use App\Actions\Admin\AdminList;
use App\Actions\Admin\DeleteAdmin;
use App\Actions\Admin\UpdateAdmin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddAdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AdminList $action)
    {
        try {
            return $this->success($action->execute($request->all()));
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
    public function store(AddAdminRequest $request, AddAdmin $action)
    {
        try {
            $data= $request->only('username','password','name','phone');   
            $action->execute($data);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UpdateAdmin $action)
    {
        try {
           $state= $action->execute($request->all());
           if($state){
                return $this->success();
            }else{
                return $this->failed('原始密码错误');
            }    
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
    public function destroy($id, DeleteAdmin $action)
    {
        try {
            $admin= auth('admin')->user();
            if($admin->id !==1){
                return $this->failed('必须是超级管理员才能删除');
            }
            $action->execute($id);
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
