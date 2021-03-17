<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Actions\Admin\AdminLogin;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function adminLogin(Request $request, AdminLogin $action)
    {
        try {
            return $this->success( $action->execute($request->all()) );
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }

    public function info()
    {
        $user= auth('admin')->user();
        return $this->success($user);
    }

    public function adminLogout()
    {
        return $this->success();
    }
}
