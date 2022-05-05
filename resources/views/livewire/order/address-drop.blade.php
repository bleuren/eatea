<div class='md:flex-none md:w-auto md:flex w-full pb-6 md:pb-0'>
    <select class="md:flex-grow block md:rounded-l-md md:rounded-tr-none rounded-t-md w-full"
        name="city" wire:model="city" wire:loading.attr="disabled" wire:change="getDistricts">
        <option>選擇縣市</option>
        @foreach ($cities as $option)
            <option value="{{ $option['city'] }}">{{ $option['city'] }}</option>
        @endforeach
    </select>
    <select
        class="md:flex-grow block md:border-l-0 md:border-r-0 md:border-t md:border-b border-t-0 border-b-0 w-full"
        name="district" wire:model="district" wire:loading.attr="disabled" wire:change="getRoads">
        <option>選擇行政區</option>
        @foreach ($districts as $option)
            <option value="{{ $option['district'] }}">{{ $option['district'] }}</option>
        @endforeach
    </select>
    <select class="md:flex-grow block md:rounded-r-md md:rounded-bl-none rounded-b-md  w-full"
        name="map_id" wire:model="map_id" wire:loading.attr="disabled">
        <option value="0">選擇路名</option>
        @foreach ($roads as $option)
            <option value="{{ $option['id'] }}">{{ $option['road'] }}</option>
        @endforeach
    </select>
</div>