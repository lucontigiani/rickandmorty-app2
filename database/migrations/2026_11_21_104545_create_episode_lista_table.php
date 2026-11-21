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
    Schema::create('episode_lista', function (Blueprint $table) {
        $table->foreignId('lista_id')->constrained('listas')->cascadeOnDelete(); // Relación con la tabla de listas - si se borra una lista, se borran sus episodios asociados
        $table->unsignedInteger('episode_id');
        $table->timestamps(); // Timestamps para saber cuándo se creó o actualizó la relación. Es útil para ordenar las listas por fecha de incorporación.

        $table->primary(['lista_id', 'episode_id']); // Clave primaria compuesta hace que la base rechace un personaje repetido dentro de la misma lista, pero permite que el mismo personaje esté en listas distintas.
        $table->foreign('episode_id')->references('id')->on('episodes')->cascadeOnDelete(); // Relación con la tabla de episodios - si se borra un episodio, se borran sus asociaciones con las listas
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episode_lista');
    }
};
