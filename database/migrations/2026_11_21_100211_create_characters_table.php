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
    Schema::create('characters', function (Blueprint $table) {
        $table->unsignedInteger('id')->primary();
        $table->string('name', 150);
        $table->enum('status', ['Alive', 'Dead', 'unknown']);
        $table->string('species', 100);
        $table->string('type', 150)->nullable();
        $table->enum('gender', ['Female','Male','Genderless','unknown']);
        $table->unsignedInteger('origin_id')->nullable();
        $table->unsignedInteger('location_id')->nullable();
        $table->string('image', 255)->nullable();
        $table->string('url', 255)->nullable();
        $table->dateTime('api_created')->nullable();
        $table->timestamp('synced_at')->useCurrent();

        $table->foreign('origin_id')->references('id')->on('locations')->nullOnDelete();
        $table->foreign('location_id')->references('id')->on('locations')->nullOnDelete();
        /** origin_id y location_id son claves foráneas hacia locations. Son nullable porque la API a veces dice "unknown"
         * nullOnDelete(): si se borra una ubicación, los personajes que apuntaban a ella quedan con NULL en vez de borrarse
         * Tienen que ser unsignedInteger (no foreignId), porque locations.id es INT UNSIGNED. Si los tipos no coinciden, MySQL rechaza la clave foránea
        */

        $table->index('name');
        $table->index('status');
        $table->index('species');
        $table->index('gender');

        /** Los índices son para acelerar las búsquedas por esos campos, que son los que se usan en filtros y búsquedas en la API */
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
