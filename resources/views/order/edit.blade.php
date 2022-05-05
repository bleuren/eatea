@extends('layouts.user')

@section('breadcrumb')
    <a href="{{ route('order.index') }}">{{ __('訂單') }}</a> #{{ $order->id }}
@endsection

@section('content')
    @livewire('order.edit', ['order_id' => $order->id])
    @include('order.items.index')
@endsection
