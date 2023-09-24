<form wire:submit="sell">
    <div class="grid gap-y-4">
        <div class="flex flex-col gap-1">
            <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                <x-input autofocus class="block w-full" id="username" name="username" placeholder="Username" required type="text" wire:model="username" />
                <x-input-error for="username" />
            </div>
        </div>

        <x-button loading="sell">
            {{ __('Sell to the Selected Shop') }}
        </x-button>
    </div>
</form>
