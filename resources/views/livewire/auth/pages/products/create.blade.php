@push('title', 'Product Create')

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Product Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                <form class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-3" wire:submit="store" x-data="{
                    product_count: @entangle('product_count'),
                    product_count_max: @entangle('product_count_max'),
                    product_count_min: @entangle('product_count_min'),
                }">
                    <div class="col-span-full space-y-1">
                        <x-label :value="$this->label('form.image')" />

                        <div class="flex w-full items-center justify-center sm:w-2/4 md:w-1/4">
                            <label class="dark:hover:bg-bray-800 flex h-64 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 bg-contain bg-center bg-no-repeat hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-600" for="dropzone-file" style="background-image: url('{{ $form['image'] ? $form['image']->temporaryUrl() : '' }}')" wire:loading.class="!cursor-not-allowed" wire:target="form.image">
                                @if (!$form['image'])
                                    <div class="flex flex-col items-center justify-center pb-6 pt-5">
                                        <i class="bi bi-arrow-repeat animate-spin text-8xl text-gray-500 dark:text-gray-400" wire:loading wire:target="form.image"></i>
                                        <i class="bi bi-cloud-arrow-up text-8xl text-gray-500 dark:text-gray-400" wire:loading.remove wire:target="form.image"></i>
                                    </div>
                                @endif
                                <input class="hidden" id="dropzone-file" type="file" wire:model="form.image" />
                            </label>
                        </div>

                        <x-input-error for="form.image" />
                    </div>

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

                    <div class="space-y-1">
                        <x-label :value="$this->label('product_count')" for="product_count" />
                        <div class="flex">
                            <button class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-200 px-3 text-sm text-black dark:border-gray-600 dark:bg-gray-600 dark:text-white" type="button" x-on:click="product_count > product_count_min ? product_count-- : null">
                                <i class="bi bi-dash-circle-fill mr-2 text-lg text-purple-500 dark:text-purple-400"></i>
                                Decrease
                            </button>
                            <x-input :placeholder="$this->label('product_count')" :required="$this->required('product_count')" class="block w-full rounded-none" id="product_count" name="product_count" type="number" x-bind:max="product_count_max" x-bind:min="product_count_min" x-model="product_count" />
                            <button class="inline-flex items-center rounded-r-md border border-l-0 border-gray-300 bg-gray-200 px-3 text-sm text-black dark:border-gray-600 dark:bg-gray-600 dark:text-white" type="button" x-on:click="product_count < product_count_max ? product_count++ : null">
                                <i class="bi bi-plus-circle-fill mr-2 text-lg text-purple-500 dark:text-purple-400"></i>
                                Increase
                            </button>
                        </div>
                        <x-input-error for="product_count" />
                    </div>

                    <div class="col-span-full block space-x-2">
                        <x-button loading="store, form.image">{{ __('Save') }}</x-button>
                        <span class="text-sm text-yellow-500" wire:loading wire:target="store">Please wait. This action may take a while.</span>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
