<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lista extends Model
{
    protected $fillable = ['name', 'description', 'type']; //user_id no está, así que nadie puede asignarse una lista ajena desde un formulario

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); // Una lista pertenece a un usuario
    }

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'character_lista')->withTimestamps();
    }

    public function episodes(): BelongsToMany
    {
        return $this->belongsToMany(Episode::class, 'episode_lista')->withTimestamps();
    }
}