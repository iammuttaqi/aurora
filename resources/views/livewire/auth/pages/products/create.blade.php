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

                <form class="grid grid-cols-1 gap-5 p-5 md:grid-cols-12" wire:submit.prevent="store">
                    {{-- <div class="col-span-full flex flex-col gap-1">
                        <x-label :value="$this->label('logo')" for="name" />
                        <div class="flex items-center">
                            <label class="dark:hover:bg-bray-800 flex h-64 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 bg-contain bg-center bg-no-repeat transition hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-600 sm:w-64" for="dropzone-file" style="background-image: url('@if ($logo) {{ $logo->temporaryUrl() }} @elseif($form['logo']) {{ asset($form['logo']) }} @endif')">
                                <div class="flex flex-col items-center justify-center pb-6 pt-5" role="status" wire:loading wire:target="logo">
                                    <svg aria-hidden="true" class="inline h-10 w-10 animate-spin fill-blue-600 text-gray-200 dark:text-gray-600" fill="none" viewBox="0 0 100 101" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                                @if (!$form['logo'] && !$logo)
                                    <div class="flex flex-col items-center justify-center pb-6 pt-5" wire:loading.remove wire:target="logo">
                                        <i class="bi bi-cloud-upload mb-3 text-5xl text-gray-400"></i>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Click to upload</span>
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG (MAX.
                                            800x800px)</p>
                                    </div>
                                @endif
                                <input class="hidden" id="dropzone-file" type="file" wire:model="logo" />
                            </label>
                        </div>
                        <x-input-error for="logo" />
                    </div> --}}

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-4 lg:col-span-4">
                        <x-label :value="$this->label('form.title')" for="title" />
                        <x-input :required="$this->required('form.title')" :placeholder="$this->label('form.title')" autofocus class="block w-full" id="title" name="title" type="text" wire:model.defer="form.title" />
                        <x-input-error for="form.title" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-4 lg:col-span-4">
                        <x-label :value="$this->label('form.price')" for="price" />
                        <x-input :required="$this->required('form.price')" :placeholder="$this->label('form.price')" class="block w-full" id="price" name="price" type="text" wire:model.defer="form.price" />
                        <x-input-error for="form.price" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-4 lg:col-span-4">
                        <x-label :value="$this->label('form.product_category_id')" for="product_category_id" />
                        <x-select :value="old('form.product_category_id')" :options="$product_categories" class="block w-full" default="Select City..." id="product_category_id" key="id" name="product_category_id" required value_key="title" wire:model.defer="form.product_category_id"></x-select>
                        <x-input-error for="form.product_category_id" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-12">
                        <x-label :value="$this->label('form.description')" for="description" />
                        <x-textarea :required="$this->required('form.description')" :placeholder="$this->label('form.description')" class="block w-full" id="description" name="description" rows="5" type="text" wire:model.defer="form.description" />
                        <x-input-error for="form.description" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.warranty_period')" for="warranty_period" />
                        <x-input :required="$this->required('form.warranty_period')" :placeholder="$this->label('form.warranty_period')" class="block w-full" id="warranty_period" name="warranty_period" type="number" wire:model.defer="form.warranty_period" />
                        <x-input-error for="form.warranty_period" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.warranty_period_unit')" for="warranty_period_unit" />
                        <x-select :value="old('form.warranty_period_unit')" :options="$warranty_period_units" class="block w-full" default="Select City..." id="warranty_period_unit" key="slug" name="warranty_period_unit" required value_key="title" wire:model.defer="form.warranty_period_unit"></x-select>
                        <x-input-error for="form.warranty_period_unit" />
                    </div>

                    <div class="col-span-full block">
                        <x-button wire:loading.attr="disabled" wire:target="store">
                            <div aria-label="loading" class="mr-2 inline-block h-4 w-4 animate-spin rounded-full border-[3px] border-current border-t-transparent text-white dark:text-gray-800" role="status" wire:loading wire:target="store">
                                <span class="sr-only">Loading...</span>
                            </div>
                            {{ __('Save') }}
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
