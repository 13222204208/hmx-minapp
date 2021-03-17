<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Actions\Banner\AddBanner;
use App\Actions\Banner\BannerList;
use App\Actions\Banner\EditBanner;
use App\Actions\Banner\DeleteBanner;
use App\Actions\Banner\UpdateBanner;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddBannerRequest;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, BannerList $action)
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
    public function store(AddBannerRequest $request,AddBanner $action)
    {
        try {
            $data= $request->only('sort','img_url');   
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
    public function edit($id, EditBanner $action)
    {
        try {
            return $this->success($action->execute($id));
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
    public function update(AddBannerRequest $request, $id, UpdateBanner $action)
    {
        try {
            $data= $request->all();
            unset($data['id']);
            $action->execute($data, $id);
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
    public function destroy($id,DeleteBanner $action)
    {
        try {
            $action->execute($id);
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
