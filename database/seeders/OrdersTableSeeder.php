<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemSub;
use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Order::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Order::factory(10)->create()->each(function ($order) {
            $counts   = Product::all()->count();
            $products = Product::inRandomOrder()->limit(rand(1, $counts))->get()->sortBy('id');
            foreach ($products as $product) {
                $qty       = rand(1, 60);
                $mode      = array_rand(array_flip(['SUBSCRIBE', 'PICKUP', 'DELIVERY']));
                $orderItem = OrderItem::factory(1)->create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'mode'       => $mode,
                    'price'      => $product->price,
                    'qty'        => $qty,
                    'discount'   => rand(0, $product->price * $qty),
                ]);
                if ($mode === 'SUBSCRIBE') {
                    $orderItem->each(function ($orderItem) {
                        $faker           = Faker::create();
                        $dates           = array();
                        $subscribe_dates = array();
                        for ($i = 0; $i < $orderItem->qty; $i++) {
                            $days = (intdiv($orderItem->qty * 30, 20));
                            $date = $faker->unique()->dateBetween("-{$days} days", "+{$days} days");
                            array_push($dates, $date);
                        }
                        sort($dates);
                        foreach ($dates as $date) {
                            $status = $date < date('Y-m-d') ? ($faker->boolean($chanceOfGettingTrue = 5) ? 'UNCLAIMED' : 'ARRIVED') : 'PENDING';
                            OrderItemSub::factory(1)->create([
                                'order_item_id' => $orderItem->id,
                                'received_at'   => $date,
                                'status'        => $status,
                            ]);
                        }
                    });
                }
            }
        });
    }
}
