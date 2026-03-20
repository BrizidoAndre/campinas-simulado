<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'title' => ['required'],
            'artist' => ['required'],
            'release_year' => ['nullable', 'regex:/^\d{4}$/'],
            'genre' => ['required'],
            'description' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
