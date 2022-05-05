<?php

namespace App\Http\Controllers;

use App\Contracts\ICartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartService;

    public function __construct(ICartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requests
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input   = $request->only('qty', 'received_at', 'id', 'mode');
        $product = $this->cartService->create($input);
        return redirect()->route('cart.index');
    }
}
