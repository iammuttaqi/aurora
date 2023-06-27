@push('title', 'Profile')

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                <form class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2" wire:submit.prevent="store">
                    <div class="grid gap-2">
                        <x-label :value="$this->label('form.name')" for="name" />
                        <x-input :required="$this->required('form.name')" class="block w-full" id="name" name="name" type="text" wire:model="form.name" />
                        <x-input-error for="form.name" />
                    </div>

                    <div class="grid gap-2">
                        <x-label :value="$this->label('form.email')" for="email" />
                        <x-input :required="$this->required('form.email')" class="block w-full" id="email" name="email" type="email" wire:model="form.email" />
                        <x-input-error for="form.email" />
                    </div>

                    <div class="block">
                        <x-button wire:loading.attr="disabled" wire:target="store">
                            <div aria-label="loading" class="mr-1 inline-block h-4 w-4 animate-spin rounded-full border-[3px] border-current border-t-transparent text-gray-800" role="status" wire:loading wire:target="store">
                                <span class="sr-only">Loading...</span>
                            </div>
                            {{ __('Submit') }}
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
