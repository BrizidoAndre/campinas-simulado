<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'key' => ['required'],
            'name' => ['required'],
            'color' => ['required'],
            'summary' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
