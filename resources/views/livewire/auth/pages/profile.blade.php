@push('title', 'Profile')

@push('cdn')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endpush

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                <form class="grid grid-cols-1 gap-5 p-5 md:grid-cols-12" wire:submit.prevent="update" x-data="{
                    form: {
                        email_1: @entangle('form.email_1').defer,
                        email_2: @entangle('form.email_2').defer,
                        email_3: @entangle('form.email_3').defer,
                        website: @entangle('form.website').defer,
                        map_link: @entangle('form.map_link').defer,
                        facebook: @entangle('form.facebook').defer,
                        instagram: @entangle('form.instagram').defer,
                        twitter: @entangle('form.twitter').defer,
                        linkedin: @entangle('form.linkedin').defer,
                        general_manager_email: @entangle('form.general_manager_email').defer,
                        sales_manager_email: @entangle('form.sales_manager_email').defer,
                        hr_manager_email: @entangle('form.hr_manager_email').defer,
                        it_manager_email: @entangle('form.it_manager_email').defer,
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
                    <div class="col-span-full flex flex-col gap-1">
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
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.name')" for="name" />
                        <x-input :required="$this->required('form.name')" :placeholder="$this->label('form.name')" autofocus class="block w-full" id="name" name="name" type="text" wire:model.defer="form.name" />
                        <x-input-error for="form.name" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.contact_person')" for="contact_person" />
                        <x-input :required="$this->required('form.contact_person')" :placeholder="$this->label('form.contact_person')" class="block w-full" id="contact_person" name="contact_person" type="text" wire:model.defer="form.contact_person" />
                        <x-input-error for="form.contact_person" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.address')" for="address" />
                        <x-input :required="$this->required('form.address')" :placeholder="$this->label('form.address')" class="block w-full" id="address" name="address" type="text" wire:model.defer="form.address" />
                        <x-input-error for="form.address" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.city_id')" for="city_id" />
                        <x-select :value="old('form.city_id')" :options="$cities" class="block w-full" default="Select City..." id="city_id" name="city_id" required value_key="name" wire:model.defer="form.city_id"></x-select>
                        <x-input-error for="form.city_id" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-4">
                        <x-label :value="$this->label('form.contact_number_1')" for="contact_number_1" />
                        <div class="relative">
                            <i class="bi bi-telephone-fill pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :required="$this->required('form.contact_number_1')" :placeholder="$this->label('form.contact_number_1')" class="block w-full pl-10" id="contact_number_1" name="contact_number_1" type="text" wire:model.defer="form.contact_number_1" />
                        </div>
                        <x-input-error for="form.contact_number_1" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-4">
                        <x-label :value="$this->label('form.contact_number_2')" for="contact_number_2" />
                        <div class="relative">
                            <i class="bi bi-telephone-fill pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :required="$this->required('form.contact_number_2')" :placeholder="$this->label('form.contact_number_2')" class="block w-full pl-10" id="contact_number_2" name="contact_number_2" type="text" wire:model.defer="form.contact_number_2" />
                        </div>
                        <x-input-error for="form.contact_number_2" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-4">
                        <x-label :value="$this->label('form.contact_number_3')" for="contact_number_3" />
                        <div class="relative">
                            <i class="bi bi-telephone-fill pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :required="$this->required('form.contact_number_3')" :placeholder="$this->label('form.contact_number_3')" class="block w-full pl-10" id="contact_number_3" name="contact_number_3" type="text" wire:model.defer="form.contact_number_3" />
                        </div>
                        <x-input-error for="form.contact_number_3" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-4">
                        <x-label :value="$this->label('form.email_1')" for="email_1" />
                        <div class="relative">
                            <i class="bi bi-envelope-fill pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :required="$this->required('form.email_1')" :placeholder="$this->label('form.email_1')" class="block w-full pl-10" id="email_1" name="email_1" type="email" wire:model.defer="form.email_1" x-model="form.email_1" />
                        </div>
                        <x-input-error for="form.email_1" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-4">
                        <x-label :value="$this->label('form.email_2')" for="email_2" />
                        <div class="relative">
                            <i class="bi bi-envelope-fill pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :required="$this->required('form.email_2')" :placeholder="$this->label('form.email_2')" class="block w-full pl-10" id="email_2" name="email_2" type="email" wire:model.defer="form.email_2" x-model="form.email_2" />
                        </div>
                        <x-input-error for="form.email_2" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-4">
                        <x-label :value="$this->label('form.email_3')" for="email_3" />
                        <div class="relative">
                            <i class="bi bi-envelope-fill pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :required="$this->required('form.email_3')" :placeholder="$this->label('form.email_3')" class="block w-full pl-10" id="email_3" name="email_3" type="email" wire:model.defer="form.email_3" x-model="form.email_3" />
                        </div>
                        <x-input-error for="form.email_3" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-12">
                        <x-label :value="$this->label('form.about')" for="about" />
                        <x-textarea :required="$this->required('form.about')" :placeholder="$this->label('form.about')" class="block w-full" id="about" name="about" rows="5" type="text" wire:model.defer="form.about" />
                        <x-input-error for="form.about" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.website')" for="website" />
                        <div class="relative">
                            <i class="bi bi-globe2 pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :required="$this->required('form.website')" :placeholder="$this->label('form.website')" class="block w-full pl-10" id="website" name="website" type="url" wire:model.defer="form.website" x-model="form.website" />
                        </div>
                        <x-input-error for="form.website" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.map_link')" for="map_link" />
                        <div class="relative">
                            <i class="bi bi-geo-alt-fill pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 dark:text-white"></i>
                            <x-input :required="$this->required('form.map_link')" :placeholder="$this->label('form.map_link')" class="block w-full pl-10" id="map_link" name="map_link" type="url" wire:model.defer="form.map_link" x-model="form.map_link" />
                        </div>
                        <x-input-error for="form.map_link" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.facebook')" for="facebook" />
                        <div class="relative">
                            <i class="bi bi-facebook pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-blue-500"></i>
                            <x-input :required="$this->required('form.facebook')" :placeholder="$this->label('form.facebook')" class="block w-full pl-10" name="facebook" pattern="{{ $social_links_patterns['facebook'] }}" type="url" wire:model.defer="form.facebook" x-model="form.facebook" />
                        </div>
                        <x-input-error for="form.facebook" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.instagram')" for="instagram" />
                        <div class="relative">
                            <i class="bi bi-instagram pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-pink-500"></i>
                            <x-input :required="$this->required('form.instagram')" :placeholder="$this->label('form.instagram')" class="block w-full pl-10" id="instagram" name="instagram" pattern="{{ $social_links_patterns['instagram'] }}" type="url" wire:model.defer="form.instagram" x-model="form.instagram" />
                        </div>
                        <x-input-error for="form.instagram" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.twitter')" for="twitter" />
                        <div class="relative">
                            <i class="bi bi-twitter pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-blue-500"></i>
                            <x-input :required="$this->required('form.twitter')" :placeholder="$this->label('form.twitter')" class="block w-full pl-10" id="twitter" name="twitter" pattern="{{ $social_links_patterns['twitter'] }}" type="url" wire:model.defer="form.twitter" x-model="form.twitter" />
                        </div>
                        <x-input-error for="form.twitter" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.linkedin')" for="linkedin" />
                        <div class="relative">
                            <i class="bi bi-linkedin pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-sky-600"></i>
                            <x-input :required="$this->required('form.linkedin')" :placeholder="$this->label('form.linkedin')" class="block w-full pl-10" id="linkedin" name="linkedin" pattern="{{ $social_links_patterns['linkedin'] }}" type="url" wire:model.defer="form.linkedin" x-model="form.linkedin" />
                        </div>
                        <x-input-error for="form.linkedin" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-4" wire:ignore>
                        <x-label :value="$this->label('form.category_ids')" for="category_ids" />
                        <select class="multiselect" multiple name="category_ids[]" wire:model.defer="form.category_ids">
                            @foreach ($categories as $category)
                                <option {{ isset($form['category_ids']) && $form['category_ids'] && in_array($category->id, $form['category_ids']) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="form.category_ids" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-4">
                        <x-label :value="$this->label('form.tax_number')" for="tax_number" />
                        <x-input :required="$this->required('form.tax_number')" :placeholder="$this->label('form.tax_number')" class="block w-full" id="tax_number" name="tax_number" type="text" wire:model.defer="form.tax_number" />
                        <x-input-error for="form.tax_number" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-4">
                        <x-label :value="$this->label('form.vat_number')" for="vat_number" />
                        <x-input :required="$this->required('form.vat_number')" :placeholder="$this->label('form.vat_number')" class="block w-full" id="vat_number" name="vat_number" type="text" wire:model.defer="form.vat_number" />
                        <x-input-error for="form.vat_number" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1">
                        <x-label :value="$this->label('form.employee_range_id')" for="employee_range_id" />
                        <x-radio-advanced :options="$employee_ranges" id="employee_range_id" name="employee_range_id" wire:model.defer="form.employee_range_id" />
                        <x-input-error for="form.employee_range_id" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.business_license')" for="business_license" />
                        <x-textarea :required="$this->required('form.business_license')" :placeholder="$this->label('form.business_license')" class="block w-full" id="business_license" name="business_license" rows="5" type="text" wire:model.defer="form.business_license" />
                        <x-input-error for="form.business_license" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.payment_terms')" for="payment_terms" />
                        <x-textarea :required="$this->required('form.payment_terms')" :placeholder="$this->label('form.payment_terms')" class="block w-full" id="payment_terms" name="payment_terms" rows="5" type="text" wire:model.defer="form.payment_terms" />
                        <x-input-error for="form.payment_terms" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.shipping_options')" for="shipping_options" />
                        <x-textarea :required="$this->required('form.shipping_options')" :placeholder="$this->label('form.shipping_options')" class="block w-full" id="shipping_options" name="shipping_options" rows="5" type="text" wire:model.defer="form.shipping_options" />
                        <x-input-error for="form.shipping_options" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.additional_information')" for="additional_information" />
                        <x-textarea :required="$this->required('form.additional_information')" :placeholder="$this->label('form.additional_information')" class="block w-full" id="additional_information" name="additional_information" rows="5" type="text" wire:model.defer="form.additional_information" />
                        <x-input-error for="form.additional_information" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.general_manager_name')" for="general_manager_name" />
                        <x-input :required="$this->required('form.general_manager_name')" :placeholder="$this->label('form.general_manager_name')" class="block w-full" id="general_manager_name" name="general_manager_name" type="text" wire:model.defer="form.general_manager_name" />
                        <x-input-error for="form.general_manager_name" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.general_manager_email')" for="general_manager_email" />
                        <x-input :required="$this->required('form.general_manager_email')" :placeholder="$this->label('form.general_manager_email')" class="block w-full" id="general_manager_email" name="general_manager_email" type="email" wire:model.defer="form.general_manager_email" x-model="form.general_manager_email" />
                        <x-input-error for="form.general_manager_email" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.sales_manager_name')" for="sales_manager_name" />
                        <x-input :required="$this->required('form.sales_manager_name')" :placeholder="$this->label('form.sales_manager_name')" class="block w-full" id="sales_manager_name" name="sales_manager_name" type="text" wire:model.defer="form.sales_manager_name" />
                        <x-input-error for="form.sales_manager_name" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.sales_manager_email')" for="sales_manager_email" />
                        <x-input :required="$this->required('form.sales_manager_email')" :placeholder="$this->label('form.sales_manager_email')" class="block w-full" id="sales_manager_email" name="sales_manager_email" type="email" wire:model.defer="form.sales_manager_email" x-model="form.sales_manager_email" />
                        <x-input-error for="form.sales_manager_email" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.hr_manager_name')" for="hr_manager_name" />
                        <x-input :required="$this->required('form.hr_manager_name')" :placeholder="$this->label('form.hr_manager_name')" class="block w-full" id="hr_manager_name" name="hr_manager_name" type="text" wire:model.defer="form.hr_manager_name" />
                        <x-input-error for="form.hr_manager_name" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.hr_manager_email')" for="hr_manager_email" />
                        <x-input :required="$this->required('form.hr_manager_email')" :placeholder="$this->label('form.hr_manager_email')" class="block w-full" id="hr_manager_email" name="hr_manager_email" type="email" wire:model.defer="form.hr_manager_email" x-model="form.hr_manager_email" />
                        <x-input-error for="form.hr_manager_email" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.it_manager_name')" for="it_manager_name" />
                        <x-input :required="$this->required('form.it_manager_name')" :placeholder="$this->label('form.it_manager_name')" class="block w-full" id="it_manager_name" name="it_manager_name" type="text" wire:model.defer="form.it_manager_name" />
                        <x-input-error for="form.it_manager_name" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.it_manager_email')" for="it_manager_email" />
                        <x-input :required="$this->required('form.it_manager_email')" :placeholder="$this->label('form.it_manager_email')" class="block w-full" id="it_manager_email" name="it_manager_email" type="email" wire:model.defer="form.it_manager_email" x-model="form.it_manager_email" />
                        <x-input-error for="form.it_manager_email" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.manufacturing_capabilities')" for="manufacturing_capabilities" />
                        <x-textarea :required="$this->required('form.manufacturing_capabilities')" :placeholder="$this->label('form.manufacturing_capabilities')" class="block w-full" id="manufacturing_capabilities" name="manufacturing_capabilities" rows="5" type="text" wire:model.defer="form.manufacturing_capabilities" />
                        <x-input-error for="form.manufacturing_capabilities" />
                    </div>

                    <div class="col-span-full flex flex-col gap-1 sm:col-span-6 lg:col-span-6">
                        <x-label :value="$this->label('form.certifications')" for="certifications" />
                        <x-textarea :required="$this->required('form.certifications')" :placeholder="$this->label('form.certifications')" class="block w-full" id="certifications" name="certifications" rows="5" wire:model.defer="form.certifications" />
                        <x-input-error for="form.certifications" />
                    </div>

                    <div class="col-span-full block">
                        <x-button wire:loading.attr="disabled" wire:target="update">
                            <div aria-label="loading" class="mr-2 inline-block h-4 w-4 animate-spin rounded-full border-[3px] border-current border-t-transparent text-white dark:text-gray-800" role="status" wire:loading wire:target="update">
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

@push('scripts')
    <script>
        new TomSelect('.multiselect', {
            placeholder: 'Select...',
            plugins: {
                remove_button: {
                    title: 'Remove this item',
                }
            },
        });
    </script>
@endpush
