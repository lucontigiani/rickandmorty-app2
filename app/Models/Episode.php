<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Episode extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'air_date' => 'date',
        'api_created' => 'datetime',
        'synced_at' => 'datetime',
    ];

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'character_episode');
    }

    public function listas(): BelongsToMany //Para poder saber en qué listas está un personaje o episodio
{
    return $this->belongsToMany(Lista::class, 'episode_lista');
}
}