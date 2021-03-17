<?php

namespace App\Http\Controllers\Minapp;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Affiche;

class AfficheController extends Controller
{
    public function affiche()
    {
        try {
            $today= Carbon::now()->toDateTimeString();
            $data= Affiche::where('start_time','<=',$today)->where('stop_time','>=',$today)->get(['content']);
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
