<?php

namespace App\Repositories;

use App\Models\OrderItem;

class OrderItemRepository
{
    private $orderItem;

    public function __construct(OrderItem $orderItem)
    {
        $this->orderItem = $orderItem;
    }

    public function create($order, $request)
    {
        return $this->orderItem->create([
            'order_id'   => $order->id,
            'product_id' => $request->id,
            'mode'       => $request->options->mode,
            'price'      => $request->price,
            'qty'        => $request->qty,
            'discount'   => $request->discountRate,
        ]);
    }

    public function find($id)
    {
        $result = $this->orderItem->findOrFail($id);
        return $result;
    }

    public function getByOrder($order_id)
    {
        $orderItems = $this->orderItem->where('order_id', $order_id)->get();
        return $orderItems;
    }
}
