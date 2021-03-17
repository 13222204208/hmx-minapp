<?php

namespace App\Http\Requests;

use App\Http\Requests\BasicRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInfoRequest extends BasicRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => 'required',
            'nickname' => 'required',
          ];
    }

    public function messages()
    {
        return [
            'avatar.required' => '头像必填',
            'nickname.required' => '昵称必填',
        ];
    }
}
