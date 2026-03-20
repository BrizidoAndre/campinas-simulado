<?php

namespace App\Http\Requests;

use App\bases\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SongRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'title' => ['required'],
            'duration_seconds' => ['required', 'integer'],
            'cover_image' => ['required', 'image'],
            'label' => ['required'],
            'lyrics' => ['nullable'],
            'is_cover' => ['required', Rule::in(['true', 'false'])],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
