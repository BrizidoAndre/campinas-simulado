<?php

namespace App\Http\Resources;

use App\Models\Song;
use App\Models\SongLabel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Song */
class SongResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->getKey(),
            'album_id' => $this->album_id,
            'title' => $this->title,
            'duration_seconds' => $this->duration_seconds,
            'lyrics' => $this->lyrics,
            'order' => $this->track_order,
            'view_count' => 0,
            'label' => explode(',', request()->input('label')),
            'is_cover' => $this->is_cover,
            'cover_image_url' => "api/songs/{$this->getKey()}/cover",
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,


            'album' => new AlbumResource($this->whenLoaded('album')),
        ];
    }
}
