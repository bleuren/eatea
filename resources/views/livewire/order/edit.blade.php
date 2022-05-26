<div>
    <form action="{{ route('order.update', ['order' => $order->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tbody>
                <tr>
                    <td class="w-1/4">用戶</td>
                    <td class="w-full">{{ $order->user->name }}</td>
                </tr>
                <tr>
                    <td class="w-1/4">收件人</td>
                    <td><input class="w-full rounded-md" name="name" type="text" value="{{ $order->name }}" /></td>
                </tr>
                @if(isset($order->map))
                <tr>
                    <td class="w-1/4">地址</td>
                    <td>@livewire('order.address-drop', ['map_id' => $order->map_id]) 
                        <input class="w-full rounded-md md:mt-4" name="address" type="text" value="{{ $order->address }}" /></td>
                </tr>
                @endif
                <tr>
                    <td class="w-1/4">手機</td>
                    <td><input class="w-full rounded-md" name="mobile" type="text" value="{{ $order->mobile }}" /></td>
                </tr>
                <tr>
                    <td class="w-1/4">付款帳號</td>
                    <td><input class="w-full rounded-md" name="payment[id]" type="text" value="{{ $order->payment['id'] }}" /></td>
                </tr>
                <tr>
                    <td class="w-1/4">運費</td>
                    <td><input class="w-full rounded-md" name="fee" type="text" value="{{ $order->fee }}" /></td>
                </tr>
                <tr>
                    <td class="w-1/4">訊息</td>
                    <td><input class="w-full rounded-md" name="message" type="text" value="{{ $order->message }}" /></td>
                </tr>
                <tr>
                    <td class="w-1/4">訂單狀態</td>
                    <td>
                        <select name="status">
                            <option {{ $order->status === 'PENDING' ? 'selected' : '' }} value="PENDING">
                                {{ __('PENDING') }}</option>
                            <option {{ $order->status === 'CHECKED' ? 'selected' : '' }} value="CHECKED">
                                {{ __('CHECKED') }}</option>
                            <option {{ $order->status === 'PAID' ? 'selected' : '' }} value="PAID">
                                {{ __('PAID') }}
                            </option>
                            <option {{ $order->status === 'ARRIVED' ? 'selected' : '' }} value="ARRIVED">
                                {{ __('ARRIVED') }}</option>
                        </select>
                        <button class="btn btn-danger" type="submit">修改</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

</div>
