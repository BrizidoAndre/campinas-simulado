<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttractionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'region_id' => ['required', 'exists:regions'],
            'description' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
