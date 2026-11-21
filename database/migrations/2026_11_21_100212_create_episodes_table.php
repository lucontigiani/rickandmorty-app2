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
    Schema::create('episodes', function (Blueprint $table) {
        $table->unsignedInteger('id')->primary();
        $table->string('name', 150);
        $table->string('code', 10);
        $table->unsignedTinyInteger('season')->nullable();
        $table->unsignedTinyInteger('episode_number')->nullable();
        $table->date('air_date')->nullable();
        $table->string('air_date_raw', 50)->nullable();
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
        Schema::dropIfExists('episodes');
    }
};
