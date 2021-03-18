<?php

namespace App\Http\Controllers\Minapp;

use App\Models\Order;
use App\Traits\OrderNum;
use App\Http\Controllers\Controller;
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
}
