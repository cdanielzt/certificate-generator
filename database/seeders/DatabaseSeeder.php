<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Cliente::factory(20)->create();
        \App\Models\Curso::factory(4)->create();
        $this->call(UserSeed::class);
    }
}
