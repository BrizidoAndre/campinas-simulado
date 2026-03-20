<?php

namespace App\Http\Resources;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Users */
class UsersResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->getKey(),
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
            'is_banned' => $this->is_banned,
            'created_at' => $this->created_at,
        ];
    }
}
