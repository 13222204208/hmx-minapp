<?php

namespace App\Http\Controllers\Minapp;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function channel(Request $request)
    {
        try {
            $channelId= intval($request->channel_id);
            if($channelId != 0){
                $size = 10;
                if($request->size){
                    $size = $request->size;
                }
        
                $page = 0;
                if($request->page){
                    $page = ($request->page -1)*$size;
                }

                $channel= Channel::find($channelId);
                $data= $channel->content()->skip($page)->take($size)->get();

                $all['channel']= $channel;
                $all['channel_children']= $data;
                return $this->success($all);
            }

            $data= Channel::where('is_recommend',1)->get();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
