<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug'    => $this->faker->unique()->slug,
            'name'    => $this->faker->realText(10),
            'image'   => 'assets/img/recent-posts-' . rand(1, 4) . '.jpg',
            'enabled' => true,
            'order'   => rand(0, 10),
        ];
    }
}
