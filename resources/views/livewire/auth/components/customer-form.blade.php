<form wire:submit.prevent="sell">
    <div class="grid gap-y-4">

        <div class="flex flex-col gap-1">
            <x-label value="{{ $this->label('form.name') }}" />
            <x-input :required="$this->required('form.name')" :placeholder="$this->label('form.name')" class="block w-full" type="text" wire:model.defer="form.name" />
            <x-input-error for="form.name" />
        </div>

        <div class="flex flex-col gap-1">
            <x-label value="{{ $this->label('form.phone_number') }}" />
            <x-input :required="$this->required('form.phone_number')" :placeholder="$this->label('form.phone_number')" class="block w-full" type="text" wire:model.defer="form.phone_number" />
            <x-input-error for="form.phone_number" />
        </div>

        <div class="flex flex-col gap-1">
            <x-label value="{{ $this->label('form.email') }}" />
            <x-input :required="$this->required('form.email')" :placeholder="$this->label('form.email')" class="block w-full" type="email" wire:model.defer="form.email" />
            <x-input-error for="form.email" />
        </div>

        <div class="flex flex-col gap-1">
            <x-label value="{{ $this->label('form.age') }}" />
            <x-input :required="$this->required('form.age')" :placeholder="$this->label('form.age')" class="block w-full" max="200" min="1" type="number" wire:model.defer="form.age" />
            <x-input-error for="form.age" />
        </div>

        <div class="flex flex-col gap-1">
            <x-label :value="$this->label('form.gender')" for="gender" />
            <x-radio-advanced :options="$genders" :full="true" class="grid-cols-3" id="gender" key="title" name="gender" value_key="title" wire:model.defer="form.gender" />
            <x-input-error for="form.gender" />
        </div>

        <div class="flex flex-col gap-1">
            <x-label value="{{ $this->label('form.address') }}" />
            <x-input :required="$this->required('form.address')" :placeholder="$this->label('form.address')" class="block w-full" type="text" wire:model.defer="form.address" />
            <x-input-error for="form.address" />
        </div>

        <div class="flex flex-col gap-1">
            <x-label value="{{ $this->label('form.city') }}" />
            <x-input :required="$this->required('form.city')" :placeholder="$this->label('form.city')" class="block w-full" type="text" wire:model.defer="form.city" />
            <x-input-error for="form.city" />
        </div>

        <div class="flex flex-col gap-1" wire:ignore>
            <x-label value="{{ $this->label('form.country_id') }}" />
            <select class="country_id" name="country_id" required wire:model.defer="form.country_id">
                <option value="">Select</option>
                @foreach ($countries as $country)
                    <option {{ $form['country_id'] == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->nicename }}</option>
                @endforeach
            </select>
            <x-input-error for="form.country_id" />
        </div>

        <div class="flex flex-col gap-1">
            <x-label value="{{ $this->label('form.notes') }}" />
            <x-textarea :required="$this->required('form.notes')" :placeholder="$this->label('form.notes')" class="block w-full" wire:model.defer="form.notes" />
            <x-input-error for="form.notes" />
        </div>

        <button class="inline-flex items-center justify-center gap-2 rounded-md border border-transparent bg-blue-500 px-4 py-3 text-sm font-semibold text-white transition-all hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800" type="submit" wire:loading.class="!bg-blue-400" wire:target="sell">
            <span aria-label="loading" class="inline-block h-4 w-4 animate-spin rounded-full border-[3px] border-current border-t-transparent text-white" role="status" wire:loading wire:target="sell"></span>
            Sell to the Customer
        </button>
    </div>
</form>

@push('scripts')
    <script>
        let config = {
            placeholder: 'Select...',
            plugins: {},
            maxOptions: 1000
        }

        if (@js(count($countries)) > 1 ? true : false) {
            config.plugins.remove_button = {
                title: 'Remove this item'
            };
        }

        new TomSelect('.country_id', config)
    </script>
@endpush
