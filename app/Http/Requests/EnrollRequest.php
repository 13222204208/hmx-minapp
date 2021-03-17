<?php

namespace App\Http\Requests;

use App\Http\Requests\BasicRequest;
use Illuminate\Foundation\Http\FormRequest;

class EnrollRequest extends BasicRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'children_name' => 'required|max:20',
            'phone' => 'required|regex:/^1[345789][0-9]{9}$/',
            'enroll_name' => 'required|max:20',
            'activity_id' => 'required|integer',
          ];
    }

    public function messages()
    {
        return [
            'children_name.required' => '少儿姓名必填',
            'phone.required' => '联系方式必填',
            'phone.regex' => '手机号格式不正确',
            'enroll_name.required' => '报名人姓名必填',
            'activity_id.required' => '活动ID必填',
        ];
    }
}
