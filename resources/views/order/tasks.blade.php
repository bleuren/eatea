<h1> 今日訂閱訂單 </h1>
<hr>
@foreach ($orderItemSubs->products as $name => $qty)
    <p>{{ $name }} 需準備 {{ $qty }} 瓶</p>
@endforeach
<p>共 {{ array_sum($orderItemSubs->products) }} 瓶</p>

@foreach ($orderItemSubs as $orderItemSub)
    <p>訂單: <a
            href="{{ route('order.show', ['order' => $orderItemSub->orderItem->order->id]) }}">{{ $orderItemSub->orderItem->order->id }}</a>
        : 送 {{ $orderItemSub->orderItem->product->name }} * {{ $orderItemSub->qty }} 到
        {{ $orderItemSub->orderItem->order->address }} 給 {{ $orderItemSub->orderItem->order->name }}
        {{ $orderItemSub->status === 'ARRIVED' ? '(已完成)' : '' }}</p>
@endforeach
