<?php

namespace App\Http\Requests;

use App\bases\ApiResponse;
use App\Models\Album;
use App\Models\Song;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SongUpdateOrderRequest extends ApiRequest
{


    public function rules()
    {
        return [
            'song_ids' => ['required', 'array', 'exists:songs,song_id', function ($att, $value, $error) {
                $album = request('album');
                $songsAlbum = Song::where('album_id', $album->getKey())->count();
                if ($songsAlbum !== count($value)) {
                    $error('The songs_ids must have all the songs related to this album');
                }
            }]
        ];
    }

    public function authorize()
    {
        return true;
    }
}
