<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'album_id';
    protected $fillable = [
        'album_id',
        'publisher_id',
        'title',
        'artist',
        'release_year',
        'genre',
        'description',
    ];

    public function publisher()
    {
        return $this->belongsTo(Users::class, 'publisher_id', 'user_id');
    }

    public function songs()
    {
        return $this->hasMany(Song::class, 'album_id', 'album_id');
    }

    protected function casts()
    {
        return [
            'release_year' => 'integer',
        ];
    }
}
