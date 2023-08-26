<form wire:submit="sell">
    <div class="grid gap-y-4">
        <div class="flex flex-col gap-1" wire:ignore>
            <select class="shop_id" name="shop_id" required wire:model="shop_id">
                <option value="">Select</option>
                @foreach ($shops as $shop)
                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                @endforeach
            </select>
            <x-input-error for="shop_id" />
        </div>

        <x-button loading="sell">
            {{ __('Sell to the Selected Shop') }}
        </x-button>
    </div>
</form>
