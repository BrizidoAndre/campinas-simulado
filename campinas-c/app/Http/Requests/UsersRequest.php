<?php

namespace App\Http\Requests;

class UsersRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'username' => ['required'],
            'password_hash' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'role' => ['required'],
            'is_banned' => ['boolean'],
            'token' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
