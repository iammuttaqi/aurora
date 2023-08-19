<?php

namespace App\Http\Livewire\Auth\Components;

use App\Models\Country;
use App\Models\Customer;
use App\Models\ProductCustomer;
use App\Notifications\User\ShopProductSoldNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CustomerForm extends Component
{
    public $form = [
        'profile_id'   => null,
        'name'         => null,
        'phone_number' => null,
        'email'        => null,
        'age'          => null,
        'gender'       => 'Male',
        'address'      => null,
        'city'         => 'Dhaka',
        'country_id'   => 18,
        'notes'        => null,
    ];

    public function mount()
    {
        $this->form['profile_id'] = auth()->user()->profile->id;
    }

    public function render()
    {
        $genders = [
            ['id' => 1, 'title' => 'Male'],
            ['id' => 2, 'title' => 'Female'],
            ['id' => 3, 'title' => 'Other'],
        ];
        $countries = Country::where('id', $this->form['country_id'])->get();

        return view('livewire.auth.components.customer-form', compact('genders', 'countries'));
    }

    protected $validationAttributes = [
        'form.name'         => 'Customer Name',
        'form.phone_number' => 'Phone Number',
        'form.email'        => 'Email',
        'form.age'          => 'Age',
        'form.gender'       => 'Gender',
        'form.address'      => 'Address',
        'form.city'         => 'City',
        'form.country_id'   => 'Country',
        'form.notes'        => 'Notes',
    ];

    protected function rules()
    {
        return [
            'form.profile_id'   => ['required', 'integer', Rule::exists('profiles', 'id')],
            'form.name'         => ['required', 'string', 'max:255'],
            'form.phone_number' => ['required', 'string', 'max:255'],
            'form.email'        => ['nullable', 'string', 'max:255'],
            'form.age'          => ['nullable', 'integer', 'between:1,200'],
            'form.gender'       => ['required', 'string', Rule::in(['Male', 'Female', 'Other'])],
            'form.address'      => ['nullable', 'string'],
            'form.city'         => ['nullable', 'string', 'max:255'],
            'form.country_id'   => ['required', 'integer', Rule::exists('countries', 'id')],
            'form.notes'        => ['nullable', 'string'],
        ];
    }

    public function label($field)
    {
        return isset($this->validationAttributes[$field]) ? $this->validationAttributes[$field] : null;
    }

    public function required($field)
    {
        if (isset($this->rules()[$field])) {
            return $this->rules()[$field] && in_array('required', $this->rules()[$field]);
        }
    }

    public function sell()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $product_ids = session('product_ids');
            if (is_array($product_ids) && count($product_ids)) {
                $customer = Customer::create($this->form);

                $product_customers = [];
                foreach ($product_ids as $key => $product_id) {
                    $product_customer_exists = ProductCustomer::where('product_id', $product_id)->exists();

                    if (!$product_customer_exists) {
                        $product_customers[$key]['product_id']  = $product_id;
                        $product_customers[$key]['customer_id'] = $customer->id;
                        $product_customers[$key]['created_at']  = now();
                        $product_customers[$key]['updated_at']  = now();
                    }
                }

                ProductCustomer::insert($product_customers);

                request()->user()->notify(new ShopProductSoldNotification($customer));

                DB::commit();
                $this->reset();
                session()->forget('product_ids');
                $this->emit('sessionUpdated');
                $this->emit('notificationsUpdated');
                $this->dispatchBrowserEvent('banner-message', [
                    'style'   => 'success',
                    'message' => 'Products Sold to the Selected Customer.',
                ]);
            } else {
                DB::rollBack();
                $this->dispatchBrowserEvent('banner-message', [
                    'style'   => 'danger',
                    'message' => 'No products on the box.',
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            logger(__METHOD__, [$th]);
            $this->dispatchBrowserEvent('banner-message', [
                'style'   => 'danger',
                'message' => 'Failed.',
            ]);
            throw $th;
        }
    }
}
