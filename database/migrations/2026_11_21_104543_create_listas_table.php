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
    Schema::create('listas', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100);
        $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Relación con la tabla de usuarios - si se borra un usuario, se borran sus listas
        $table->string('description', 255)->nullable();
        $table->enum('type', ['character', 'episode']);
        $table->timestamps();

        $table->unique(['user_id', 'name']); // Un usuario no puede tener dos listas con el mismo nombre
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listas');
    }
};
