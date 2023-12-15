<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'things' => 'required|max:20',
            'tags' => 'required',
            'overview' => 'nullable|max:3000',
        ];
    }

    public function messages()
    {
        return [
            'things.required' => "万物は必須項目です",
            'things.max' => "20文字以内でお願いします",
            'things.unique' => "既に登録済みの万物です",
            'tags.required' => "タグは必須項目です",
            'tags.regex' => "タグの空白を削除してください",
            'overview' => "3000字以内でお願いします",
        ];
    }
}
