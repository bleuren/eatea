<?php

namespace App\Http\Livewire\Cart;

use App\Contracts\ICartService;
use Livewire\Component;

class Index extends Component
{
    public $cart;

    private $cartService;

    public $total;

    public $fee = 0;

    public $message = '';

    protected $listeners = [
        'productUpdated' => 'updateCart',
    ];

    public function mount(ICartService $cartService): void
    {
        $this->cartService = $cartService;
        $this->cart        = $this->cartService->index();
    }

    public function removeFromCart(ICartService $cartService, $rowId): void
    {
        $this->cartService = $cartService;
        $this->cartService->delete($rowId);
        $this->cart = $this->cartService->index();
        $this->emit('productUpdated');
    }

    public function updateFromCart(ICartService $cartService, $rowId, $qty): void
    {
        $this->cartService = $cartService;
        $this->cartService->update(['qty' => $qty], $rowId);
        $this->emit('productUpdated');
    }

    public function updateCart(ICartService $cartService): void
    {
        $this->cartService = $cartService;
        $this->cart        = $this->cartService->index();
        $this->emit('updateFee');
        $this->render();
    }

    public function render()
    {
        return view('livewire.cart.index')->extends('layouts.site');
    }
}
