<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'country',
        'interests',
        'message',
        'submitted_at',
    ];

    protected function casts()
    {
        return [
            'submitted_at' => 'timestamp',
        ];
    }
}
