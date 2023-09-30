<?php

namespace App\Http\Livewire\Frontend\Pages;

use App\Http\Livewire\Frontend\Components\ThankYou;
use App\Models\Package;
use App\Models\PaymentMethod;
use App\Models\PaymentType;
use App\Models\ProfilePackage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Checkout extends Component
{
    public function render()
    {
        $package_id = session('package_id');
        $package    = Package::where('id', $package_id)->first();

        return view('livewire.frontend.pages.checkout', compact('package'));
    }

    public function mount()
    {
        $this->payment_types = PaymentType::all();
    }

    public function fetchPaymentMethods()
    {
        $this->payment_methods           = PaymentMethod::where('payment_type_id', $this->form['payment_type_id'])->get();
        $this->form['payment_method_id'] = null;
    }

    public $form = [
        'payment_type_id'   => 1,
        'payment_method_id' => null,
        'account_number'    => null,
        'pin'               => null,
    ];

    public $payment_types = null;

    public $payment_methods = null;

    public function validationAttributes()
    {
        return [
            'form.payment_type_id'   => 'Payment Type',
            'form.payment_method_id' => 'Payment Method',
            'form.account_number'    => 'Account Number/Card Number',
            'form.pin'               => 'PIN',
        ];
    }

    protected function rules()
    {
        $payment_methods = PaymentMethod::pluck('id')->toArray();

        return [
            'form.payment_type_id'   => ['required', 'integer', Rule::in($this->payment_types->pluck('id')->toArray())],
            'form.payment_method_id' => ['required', 'integer', Rule::in($payment_methods)],
            'form.account_number'    => ['required', 'string'],
            'form.pin'               => ['required', 'string'],
        ];
    }

    public function label($field)
    {
        return isset($this->validationAttributes()[$field]) ? $this->validationAttributes()[$field] : null;
    }

    public function required($field)
    {
        if (isset($this->rules()[$field])) {
            return $this->rules()[$field] && in_array('required', $this->rules()[$field]);
        }
    }

    public function store()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $package_id = session('package_id');
            Package::findOrFail($package_id);

            ProfilePackage::create([
                'profile_id' => auth()->user()->profile->id,
                'package_id' => $package_id,
            ]);

            DB::commit();
            $this->reset();
            session()->forget('package_id');
            $this->redirect(ThankYou::class, navigate: true);
        } catch (\Throwable $th) {
            DB::rollBack();
            logger(__METHOD__, [$th]);
            throw $th;
        }
    }
}
