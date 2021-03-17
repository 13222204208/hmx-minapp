<?php

namespace App\Http\Controllers\Minapp;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function banner()
    {
        try {
            $data= Banner::orderBy('sort')->get(['img_url','sort']);
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
