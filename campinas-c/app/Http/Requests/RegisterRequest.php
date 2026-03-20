<?php

namespace App\Http\Requests;

use App\bases\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'username' => ['required', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
