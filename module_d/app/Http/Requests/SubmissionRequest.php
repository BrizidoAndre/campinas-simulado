<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'country' => ['required'],
            'interests' => ['required'],
            'message' => ['required'],
            'submitted_at' => ['nullable', 'date'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
