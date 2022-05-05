<div>
    <form action="{{ route('order.update.payment', ['order' => $order->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <input type="radio" id="DEFAULT" name="payment[method]" wire:model="method" value="DEFAULT">
            <label for="DEFAULT">使用轉帳</label>
            <input type="radio" id="WALLET" name="payment[method]" wire:model="method" value="WALLET">
            <label for="WALLET">使用錢包</label>
        </div>
        @switch($method)
            @case('WALLET')
                <span>帳戶餘額: {{ $user->balance }}</span>
                @if ($isInsufficient)
                    <button class="btn btn-secondary" disabled>餘額不足</button>
                @else
                    <button class="btn btn-warning" type="submit">確認扣款</button>
                @endif
            @break

            @default
                <input name="payment[id]" type="text" value="{{ $order->payment['id'] }}" />
                <button class="btn btn-warning" type="submit">通知已付款</button>
        @endswitch
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</div>
