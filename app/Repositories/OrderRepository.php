<?php

namespace App\Repositories;

use App\Models\Order;
use Carbon\Carbon;

class OrderRepository
{
    private $order;

    public function __construct(Order $order)
    {
        $order->total = $order->orderItems->sum(function ($item) {
            return $item['qty'] * $item['price'];
        });
        $this->order = $order;
    }

    public function index()
    {
        $orders = $this->order->orderBy('updated_at', 'DESC')->get();
        return $orders;
    }

    public function create($request)
    {
        $order_count   = $this->order->whereDate('created_at', Carbon::today())->count();
        $request['id'] = (intval(date('Y')) - 2000) . strtoupper(dechex(date('m'))) . date('d') . sprintf('%03d', $order_count++);
        $order         = $this->order->create($request);
        return $order;
    }
    public function find($id)
    {
        $result = $this->order->findOrFail($id);

        $result->orderItems = $result->orderItems->map(function ($item) {
            $item->subtotal   = $item->price * $item->qty;
            $item->completion = $item->orderItemSubs->groupBy('status')->map->count();
            return $item;
        });
        return $result;
    }

    public function update($request, $id)
    {
        try {
            $order = $this->order->lockForUpdate()->findOrFail($id);
            $order->update($request);
        } catch (Exception $exception) {
            throw $exception;
        }

        return $order;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        return $result ? $result->delete() : false;
    }
}
