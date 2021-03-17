<?php

namespace App\Http\Requests;

use App\Http\Requests\BasicRequest;
use Illuminate\Foundation\Http\FormRequest;

class AgreementRequest extends BasicRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'title' => 'required',
            'content' => 'required'
          ];
    }

    public function messages()
    {
        return [
            'type.required' => '协议类型必填',
            'title.required' => '标题必填',
            'content.regex' => '协议内容必填',
        ];
    }
}
