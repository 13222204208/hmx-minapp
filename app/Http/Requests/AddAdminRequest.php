<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|min:6|max:25|unique:admins',
            'password' => 'required|min:6|max:30',
            'name' => 'required|min:2|max:25',
            'phone' => 'required|regex:/^1[345789][0-9]{9}$/',
          ];
    }

    public function messages()
    {
        return [
            'username.required' => '用户名必填',
            'password.required' => '密码必填',
            'phone.regex' => '手机格式无效',
            'username.unique' => '用户名已重复',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(response()->json([
            'code' => 0,
            'msg' => $validator->errors()->first(),
        ], 200)));
    }

}
