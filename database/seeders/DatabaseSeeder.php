<?php

namespace Database\Seeders;

use Database\Seeders\ClotheImageSeeder;
use Database\Seeders\ClotheSeeder;
use Database\Seeders\CommuneSeeder;
use Database\Seeders\MarqueSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WilayaSeeder;
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
        // \App\Models\User::factory(10)->create();
        $this->call([
            MarqueSeeder::class,
            ClotheSeeder::class,
            // ClotheImageSeeder::class,
            UserSeeder::class,
            WilayaSeeder::class,
            CommuneSeeder::class,
        ]);
    }
}
