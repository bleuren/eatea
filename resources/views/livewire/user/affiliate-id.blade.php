<div>
    你的邀請連結:
    {{ url('/') . '/?ref=' }}@if (!$isInputVisible)<span
            wire:model="affiliate_id">{{ $affiliate_id }}</span>
        <button class="btn btn-danger" wire:click="onUpdateClick">修改</button>
    @else
        <input type="text" x-on:click.away="$wire.offUpdateClick" wire:keydown.enter="updateInput"
            wire:model="affiliate_id" maxlength="8" minlength="5" onfocus="this.select()">
        <button class="btn btn-danger" wire:click="updateInput">儲存</button>
    @endif

    @error('affiliate_id') <span class="text-red-600 error">{{ $message }}</span> @enderror
</div>
