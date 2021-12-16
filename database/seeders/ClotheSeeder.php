<?php

namespace Database\Seeders;

use App\Models\Clothe;
use App\Models\ClotheImage;
use Illuminate\Database\Seeder;

class ClotheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clothe::factory()
            ->count(30)
            ->create();
    }
}
