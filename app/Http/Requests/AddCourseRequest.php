<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddCourseRequest extends FormRequest
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
            'cover' => 'required',
            'content' => 'required',
            'title' => 'required',
            'price' => 'required|numeric',
            'course_type_id' => 'required|numeric',
          ];
    }

    public function messages()
    {
        return [
            'cover.required' => '图片必填',
            'price.required' => '价格必填',
            'price.numeric' => '价格只能为数字',
            'content.required' => '简介必填',
            'tittle.required' => '课程名称必填',
            'course_type_id.required' => '所属分类必填',
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
