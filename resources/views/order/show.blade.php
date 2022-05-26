@extends('layouts.user')

@section('breadcrumb')
    <a href="{{ route('order.index') }}">{{ __('訂單') }}</a> #{{ $order->id }}

@endsection

@section('content')
    <table>
        <tbody>
            <tr>
                <td class="w-1/4">用戶</td>
                <td>{{ $order->user->name }}</td>
                <td class="text-right">
                    @if (Auth::user()->hasRole('admin'))
                    <a href="{{ route('order.edit', ['order' => $order->id]) }}"><button class="btn btn-danger" type="submit">編輯</button></a>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="w-1/4">收件人</td>
                <td>{{ $order->name }}</td>
            </tr>
            @if(isset($order->map))
            <tr>
                <td class="w-1/4">地址</td>
                <td>{{ $order->map->city }}{{ $order->map->district }}{{ $order->map->road }}{{ $order->address }}
                </td>
            </tr>
            @endif
            <tr>
                <td class="w-1/4">手機</td>
                <td>{{ $order->mobile }}</td>
            </tr>
            <tr>
                <td class="w-1/4">付款帳號</td>
                @if ($order->status === 'CHECKED')
                    <td>@livewire('order.payment', ['order' => $order])</td>
                @else
                    <td>{{ $order->payment['id'] }}</td>
                @endif
            </tr>
            <tr>
                <td class="w-1/4">運費</td>
                <td>{{ number_format($order->fee) }}</td>
            </tr>
            <tr>
                <td class="w-1/4">訊息</td>
                <td>{{ $order->message }}</td>
            </tr>
            <tr>
                <td class="w-1/4">訂單狀態</td>
                <td>{{ __($order->status) }}</td>
            </tr>
        </tbody>
    </table>
    @include('order.items.index')
@endsection
