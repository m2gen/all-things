<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $validate = [];

        $validate += [
            'things' => [
                'required',
                'max:20',
                'unique:posts,things',
                'regex:/^\S*$/'
            ]
        ];

        $validate += [
            'tags' => [
                'required',
                'max:20',
                'regex:/^\S*$/'
            ]
        ];

        $validate += [
            'overview' => [
                'nullable',
                'max:3000'
            ]
        ];

        return $validate;
    }

    public function messages()
    {
        return [
            'things.required' => "万物は必須項目です",
            'things.max' => "20文字以内でお願いします",
            'things.unique' => "既に登録済みの万物です",
            'tags.required' => "タグは必須項目です",
            'tags.regex' => "タグの空白を削除してください",
            'tags.max' => "20文字以内でお願いします",
            'overview' => "3000字以内でお願いします",
        ];
    }
}
