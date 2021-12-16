<?php

namespace Database\Seeders;

use App\Models\Clothe;
use App\Models\ClotheImage;
use Illuminate\Database\Seeder;

class ClotheImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClotheImage::factory()
            ->count(30)
            ->create();
    }
}
