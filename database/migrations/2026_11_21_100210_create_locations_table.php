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
    Schema::create('locations', function (Blueprint $table) {
        $table->unsignedInteger('id')->primary(); // En el TP1 el id es el de la API (por eso no se duplican datos al importar). Tiene que ser INT UNSIGNED sin autoincremento, igual que en el diagrama del tp1.
        $table->string('name', 150);
        $table->string('type', 100)->nullable();
        $table->string('dimension', 150)->nullable();
        $table->string('url', 255)->nullable();
        $table->dateTime('api_created')->nullable();
        $table->timestamp('synced_at')->useCurrent();
    });
}

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::dropIfExists('locations');
}
};

