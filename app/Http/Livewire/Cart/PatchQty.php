<?php

namespace App\Http\Livewire\Cart;

use App\Contracts\ICartService;
use Livewire\Component;

class PatchQty extends Component
{
    public $rowId;
    public $qty = 1;
    private $cartService;

    protected $listeners = [
        'cartQtyUpdated' => 'updateQty',
    ];

    protected $rules = [
        'qty' => 'required|integer|between:1,100',
    ];

    protected $messages = [
        'qty.required' => '數量不得留空',
        'qty.integer'  => '請輸入整數',
        'qty.between'  => '數量必須在 1 到 100 之間',
    ];

    public function mount(ICartService $cartService, $rowId)
    {
        $this->cartService = $cartService;
        $this->validate();
        $this->rowId = $rowId;
        $this->qty   = $this->cartService->find($this->rowId)->qty;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->emit('cartQtyUpdated');
    }

    public function updateQty(ICartService $cartService)
    {
        $this->cartService = $cartService;
        $validatedData     = $this->validate();
        $this->cartService->update(['qty' => $validatedData['qty']], $this->rowId);
        $this->emit('productUpdated');
    }

    public function render()
    {
        return view('livewire.cart.patch-qty');
    }
}
