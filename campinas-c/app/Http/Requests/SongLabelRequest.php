<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongLabelRequest extends FormRequest
{
    public function rules()
    {
        return [
            'song_label_id' => ['required', 'integer'],
            'song_id' => ['required', 'exists:songs'],
            'label_id' => ['required', 'exists:labels'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
