<?php

namespace Database\Factories;

use App\Models\Carousel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarouselFactory extends Factory
{
    private static $order = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Carousel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'body'  => $this->faker->paragraph(),
            'url'   => $this->faker->randomElement(['/blog', null]),
            'order' => self::$order++,
        ];
    }
}
