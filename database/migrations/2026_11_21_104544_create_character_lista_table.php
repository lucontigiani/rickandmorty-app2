<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('character_lista', function (Blueprint $table) {
        $table->foreignId('lista_id')->constrained('listas')->cascadeOnDelete(); // Relación con la tabla de listas - si se borra una lista, se borran sus personajes asociados
        $table->unsignedInteger('character_id');
        $table->timestamps();
        $table->primary(['lista_id', 'character_id']); // Clave primaria compuesta por lista_id y character_id
        $table->foreign('character_id')->references('id')->on('characters')->cascadeOnDelete(); // Relación con la tabla de personajes - si se borra un personaje, se borran sus asociaciones con las listas
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_lista');
    }
};
