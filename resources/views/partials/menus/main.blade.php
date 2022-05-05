@php

if (Voyager::translatable($items)) {
    $items = $items->load('translations');
}

@endphp
@foreach ($items as $item)

    @php
        $originalItem = $item;
        if (Voyager::translatable($item)) {
            $item = $item->translate($options->locale);
        }
        
        $isActive = null;
        $hasChildren = false;
        $styles = null;
        $icon = null;
        
        // Background Color or Color
        if (isset($options->color) && $options->color == true) {
            $styles = 'color:' . $item->color;
        }
        if (isset($options->background) && $options->background == true) {
            $styles = 'background-color:' . $item->color;
        }
        
        // Check if link is current
        if (url($item->link()) == url()->current()) {
            $isActive = 'active';
        }
        
        // Set Icon
        if (isset($options->icon) && $options->icon == true) {
            $icon = '<i class="' . $item->icon_class . '"></i>';
        }
        
        // Check if link has children
        $hasChildren = !$originalItem->children->isEmpty();
        
    @endphp

    <li class="{{ $isActive }}{{ $hasChildren ? ' drop-down' : '' }}">
        <a href="{{ url($item->link()) }}" target="{{ $item->target }}" style="{{ $styles }}">
            {!! $icon !!}
            <span>{{ $item->title }}</span>
        </a>
        @if ($hasChildren)
            <ul>
                @include('partials.menus.main', ['items' => $originalItem->children, 'options' => $options])
            </ul>
        @endif
    </li>
@endforeach
