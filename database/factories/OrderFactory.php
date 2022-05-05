<?php

namespace Database\Factories;

use App\Models\Map;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    private static $order = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user      = User::inRandomOrder()->first();
        $counts    = Order::where('created_at', 'like', date("Ymd") . '%')->count();
        $map       = Map::inRandomOrder()->first();
        $create_at = $this->faker->dateTimeBetween('-100 days', now())->getTimestamp();
        $id        = (intval(date('Y', $create_at)) - 2000) . strtoupper(dechex(date('m', $create_at))) . date('d', $create_at) . sprintf('%03d', self::$order++);
        return [
            'id'         => $id,
            'user_id'    => $user->id,
            'name'       => $this->faker->name(),
            'map_id'     => $map->id,
            'address'    => rand(1, 300) . '巷' . rand(1, 50) . '弄' . rand(1, 300) . '號' . rand(1, 30) . '樓',
            'mobile'     => $this->faker->numerify('09##-###-###'),
            'payment'    => ['method' => 'DEFAULT', 'id' => $this->faker->randomNumber(5, true)],
            'status'     => $this->faker->randomElement(['PENDING', 'CHECKED', 'PAID', 'ARRIVED']),
            'created_at' => $create_at,
        ];
    }
}
