<?php

namespace Database\Seeders;

use App\Models\Marque;
use Illuminate\Database\Seeder;

class MarqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marque::factory()
            ->count(10)
            ->create();
    }
}
