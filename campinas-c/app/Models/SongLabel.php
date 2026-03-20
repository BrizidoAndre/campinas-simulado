<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SongLabel extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'song_label_id',
        'song_id',
        'label_id',
    ];

    public function song()
    {
        return $this->belongsTo(Song::class);
    }

    public function label()
    {
        return $this->belongsTo(Label::class);
    }
}
