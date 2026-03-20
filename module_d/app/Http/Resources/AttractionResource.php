<?php

namespace App\Http\Resources;

use App\Models\Attraction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Attraction */
class AttractionResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'region_id' => $this->region_id,

            'region' => new RegionResource($this->whenLoaded('region')),
        ];
    }
}
