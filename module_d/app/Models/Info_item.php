<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Info_item extends Model
{
    protected $fillable = [
        'category',
        'icon',
        'title',
        'body',
    ];
}
