<?php

namespace App\Http\Controllers\Minapp;

use App\Models\Order;
use App\Traits\OrderNum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateOrderRequest;

class OrderController extends Controller
{
    use OrderNum;

    public function createOrder($data)
    {
        try {
            $data['order_num']= $this->createOrderNum(rand(1,99), 'hmx');
            $user= auth('api')->user();
            $data['user_id']= $user->id;
            $state= Order::create($data);
            if($state){
                return $this->success();
            }
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }

    public function payOrder(CreateOrderRequest $request)
    {
        try {
            $data= $request->only('order_title','order_cover','order_content','activity_time','pay_price');
            return $this->createOrder($data);
           
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }

    public function order_list(Request $request)
    {
        try {
            if($request->order_num){
                $data= Order::where("order_num",$request->order_num)->first();
                return $this->success($data);
            }

            $size = 10;
            if($request->size){
                $size = $request->size;
            }
    
            $page = 0;
            if($request->page){
                $page = ($request->page -1)*$size;
            }   

            if($request->has("pay_state")){
                $payState = $request->pay_state;
       
                if($payState == 0 || $payState == 1){
                    $data= Order::orderBy('created_at','desc')->where("pay_state",$payState)->skip($page)->take($size)->get();
                    return $this->success($data);
                }
            }
   
            $data= Order::orderBy('created_at','desc')->skip($page)->take($size)->get();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }

    public function delOrder(Request $request)
    {
        try {
            $orderNum = $request->order_num;
            $user = auth('api')->user();
            $state= Order::where("order_num",$orderNum)->where("user_id",$user->id)->delete();
            if($state){
                return $this->success();
            }else{
                return $this->failed("删除失败");
            }
           
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
