<?php

namespace App\Http\Livewire\Cart;

use App\Contracts\ICartService;
use Livewire\Component;

class MenuItem extends Component
{
    public $cart;
    private $cartService;

    protected $listeners = [
        'productAdded'   => 'updateCart',
        'productUpdated' => 'updateCart',
        'productRemoved' => 'updateCart',
        'clearCart'      => 'updateCart',
    ];

    public function mount(ICartService $cartService): void
    {
        $this->cartService = $cartService;
        $this->cart        = $this->cartService->index();
    }

    public function updateCart(ICartService $cartService): void
    {
        $this->cartService = $cartService;
        $this->cart        = $this->cartService->index();
        $this->render();
    }

    public function render()
    {
        return view('livewire.cart.menu-item');
    }
}
