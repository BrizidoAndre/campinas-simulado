<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Label extends Model
{
    protected $primaryKey = 'label_id';
    public $timestamps = false;

    protected $fillable = [
        'label_id',
        'name',
    ];

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'song_labels', 'label_id', 'song_id');
    }
}
