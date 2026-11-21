<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    public $incrementing = false; // El id es el de la API, no se autoincrementa
    public $timestamps = false; // No usamos created_at ni updated_at, sino api_created y synced_at

    protected $casts = [
        'api_created' => 'datetime', // api_created es la fecha de creación que viene de la API, no la fecha de creación en nuestra base de datos
        'synced_at' => 'datetime', // synced_at es la fecha de la última sincronización con la API
    ];

    public function residents(): HasMany // Un location tiene muchos residents (personajes que viven en esa ubicación)
    {
        return $this->hasMany(Character::class, 'location_id');
    }

    public function natives(): HasMany // Un location tiene muchos natives (personajes que son originarios de esa ubicación)
    {
        return $this->hasMany(Character::class, 'origin_id');
    }
}