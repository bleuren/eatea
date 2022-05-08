<?php

namespace App\Jobs;

use App\Contracts\IOrderService;
use App\Models\Map;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Phattarachai\LineNotify\Facade\Line;

class notifyTasks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(IOrderService $orderService)
    {
        $orderItemSubs = $orderService->getTasks('today');
        $message       = '';
        foreach ($orderItemSubs as $orderItemSub) {
            $map = Map::find($orderItemSub->orderItem->order->map_id);
            $message .= "\n";
            $message .= "訂單{$orderItemSub->orderItem->order->id}: 送 {$orderItemSub->orderItem->product->name} * {$orderItemSub->qty} 到 {$map->city}{$map->district}{$map->road}{$orderItemSub->orderItem->order->address} 給 {$orderItemSub->orderItem->order->name}";
        }

        return Line::send($message);
    }
}
