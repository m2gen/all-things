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
                'unique:posts,things'
            ]
        ];

        $validate += [
            'tags' => [
                'required',
                'max:200'
            ]
        ];

        $validate += [
            'overview' => [
                'nullable',
                'max:4000'
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
            'tags.max' => "合計200文字以内でお願いします",
            'overview.max' => "4000字以内でお願いします",
        ];
    }
}
