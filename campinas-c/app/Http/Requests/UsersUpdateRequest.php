<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'role' => ['required', Rule::in(['admin', 'publisher', 'user'])]
        ];
    }

    public function authorize()
    {
        return true;
    }
}
