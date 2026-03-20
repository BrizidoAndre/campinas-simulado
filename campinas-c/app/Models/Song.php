<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'song_id';

    protected $fillable = [
        'song_id',
        'album_id',
        'title',
        'duration_seconds',
        'cover_image_path',
        'is_cover',
        'lyrics',
        'track_order',
    ];

    protected function casts()
    {
        return [
            'is_cover' => 'boolean'
        ];
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'album_id');
    }

    public function songLabels()
    {
        return $this->hasMany(SongLabel::class, 'song_id', 'song_id');
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'song_labels', 'song_id', 'label_id');
    }

    public function userViewLogs()
    {
        return $this->hasMany(UserViewLog::class, 'song_id', 'song_id');
    }

    public function getLabels()
    {
        return $this->songLabels->flatMap(function ($label) {
            return $label->label;
        });
    }
}
