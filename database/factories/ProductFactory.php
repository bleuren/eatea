<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    private static $order = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->realText(10),
            'slug'    => $this->faker->slug(10),
            'body'    => $this->faker->realText(200),
            'image'   => $this->faker->imageUrl($width = 250, $height = 250),
            'price'   => $this->faker->numberBetween(10, 100),
            'stock'   => $this->faker->numberBetween(10, 100),
            'order'   => $this->faker->numberBetween(1, 10),
            'enabled' => true,
        ];
    }
}
