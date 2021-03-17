<?php

namespace App\Http\Controllers\Minapp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnrollRequest;
use App\Models\Enroll;

class EnrollController extends Controller
{
    public function enroll(EnrollRequest $request)
    {
        try {
            $data= $request->only('children_name','phone','enroll_name','activity_id');
            Enroll::create($data);
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
