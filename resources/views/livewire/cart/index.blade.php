<div>
    <section class="mt-16 md:mt-20">
        <div class="container">
            <div class="section-inner">
                @if (count($cart) > 0)
                    <table class="text-left overflow-y-scroll">
                        <thead>
                            <tr>
                                <th>
                                    名稱</th>
                                <th class="text-center">
                                    數量</th>
                                <th class="text-center">
                                    單價</th>
                                <th class="text-right">
                                    類型</th>
                                <th class="text-right">
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($cart as $cartItem)
                                <tr>
                                    <td>
                                        {{ $cartItem->name }}
                                        @if (isset($cartItem->options['date_qty']))
                                            <div class="m-3 p-2 rounded-md bg-gray-100">
                                                @foreach ($cartItem->options['date_qty'] as $date => $qty)
                                                    <li class="list-none text-sm">{{ $date }} :
                                                        {{ $qty }}</li>
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($cartItem->options['mode'] === 'SUBSCRIBE')
                                            {{ $cartItem->qty }}
                                        @else
                                            @livewire('cart.patch-qty', ['rowId' => $cartItem->rowId],
                                            key($cartItem->rowId))
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $cartItem->price }}
                                    </td>
                                    <td class="text-right">
                                        {{ __($cartItem->options['mode']) }}
                                    </td>
                                    <td class="text-right">
                                        <button wire:click="removeFromCart('{{ $cartItem->rowId }}')"
                                            class="text-red-500"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @livewire('order.create', ['total' => $cart->total, 'cart' => $cart])
                @else
                    <div class="text-center w-full p-6">
                        <p class="text-lg">購物車裡沒有任何東西</p>
                        <a href="{{ route('product.index') }}"><span class="text-sm">來去逛逛</span></a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
