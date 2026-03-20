<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumIndexResource extends AlbumResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
            'artist' => $this->artist,
            'release_year' => $this->release_year,
            'publisher' => [
                'id' => $this->publisher->id,
                'username' => $this->publisher->username,
                'email' => $this->publisher->email
            ],
        ];
    }
}
