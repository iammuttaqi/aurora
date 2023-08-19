<form wire:submit.prevent="sell">
    <div class="grid gap-y-4">
        <div class="flex flex-col gap-1" wire:ignore>
            <select class="shop_id" name="shop_id" required wire:model.defer="shop_id">
                <option value="">Select</option>
                @foreach ($shops as $shop)
                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                @endforeach
            </select>
            <x-input-error for="shop_id" />
        </div>

        <button class="inline-flex items-center justify-center gap-2 rounded-md border border-transparent bg-blue-500 px-4 py-3 text-sm font-semibold text-white transition-all hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800" type="submit" wire:loading.class="!bg-blue-400" wire:target="sell">
            <span aria-label="loading" class="inline-block h-4 w-4 animate-spin rounded-full border-[3px] border-current border-t-transparent text-white" role="status" wire:loading wire:target="sell"></span>
            Sell to the Selected Shop
        </button>
    </div>
</form>
