<form wire:submit="sell">
    <div class="space-y-4">

        <div class="space-y-1">
            <x-label value="{{ $this->label('form.name') }}" />
            <x-input :placeholder="$this->label('form.name')" :required="$this->required('form.name')" class="block w-full" type="text" wire:model="form.name" />
            <x-input-error for="form.name" />
        </div>

        <div class="space-y-1">
            <x-label value="{{ $this->label('form.phone_number') }}" />
            <x-input :placeholder="$this->label('form.phone_number')" :required="$this->required('form.phone_number')" class="block w-full" type="tel" wire:model="form.phone_number" />
            <x-input-error for="form.phone_number" />
        </div>

        <div class="space-y-1">
            <x-label value="{{ $this->label('form.email') }}" />
            <x-input :placeholder="$this->label('form.email')" :required="$this->required('form.email')" class="block w-full" type="email" wire:model="form.email" />
            <x-input-error for="form.email" />
        </div>

        <div class="space-y-1">
            <x-label value="{{ $this->label('form.age') }}" />
            <x-input :placeholder="$this->label('form.age')" :required="$this->required('form.age')" class="block w-full" max="200" min="1" type="number" wire:model="form.age" />
            <x-input-error for="form.age" />
        </div>

        <div class="space-y-1">
            <x-label :value="$this->label('form.gender')" for="gender" />
            <x-radio-advanced :full="true" :options="$genders" class="grid-cols-3" id="gender" key="title" name="gender" value_key="title" wire:model="form.gender" />
            <x-input-error for="form.gender" />
        </div>

        <div class="space-y-1">
            <x-label value="{{ $this->label('form.address') }}" />
            <x-input :placeholder="$this->label('form.address')" :required="$this->required('form.address')" class="block w-full" type="text" wire:model="form.address" />
            <x-input-error for="form.address" />
        </div>

        <div class="space-y-1">
            <x-label value="{{ $this->label('form.city') }}" />
            <x-input :placeholder="$this->label('form.city')" :required="$this->required('form.city')" class="block w-full" type="text" wire:model="form.city" />
            <x-input-error for="form.city" />
        </div>

        <div class="space-y-1" wire:ignore>
            <x-label value="{{ $this->label('form.country_id') }}" />
            <select class="country_id" name="country_id" required wire:model="form.country_id">
                <option value="">Select</option>
                @foreach ($countries as $country)
                    <option {{ $form['country_id'] == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->nicename }}</option>
                @endforeach
            </select>
            <x-input-error for="form.country_id" />
        </div>

        <div class="space-y-1">
            <x-label value="{{ $this->label('form.notes') }}" />
            <x-textarea :placeholder="$this->label('form.notes')" :required="$this->required('form.notes')" class="block w-full" wire:model="form.notes" />
            <x-input-error for="form.notes" />
        </div>

        <x-button loading="sell">
            {{ __('Sell to the Customer') }}
        </x-button>
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

        if (typeof tom_select === 'undefined') {
            const tom_select = new TomSelect('.country_id', config)
        }
    </script>
@endpush
