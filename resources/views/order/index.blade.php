@extends('layouts.user')

@section('breadcrumb')
    {{ __('訂單') }}
@endsection

@section('content')
    <table>
        <thead>
            <tr>
                <th>
                    <span class="group">
                        {{ __('建立於') }}
                    </span>
                </th>

                <th>
                    <span class="group">
                        {{ __('訂單編號') }}
                    </span>
                </th>

                <th>
                    <span class="group">
                        {{ __('付款資訊') }}
                    </span>
                </th>

                <th>
                    <span class="group">
                        {{ __('收件人') }}
                    </span>
                </th>

                <th>
                    <span class="group">
                        {{ __('訂單狀態') }}
                    </span>
                </th>

                <th>
                    <span class="group">
                        {{ __('更新於') }}
                    </span>
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>
                        {{ $order->created_at }}
                    </td>
                    <td>
                        <a
                            href="{{ route(Auth::user()->role->name === 'admin' ? 'order.edit' : 'order.show', ['order' => $order->id]) }}">{{ $order->id }}</a>
                    </td>
                    <td>
                        {{ __($order->payment['id']) }}
                    </td>
                    <td>
                        {{ $order->name }}
                    </td>
                    <td>
                        {{ __($order->status) }}
                    </td>
                    <td>
                        {{ $order->updated_at }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
