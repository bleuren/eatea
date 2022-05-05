<div @if ($eventClickEnabled) wire:click.stop="onEventClick('{{ $event['id'] }}')" @endif class="@switch($event['status'])
     @case('ARRIVED')
    border-green-200 text-green-800 bg-green-100
    @break

    @case('UNCLAIMED')
        border-yellow-200 text-yellow-800 bg-yellow-100
    @break

    @default
        border-red-200 text-red-800 bg-red-100
@endswitch
px-2 py-1 rounded-lg mt-1 overflow-hidden border @can('update', $event) cursor-pointer  @endcan">

<p class="text-sm truncate leading-tight">
    {{ $event->product->name }} : {{ $event['qty'] }}
    @can('delete', $event)
        <button class="float-right" wire:click.stop="deleteEvent({{ $event->id }})"> <i
                class="fas fa-times"></i></button>
    @endcan
</p>
</div>
