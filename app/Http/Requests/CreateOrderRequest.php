<?php

namespace App\Http\Requests;

use App\Http\Requests\BasicRequest;

class CreateOrderRequest extends BasicRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_title' => 'required|max:255',
            'order_cover' => 'required|max:255',
            'order_content' => 'required',
            'pay_price' => 'required|numeric',
          ];
    }

    public function messages()
    {
        return [
            'order_title.required' => '订单名称必填',
            'order_cover.required' => '封面必填',
            'order_content.required' => '简介必填',
            'pay_price.required' => '价格必填',
            'pay_price.numeric' => '价格必须为数字',
        ];
    }
}
