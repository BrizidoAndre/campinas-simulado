<?php

namespace App\Http\Resources;

use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Label */
class LabelResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'total_view_count' => $this->songs_count,
            'name' => $this->name,
            'songs' => SongLabelStatisticResource::collection($this->whenLoaded('songs')),
        ];
    }
}
