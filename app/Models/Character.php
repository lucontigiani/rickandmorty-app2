<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Character extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'api_created' => 'datetime',
        'synced_at' => 'datetime',
    ];

    public function origin(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'origin_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function episodes(): BelongsToMany
    {
        return $this->belongsToMany(Episode::class, 'character_episode');
    }

    public function listas(): BelongsToMany //Para poder saber en qué listas está un personaje o episodio
{
    return $this->belongsToMany(Lista::class, 'character_lista');
}
}