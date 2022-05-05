<?php

namespace App\Http\Livewire\Order;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Payment extends Component
{
    public $method = 'DEFAULT';

    public $name;

    public $order;

    public $user;

    public $isInsufficient;

    public function mount()
    {
        $this->user           = Auth::user();
        $this->isInsufficient = $this->user->balance < $this->order->total;
        // $this->user->deposit(10000, [
        //     'order'      => $this->order->id,
        //     'created_by' => Auth::id(),
        // ]);
    }

    public function render()
    {
        return view('livewire.order.payment');
    }
}
