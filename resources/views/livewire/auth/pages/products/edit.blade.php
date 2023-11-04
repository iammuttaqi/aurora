@push('title', 'Product Edit')

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Product Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                <form class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-3" wire:submit="update">
                    <div class="space-y-1">
                        <x-label :value="$this->label('form.title')" for="title" />
                        <x-input :placeholder="$this->label('form.title')" :required="$this->required('form.title')" autofocus class="block w-full" id="title" name="title" type="text" wire:model="form.title" />
                        <x-input-error for="form.title" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.price')" for="price" />
                        <x-input :placeholder="$this->label('form.price')" :required="$this->required('form.price')" class="block w-full" id="price" name="price" type="text" wire:model="form.price" />
                        <x-input-error for="form.price" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.product_category_id')" for="product_category_id" />
                        <x-select :options="$product_categories" :value="old('form.product_category_id')" class="block w-full" default="Select {{ $this->label('form.product_category_id') }}..." id="product_category_id" key="id" name="product_category_id" required value_key="title" wire:model="form.product_category_id"></x-select>
                        <x-input-error for="form.product_category_id" />
                    </div>

                    <div class="col-span-full space-y-1">
                        <x-label :value="$this->label('form.description')" for="description" />
                        <x-textarea :placeholder="$this->label('form.description')" :required="$this->required('form.description')" class="block w-full" id="description" name="description" rows="5" type="text" wire:model="form.description" />
                        <x-input-error for="form.description" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.warranty_period')" for="warranty_period" />
                        <x-input :placeholder="$this->label('form.warranty_period')" :required="$this->required('form.warranty_period')" class="block w-full" id="warranty_period" name="warranty_period" type="number" wire:model="form.warranty_period" />
                        <x-input-error for="form.warranty_period" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.warranty_period_unit')" for="warranty_period_unit" />
                        <x-select :options="$warranty_period_units" :value="old('form.warranty_period_unit')" class="block w-full" default="Select {{ $this->label('form.warranty_period_unit') }}..." id="warranty_period_unit" key="slug" name="warranty_period_unit" required value_key="title" wire:model="form.warranty_period_unit"></x-select>
                        <x-input-error for="form.warranty_period_unit" />
                    </div>

                    <div class="col-span-full block space-x-2">
                        <x-button loading="update">{{ __('Update') }}</x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
