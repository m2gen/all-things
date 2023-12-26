<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $validate = [];

        $validate += [
            'name' => [
                'required',
                'max:20'
            ]
        ];

        return $validate;
    }

    public function messages()
    {
        return [
            'name.required' => "名前は必須項目です",
            'name.max' => "20文字以内でお願いします",
        ];
    }
}
