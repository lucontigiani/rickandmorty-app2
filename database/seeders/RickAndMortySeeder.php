<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RickAndMortySeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('character_episode')->truncate();
        DB::table('characters')->truncate();
        DB::table('episodes')->truncate();
        DB::table('locations')->truncate();

        DB::unprepared(file_get_contents(database_path('seeders/data/datos.sql')));

        Schema::enableForeignKeyConstraints();
    }
}