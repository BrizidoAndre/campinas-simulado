<?php

namespace App\Http\Requests;

use App\bases\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SongUpdateRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'title' => ['required'],
            'duration_seconds' => ['required', 'integer'],
            'label' => ['required'],
            'lyrics' => ['required'],
            'cover_image' => ['required', 'image'],
            'is_cover' => ['required', Rule::in(['true', 'false'])]
        ];
    }

    public function authorize()
    {
        return true;
    }
}
