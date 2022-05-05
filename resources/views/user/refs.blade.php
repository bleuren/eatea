@extends('layouts.user')

@section('breadcrumb')
    {{ __('推薦') }}
@endsection

@section('content')
    <table>
        <thead>
            <tr>
                <th class="text-left">
                    {{ __('用戶') }}
                </th>
                <th class="text-right">
                    {{ __('消費金額') }}
                </th>
            </tr>
        </thead>

        <tbody wire:sortable="">
            @foreach ($refs as $ref)
                <tr>
                    <td>
                        {{ $ref->affiliate_id }}
                    </td>
                    <td class="text-right">
                        {{ number_format($ref->total) }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" class="text-right">總計: {{ number_format($refs->total) }} </td>
            </tr>
        </tbody>
    </table>

@endsection
