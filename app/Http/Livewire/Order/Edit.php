<?php

namespace App\Http\Livewire\Order;

use App\Contracts\IOrderService;
use Livewire\Component;

class Edit extends Component
{
    public $order_id;

    public $order;

    private $orderService;

    protected $listeners = ['refreshOrderItems'];

    public function mount(IOrderService $orderService, $order_id)
    {
        $this->order = $orderService->find($order_id);
    }

    public function refreshOrderItems(IOrderService $orderService)
    {
        $this->order = $orderService->find($this->order_id);
    }

    public function render()
    {
        return view('livewire.order.edit');
    }
}
