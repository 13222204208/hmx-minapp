<?php

namespace App\Actions\Banner;

use App\Models\Banner;

class BannerList
{
    public function execute($all)
    {
        $limit = $all['limit'];
        $page = ($all['page'] -1)*$limit;
  
        $item= Banner::skip($page)->take($limit)->get();

        $total= Banner::count();

        $data['item'] = $item;
        $data['total'] = $total;
        return $data;
    }
}