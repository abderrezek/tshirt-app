<?php

namespace Database\Factories;

use App\Models\Clothe;
use App\Models\Marque;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClotheFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Clothe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $size = random_int(1, 4);

        $sizeClothes = ['xs', 's', 'm', 'l', 'xl', 'xxl'];
        $arrSize = [];
        for ($j=0; $j < $size; $j++) {
            array_push($arrSize, $sizeClothes[array_rand($sizeClothes)]);
        }

        $arrColor = [];
        for ($i=0; $i < $size; $i++) {
            array_push($arrColor, $this->faker->hexColor());
        }

        $is_sale = (bool)random_int(0, 1);

        $name = $this->faker->name();

        return [
            'marque_id' => Marque::all()->random()->id,
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'size' => $arrSize,
            'qte' => $this->faker->randomNumber(3),
            'nb_added' => $this->faker->randomNumber(3),
            'colors' => $arrColor,
            'price' => $this->faker->randomFloat(2, 30, 3000),
            'is_sale' => $is_sale,
            'sale' => $is_sale ? $this->faker->randomFloat(2, 30, 3000) : 0,
            'description' => $this->faker->text(),
        ];
    }
}
