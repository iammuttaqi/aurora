<?php

namespace App\Http\Livewire\Auth\Pages\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public function render()
    {
        $product_categories = ProductCategory::all();

        return view('livewire.auth.pages.products.edit', compact('product_categories'));
    }

    public function mount($serial_number)
    {
        $this->form = Product::where('serial_number', $serial_number)->first()->toArray();
    }

    public $warranty_period_units = [
        // [
        //     'title' => 'Days',
        //     'slug'  => 'days',
        // ],
        // [
        //     'title' => 'Weeks',
        //     'slug'  => 'weeks',
        // ],
        [
            'title' => 'Months',
            'slug'  => 'months',
        ],
        [
            'title' => 'Years',
            'slug'  => 'years',
        ],
    ];

    public $form = [
        'profile_id'           => null,
        'product_category_id'  => null,
        'title'                => null,
        'description'          => null,
        'price'                => null,
        'serial_number'        => null,
        'qr_code'              => null,
        'warranty_period'      => 1,
        'warranty_period_unit' => 'years',
    ];

    protected $validationAttributes = [
        'form.profile_id'           => 'Manufacturer',
        'form.product_category_id'  => 'Product Category',
        'form.title'                => 'Product Title',
        'form.description'          => 'Product Description',
        'form.price'                => 'Product Price',
        'form.serial_number'        => 'Serial Number',
        'form.qr_code'              => 'QR Code',
        'form.warranty_period'      => 'Warranty Period',
        'form.warranty_period_unit' => 'Warranty Period Unit',
    ];

    protected function rules()
    {
        $warranty_period_units = collect($this->warranty_period_units)->pluck('slug')->toArray();

        return [
            'form.product_category_id'  => ['required', 'integer', 'exists:product_categories,id'],
            'form.title'                => ['required', 'string', 'max:255'],
            'form.description'          => ['required', 'string'],
            'form.price'                => ['required', 'numeric'],
            'form.warranty_period'      => ['required', 'integer'],
            'form.warranty_period_unit' => ['required', 'string', Rule::in($warranty_period_units)],
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

    public function update()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            if (auth()->user()->profile && $this->form['id']) {
                Product::where('id', $this->form['id'])
                    ->update(collect($this->form)->only('product_category_id', 'title', 'description', 'price', 'warranty_period', 'warranty_period_unit')->toArray());

                DB::commit();
                $this->dispatch(
                    'banner-message',
                    style: 'success',
                    message: 'Product updated.',
                );
            } else {
                abort(404);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            logger(__METHOD__, [$th]);
            $this->dispatch(
                'banner-message',
                style: 'danger',
                message: 'Failed.',
            );
            throw $th;
        }
    }
}
