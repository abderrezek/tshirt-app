<?php

namespace Database\Factories;

use App\Models\Clothe;
use App\Models\ClotheImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClotheImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClotheImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'clothe_id' => Clothe::all()->random()->id,
            'image' => "default.png",
            'image_blur' => "default.png",
        ];
    }
}
