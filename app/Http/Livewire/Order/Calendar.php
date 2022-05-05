<?php

namespace App\Http\Livewire\Order;

use App\Models\OrderItem;
use App\Models\OrderItemSub;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Calendar extends LivewireCalendar
{
    use AuthorizesRequests;

    public $selectedOrderItemSub = null;

    public $orderItems;

    public $orderItemSubs;

    public function events(): Collection
    {
        $this->orderItemSubs = $this->orderItems
            ->where('mode', 'SUBSCRIBE')
            ->map(function ($orderItem) {
                return $orderItem->orderItemSubs()
                    ->whereBetween('received_at', [$this->gridStartsAt, $this->gridEndsAt])
                    ->get()
                    ->map(function (OrderItemSub $orderItemSub) use ($orderItem) {
                        $orderItemSub->product = $orderItem->product;
                        $orderItemSub->date    = $orderItemSub->received_at;
                        return $orderItemSub;
                    });
            })->flatten();

        return $this->orderItemSubs;
    }

    public function onEventDropped($eventId, $year, $month, $day)
    {
        if (Auth::user()->hasRole('admin')) {
            $date         = Carbon::create($year, $month, $day);
            $orderItemSub = OrderItemSub::find($eventId);
            $this->authorize('update', $orderItemSub);
            $result = $this->orderItemSubs->filter(function ($value, $key) use ($date, $orderItemSub) {
                return $value['order_item_id'] == $orderItemSub->order_item_id && Carbon::create($value['date'])->eq($date);
            });
            if ($result->isEmpty()) {
                $orderItemSub->received_at = Carbon::today()->setDate($year, $month, $day);
                $orderItemSub->save();
            }
        }
    }

    public function onEventClick($eventId)
    {
        if (Auth::user()->hasRole('admin')) {
            $this->selectedOrderItemSub = OrderItemSub::find($eventId);
            $this->authorize('update', $this->selectedOrderItemSub);
            $options                            = ['PENDING', 'ARRIVED', 'UNCLAIMED'];
            $key                                = array_search($this->selectedOrderItemSub->status, $options);
            $this->selectedOrderItemSub->status = $options[($key + 1) % count($options)];
            $this->selectedOrderItemSub->save();
            $this->emit('refreshOrderItems');
        }
    }

    public function deleteEvent($eventId)
    {
        if (Auth::user()->hasRole('admin')) {
            $orderItemSub = OrderItemSub::find($eventId);
            $this->authorize('delete', $orderItemSub);
            $orderItem = OrderItem::find($orderItemSub->order_item_id);
            $orderItem->qty -= $orderItemSub->qty;
            $orderItem->save();
            $orderItemSub->delete();
            $this->emit('refreshOrderItems');
        }
    }

    public function render()
    {
        return parent::render();
    }
}
