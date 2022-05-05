<div>
    <input wire:model="qty" type="number" min="1" wire:change="updateQty" class="w-14 md:w-full">
    @error('qty') <span class="text-red-600 error">{{ $message }}</span> @enderror
</div>
