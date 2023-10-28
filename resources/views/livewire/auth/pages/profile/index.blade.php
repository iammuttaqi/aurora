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

                <form class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2" wire:submit="update" x-data="{
                    form: {
                        email_1: @entangle('form.email_1'),
                        email_2: @entangle('form.email_2'),
                        email_3: @entangle('form.email_3'),
                        website: @entangle('form.website'),
                        map_link: @entangle('form.map_link'),
                        facebook: @entangle('form.facebook'),
                        instagram: @entangle('form.instagram'),
                        twitter: @entangle('form.twitter'),
                        linkedin: @entangle('form.linkedin'),
                        general_manager_email: @entangle('form.general_manager_email'),
                        sales_manager_email: @entangle('form.sales_manager_email'),
                        hr_manager_email: @entangle('form.hr_manager_email'),
                        it_manager_email: @entangle('form.it_manager_email'),
                    },
                    makeUrlFriendly(str) {
                        return str.replace(/\s+/g, '-').toLowerCase();
                    }
                }" x-init="() => {
                    for (let prop in form) {
                        $watch(`form.${prop}`, (value) => {
                            form[prop] = makeUrlFriendly(value);
                        })
                    }
                }">
                    <div class="col-span-full space-y-1">
                        <x-label :value="$this->label('logo')" />

                        <div class="flex w-full items-center justify-center sm:w-2/4 md:w-1/4">
                            <label class="dark:hover:bg-bray-800 flex h-64 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 bg-contain bg-center bg-no-repeat transition-all hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-600" for="dropzone-file" style="background-image: url('{{ $logo ? $logo->temporaryUrl() : $form['logo'] ?? '' }}')" wire:loading.class="!cursor-not-allowed" wire:target="logo">
                                <div class="flex flex-col items-center justify-center pb-6 pt-5">
                                    <i class="bi bi-arrow-repeat animate-spin text-8xl text-gray-500 dark:text-gray-400" wire:loading wire:target="logo"></i>
                                    @if (!$logo && !$form['logo'])
                                        <i class="bi bi-cloud-arrow-up text-8xl text-gray-500 dark:text-gray-400" wire:loading.remove wire:target="logo"></i>
                                    @endif
                                </div>
                                <input class="hidden" id="dropzone-file" type="file" wire:model="logo" />
                            </label>
                        </div>

                        <x-input-error for="logo" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.name')" for="name" />
                        <x-input :placeholder="$this->label('form.name')" :required="$this->required('form.name')" autofocus class="block w-full" id="name" name="name" type="text" wire:model="form.name" />
                        <x-input-error for="form.name" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.contact_person')" for="contact_person" />
                        <x-input :placeholder="$this->label('form.contact_person')" :required="$this->required('form.contact_person')" class="block w-full" id="contact_person" name="contact_person" type="text" wire:model="form.contact_person" />
                        <x-input-error for="form.contact_person" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.address')" for="address" />
                        <x-input :placeholder="$this->label('form.address')" :required="$this->required('form.address')" class="block w-full" id="address" name="address" type="text" wire:model="form.address" />
                        <x-input-error for="form.address" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.city_id')" for="city_id" />
                        <x-select :options="$cities" :value="old('form.city_id')" class="block w-full" default="Select City..." id="city_id" name="city_id" required value_key="name" wire:model="form.city_id"></x-select>
                        <x-input-error for="form.city_id" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.contact_number_1')" for="contact_number_1" />
                        <div class="relative">
                            <i class="bi bi-telephone-fill pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :placeholder="$this->label('form.contact_number_1')" :required="$this->required('form.contact_number_1')" class="block w-full pl-10" id="contact_number_1" name="contact_number_1" type="tel" wire:model="form.contact_number_1" />
                        </div>
                        <x-input-error for="form.contact_number_1" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.contact_number_2')" for="contact_number_2" />
                        <div class="relative">
                            <i class="bi bi-telephone-fill pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :placeholder="$this->label('form.contact_number_2')" :required="$this->required('form.contact_number_2')" class="block w-full pl-10" id="contact_number_2" name="contact_number_2" type="tel" wire:model="form.contact_number_2" />
                        </div>
                        <x-input-error for="form.contact_number_2" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.contact_number_3')" for="contact_number_3" />
                        <div class="relative">
                            <i class="bi bi-telephone-fill pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :placeholder="$this->label('form.contact_number_3')" :required="$this->required('form.contact_number_3')" class="block w-full pl-10" id="contact_number_3" name="contact_number_3" type="tel" wire:model="form.contact_number_3" />
                        </div>
                        <x-input-error for="form.contact_number_3" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.email_1')" for="email_1" />
                        <div class="relative">
                            <i class="bi bi-envelope-fill pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :placeholder="$this->label('form.email_1')" :required="$this->required('form.email_1')" class="block w-full pl-10" id="email_1" name="email_1" type="email" wire:model="form.email_1" x-model="form.email_1" />
                        </div>
                        <x-input-error for="form.email_1" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.email_2')" for="email_2" />
                        <div class="relative">
                            <i class="bi bi-envelope-fill pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :placeholder="$this->label('form.email_2')" :required="$this->required('form.email_2')" class="block w-full pl-10" id="email_2" name="email_2" type="email" wire:model="form.email_2" x-model="form.email_2" />
                        </div>
                        <x-input-error for="form.email_2" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.email_3')" for="email_3" />
                        <div class="relative">
                            <i class="bi bi-envelope-fill pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :placeholder="$this->label('form.email_3')" :required="$this->required('form.email_3')" class="block w-full pl-10" id="email_3" name="email_3" type="email" wire:model="form.email_3" x-model="form.email_3" />
                        </div>
                        <x-input-error for="form.email_3" />
                    </div>

                    <div class="col-span-full space-y-1">
                        <x-label :value="$this->label('form.about')" for="about" />
                        <x-textarea :placeholder="$this->label('form.about')" :required="$this->required('form.about')" class="block w-full" id="about" name="about" rows="5" type="text" wire:model="form.about" />
                        <x-input-error for="form.about" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.website')" for="website" />
                        <div class="relative">
                            <i class="bi bi-globe2 pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :placeholder="$this->label('form.website')" :required="$this->required('form.website')" class="block w-full pl-10" id="website" name="website" type="url" wire:model="form.website" x-model="form.website" />
                        </div>
                        <x-input-error for="form.website" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.map_link')" for="map_link" />
                        <div class="relative">
                            <i class="bi bi-geo-alt-fill pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :placeholder="$this->label('form.map_link')" :required="$this->required('form.map_link')" class="block w-full pl-10" id="map_link" name="map_link" type="url" wire:model="form.map_link" x-model="form.map_link" />
                        </div>
                        <x-input-error for="form.map_link" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.facebook')" for="facebook" />
                        <div class="relative">
                            <i class="bi bi-facebook pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-blue-500"></i>
                            <x-input :placeholder="$this->label('form.facebook')" :required="$this->required('form.facebook')" class="block w-full pl-10" name="facebook" type="url" wire:model="form.facebook" x-model="form.facebook" />
                        </div>
                        <x-input-error for="form.facebook" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.instagram')" for="instagram" />
                        <div class="relative">
                            <i class="bi bi-instagram pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-pink-500"></i>
                            <x-input :placeholder="$this->label('form.instagram')" :required="$this->required('form.instagram')" class="block w-full pl-10" id="instagram" name="instagram" type="url" wire:model="form.instagram" x-model="form.instagram" />
                        </div>
                        <x-input-error for="form.instagram" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.twitter')" for="twitter" />
                        <div class="relative">
                            <i class="bi bi-twitter pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-blue-500"></i>
                            <x-input :placeholder="$this->label('form.twitter')" :required="$this->required('form.twitter')" class="block w-full pl-10" id="twitter" name="twitter" type="url" wire:model="form.twitter" x-model="form.twitter" />
                        </div>
                        <x-input-error for="form.twitter" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.linkedin')" for="linkedin" />
                        <div class="relative">
                            <i class="bi bi-linkedin pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-sky-600"></i>
                            <x-input :placeholder="$this->label('form.linkedin')" :required="$this->required('form.linkedin')" class="block w-full pl-10" id="linkedin" name="linkedin" type="url" wire:model="form.linkedin" x-model="form.linkedin" />
                        </div>
                        <x-input-error for="form.linkedin" />
                    </div>

                    <div class="col-span-full space-y-1" wire:ignore>
                        <x-label :value="$this->label('form.category_ids')" for="category_ids" />
                        <select class="multiselect" multiple name="category_ids[]" wire:model="form.category_ids">
                            @foreach ($categories as $category)
                                <option {{ isset($form['category_ids']) && $form['category_ids'] && in_array($category->id, $form['category_ids']) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="form.category_ids" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.tax_number')" for="tax_number" />
                        <x-input :placeholder="$this->label('form.tax_number')" :required="$this->required('form.tax_number')" class="block w-full" id="tax_number" name="tax_number" type="text" wire:model="form.tax_number" />
                        <x-input-error for="form.tax_number" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.vat_number')" for="vat_number" />
                        <x-input :placeholder="$this->label('form.vat_number')" :required="$this->required('form.vat_number')" class="block w-full" id="vat_number" name="vat_number" type="text" wire:model="form.vat_number" />
                        <x-input-error for="form.vat_number" />
                    </div>

                    <div class="col-span-full space-y-1">
                        <x-label :value="$this->label('form.employee_range_id')" for="employee_range_id" />
                        <x-radio-advanced :options="$employee_ranges" class="sm:grid-cols-6" id="employee_range_id" name="employee_range_id" wire:model="form.employee_range_id" />
                        <x-input-error for="form.employee_range_id" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.business_license')" for="business_license" />
                        <x-textarea :placeholder="$this->label('form.business_license')" :required="$this->required('form.business_license')" class="block w-full" id="business_license" name="business_license" rows="5" type="text" wire:model="form.business_license" />
                        <x-input-error for="form.business_license" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.payment_terms')" for="payment_terms" />
                        <x-textarea :placeholder="$this->label('form.payment_terms')" :required="$this->required('form.payment_terms')" class="block w-full" id="payment_terms" name="payment_terms" rows="5" type="text" wire:model="form.payment_terms" />
                        <x-input-error for="form.payment_terms" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.shipping_options')" for="shipping_options" />
                        <x-textarea :placeholder="$this->label('form.shipping_options')" :required="$this->required('form.shipping_options')" class="block w-full" id="shipping_options" name="shipping_options" rows="5" type="text" wire:model="form.shipping_options" />
                        <x-input-error for="form.shipping_options" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.additional_information')" for="additional_information" />
                        <x-textarea :placeholder="$this->label('form.additional_information')" :required="$this->required('form.additional_information')" class="block w-full" id="additional_information" name="additional_information" rows="5" type="text" wire:model="form.additional_information" />
                        <x-input-error for="form.additional_information" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.general_manager_name')" for="general_manager_name" />
                        <x-input :placeholder="$this->label('form.general_manager_name')" :required="$this->required('form.general_manager_name')" class="block w-full" id="general_manager_name" name="general_manager_name" type="text" wire:model="form.general_manager_name" />
                        <x-input-error for="form.general_manager_name" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.general_manager_email')" for="general_manager_email" />
                        <x-input :placeholder="$this->label('form.general_manager_email')" :required="$this->required('form.general_manager_email')" class="block w-full" id="general_manager_email" name="general_manager_email" type="email" wire:model="form.general_manager_email" x-model="form.general_manager_email" />
                        <x-input-error for="form.general_manager_email" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.sales_manager_name')" for="sales_manager_name" />
                        <x-input :placeholder="$this->label('form.sales_manager_name')" :required="$this->required('form.sales_manager_name')" class="block w-full" id="sales_manager_name" name="sales_manager_name" type="text" wire:model="form.sales_manager_name" />
                        <x-input-error for="form.sales_manager_name" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.sales_manager_email')" for="sales_manager_email" />
                        <x-input :placeholder="$this->label('form.sales_manager_email')" :required="$this->required('form.sales_manager_email')" class="block w-full" id="sales_manager_email" name="sales_manager_email" type="email" wire:model="form.sales_manager_email" x-model="form.sales_manager_email" />
                        <x-input-error for="form.sales_manager_email" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.hr_manager_name')" for="hr_manager_name" />
                        <x-input :placeholder="$this->label('form.hr_manager_name')" :required="$this->required('form.hr_manager_name')" class="block w-full" id="hr_manager_name" name="hr_manager_name" type="text" wire:model="form.hr_manager_name" />
                        <x-input-error for="form.hr_manager_name" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.hr_manager_email')" for="hr_manager_email" />
                        <x-input :placeholder="$this->label('form.hr_manager_email')" :required="$this->required('form.hr_manager_email')" class="block w-full" id="hr_manager_email" name="hr_manager_email" type="email" wire:model="form.hr_manager_email" x-model="form.hr_manager_email" />
                        <x-input-error for="form.hr_manager_email" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.it_manager_name')" for="it_manager_name" />
                        <x-input :placeholder="$this->label('form.it_manager_name')" :required="$this->required('form.it_manager_name')" class="block w-full" id="it_manager_name" name="it_manager_name" type="text" wire:model="form.it_manager_name" />
                        <x-input-error for="form.it_manager_name" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.it_manager_email')" for="it_manager_email" />
                        <x-input :placeholder="$this->label('form.it_manager_email')" :required="$this->required('form.it_manager_email')" class="block w-full" id="it_manager_email" name="it_manager_email" type="email" wire:model="form.it_manager_email" x-model="form.it_manager_email" />
                        <x-input-error for="form.it_manager_email" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.manufacturing_capabilities')" for="manufacturing_capabilities" />
                        <x-textarea :placeholder="$this->label('form.manufacturing_capabilities')" :required="$this->required('form.manufacturing_capabilities')" class="block w-full" id="manufacturing_capabilities" name="manufacturing_capabilities" rows="5" type="text" wire:model="form.manufacturing_capabilities" />
                        <x-input-error for="form.manufacturing_capabilities" />
                    </div>

                    <div class="space-y-1">
                        <x-label :value="$this->label('form.certifications')" for="certifications" />
                        <x-textarea :placeholder="$this->label('form.certifications')" :required="$this->required('form.certifications')" class="block w-full" id="certifications" name="certifications" rows="5" wire:model="form.certifications" />
                        <x-input-error for="form.certifications" />
                    </div>

                    <div class="col-span-full block">
                        <x-button loading="update, logo">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        if (typeof tom_select === 'undefined') {
            const tom_select = new TomSelect('.multiselect', {
                placeholder: 'Select...',
                plugins: {
                    remove_button: {
                        title: 'Remove this item',
                    }
                },
            });
        }

        // Livewire.on('form-updating', () => {
        //     tom_select.disable();
        // })
    </script>
@endpush
