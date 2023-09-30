@push('title', 'Checkout')

<div>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                <div class="py-12">
                    <h3 class="text-center text-3xl font-bold">Checkout</h3>

                    @if ($package)
                        <div class="grid grid-cols-1 gap-10 p-5 sm:grid-cols-3">
                            <form class="col-span-2" wire:submit="store">
                                <div class="flex grid-cols-2 flex-col gap-5 md:grid">
                                    <div class="col-span-2 space-y-1" wire:init="fetchPaymentMethods">
                                        <x-label :value="$this->label('form.payment_type_id')" :required="$this->required('form.payment_type_id')" />
                                        <x-radio-advanced :options="$payment_types" class="grid-cols-3" id="payment_type_id" key="id" name="payment_type_id" value_key="title" wire:change="fetchPaymentMethods" wire:model="form.payment_type_id" />
                                        <x-input-error for="form.payment_type_id" />
                                    </div>

                                    <div class="col-span-2 space-y-1">
                                        <x-label :value="$this->label('form.payment_method_id')" :required="$this->required('form.payment_method_id')" />
                                        <x-radio-advanced :options="$payment_methods" class="grid-cols-4" id="payment_method_id" key="id" name="payment_method_id" value_key="title" wire:loading.remove wire:model="form.payment_method_id" wire:target="fetchPaymentMethods" />
                                        <x-radio-advanced-loading wire:loading wire:loading.class="!grid" wire:target="fetchPaymentMethods" />
                                        <x-input-error for="form.payment_method_id" />
                                    </div>

                                    <div class="col-span-1 space-y-1">
                                        <x-label value="{{ $this->label('form.account_number') }}" />
                                        <x-input :required="$this->required('form.account_number')" :placeholder="$this->label('form.account_number')" class="block w-full" type="tel" wire:loading.attr="disabled" wire:model="form.account_number" wire:target="fetchPaymentMethods" />
                                        <x-input-error for="form.account_number" />
                                    </div>

                                    <div class="col-span-1 space-y-1" x-data="{ pin: true }">
                                        <x-label value="{{ $this->label('form.pin') }}" />
                                        <div class="relative">
                                            <x-input :required="$this->required('form.pin')" :placeholder="$this->label('form.pin')" class="block w-full" required wire:model="form.pin" x-bind:type="pin ? 'password' : 'text'" />
                                            <div class="absolute inset-y-0 right-0 z-20 flex items-center pr-4">
                                                <button type="button" x-on:click="pin = !pin">
                                                    <i class="bi bi-eye-fill text-lg text-indigo-500" x-show="pin"></i>
                                                    <i class="bi bi-eye-slash-fill text-lg text-indigo-500" x-show="!pin"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <x-input-error for="form.pin" />
                                    </div>

                                    <div class="col-span-full space-y-1">
                                        <x-button loading="sell, fetchPaymentMethods">
                                            {{ __('Pay') }}
                                        </x-button>
                                    </div>
                                </div>
                            </form>

                            <div class="col-span-1 space-y-1">
                                <x-label value="Your Selected Plan" />
                                <livewire:frontend.components.pricing-card :package_id="$package->id" :purchaseable="false" />
                            </div>
                        </div>
                    @else
                        <div class="p-10 text-center text-red-500">No package selected</div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
