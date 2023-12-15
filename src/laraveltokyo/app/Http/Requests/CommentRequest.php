<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_name' => 'nullable|max:20',
            'content' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
            'user_name.max' => "20文字以内でお願いします",
            'content.required' => "コメントは必須項目です",
            'content.max' => "500文字以内でお願いします",
        ];
    }
}
