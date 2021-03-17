<?php

namespace App\Actions\Admin;

use App\Models\Admin;

class AdminList
{
    public function execute($all)
    {
        $limit = $all['limit'];
        $page = ($all['page'] -1)*$limit;
        $username = false;
        if(isset($all['username'])){
            $username = $all['username'];
        }
        $item= Admin::when($username,function($query) use ($username){
            return $query->where('username','like','%'.$username.'%');
        })->where('id','!=',1)->skip($page)->take($limit)->get();

        $total= Admin::when($username,function($query) use ($username){
            return $query->where('username','like','%'.$username.'%');
        })->where('id','!=',1)->count();

        $data['item'] = $item;
        $data['total'] = $total;
        return $data;
    }
}