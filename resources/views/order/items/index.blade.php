@php
$hasOrderItemSub = $order->orderItems->contains(function ($value, $key) {
    return $value->mode === 'SUBSCRIBE';
});
@endphp
<table>
    <thead>
        <tr>
            <th class="text-left">
                <span>
                    {{ __('商品名稱') }}
                </span>
            </th>

            <th>
                <span>
                    {{ __('數量') }}
                </span>
            </th>

            <th>
                <span>
                    {{ __('單價') }}
                </span>
            </th>

            <th>
                <span>
                    {{ __('折扣') }}
                </span>
            </th>
            @if ($hasOrderItemSub)
                <th>
                    <span>
                        {{ __('完成度') }}
                    </span>
                </th>
            @else
                <th>
                    <span>
                        {{ __('類型') }}
                    </span>
                </th>
            @endif
            <th class="text-right">
                <span>
                    {{ __('小計') }}
                </span>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->orderItems as $orderItem)
            <tr class="bg-white" wire:loading.class.delay="opacity-50" wire:key="table-row-1" id="">
                <td class="text-left">
                    {{ $orderItem->product->name }}
                </td>
                <td class="text-center">
                    {{ $orderItem->qty }}
                </td>
                <td class="text-center">
                    {{ number_format($orderItem->price) }}
                </td>
                <td class="text-center">
                    {{ $orderItem->discount }}
                </td>
                <td class="text-center">
                    @if ($orderItem->mode === 'SUBSCRIBE')
                        {{ $orderItem->completion['ARRIVED'] ?? 0 }} / {{ $orderItem->completion->sum() }}
                    @else
                        {{ __($orderItem->mode) }}
                    @endif
                </td>
                <td class="text-right">
                    {{ number_format($orderItem->subtotal) }}
                </td>
            </tr>
        @endforeach
        <tr class="bg-white" wire:loading.class.delay="opacity-50" wire:key="table-row-1" id="">
            <td class="text-left">
                {{ __('運費') }}
            </td>
            <td class="text-center">
            </td>
            <td class="text-center">
            </td>
            <td class="text-center">
            </td>
            <td class="text-center">
            </td>
            <td class="text-right">
                {{ number_format($order->fee) }}
            </td>
        </tr>
    </tbody>
</table>
<div class="px-6 py-4 text-sm float-right">{{ __('訂單價值') }}: {{ number_format($order->total) }}</div>

@if ($hasOrderItemSub)
    <div class="antialiased sans-serif bg-gray-100">
        <div class="container mx-auto px-4 py-2 md:py-10">

            <div class="font-bold text-gray-800 text-xl mb-4">
                {{ __('訂閱狀態') }}
            </div>
            <div class="bg-white rounded-lg shadow overflow-hidden">
                @livewire('order.calendar', ['beforeCalendarView' => 'order.calendar.header', 'orderItems' => $order->orderItems])
            </div>
        </div>
    </div>
@endif