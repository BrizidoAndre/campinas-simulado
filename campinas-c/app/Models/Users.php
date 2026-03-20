<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'username',
        'password_hash',
        'email',
        'role',
        'is_banned',
        'token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function casts()
    {
        return [
            'is_banned' => 'boolean',
        ];
    }
}
