<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Info_itemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'category' => ['required'],
            'icon' => ['required'],
            'title' => ['required'],
            'body' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
