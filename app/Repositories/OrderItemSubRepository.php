<?php

namespace App\Repositories;

use App\Models\OrderItemSub;

class OrderItemSubRepository
{
    private $orderItemSub;

    public function __construct(OrderItemSub $orderItemSub)
    {
        $this->orderItemSub = $orderItemSub;
    }

    public function create($orderItem, $request)
    {
        $request['order_item_id'] = $orderItem->id;
        return $this->orderItemSub->create($request);
    }

    public function find($id)
    {
        $orderItemSub = $this->orderItemSub->findOrFail($id);
        return $orderItemSub;
    }

    public function getByOrderItem($order_item_id)
    {
        $orderItemSubs = $this->orderItemSub->where('order_item_id', $order_item_id)->get();
        return $orderItemSubs;
    }

    public function getByReceivedAt($received_at)
    {
        $orderItemSubs = $this->orderItemSub->where(['received_at' => $received_at])->get();
        return $orderItemSubs;
    }
}
