@extends('layouts.user')

@section('breadcrumb')
    {{ __('推薦') }}
@endsection

@section('content')
    <table>
        <thead>
            <tr>
                <th class="text-left">
                    {{ __('建立於') }}
                </th>

                <th>
                    {{ __('類型') }}
                </th>

                <th>
                    {{ __('來源') }}
                </th>

                <th class="text-right">
                    {{ __('金額') }}
                </th>
            </tr>
        </thead>

        <tbody wire:sortable="">
            @foreach ($wallet['transactions'] as $transaction)
                <tr>
                    <td>
                        {{ $transaction->created_at }}
                    </td>
                    <td class="text-center">
                        {{ __($transaction->type) }}
                    </td>
                    <td class="text-center">
                        @if ($transaction->meta['type'] === 'shopping')
                        <a href="{{ route('order.show', ['order' => $transaction->meta['order']]) }}">#{{ $transaction->meta['order'] }}</a>
                        @else
                        {{ __($transaction->meta['type']) }}
                        @endif
                    </td>
                    <td class="text-right">
                        {{ number_format($transaction->amount) }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-right">總計: {{ number_format($wallet['balance']) }}</td>
            </tr>
        </tbody>
    </table>

@endsection
