<?php

namespace App\Http\Livewire\Auth\Pages\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        $warranty_period_units = [
            [
                'title' => 'Days',
                'slug'  => 'days',
            ],
            [
                'title' => 'Weeks',
                'slug'  => 'weeks',
            ],
            [
                'title' => 'Months',
                'slug'  => 'months',
            ],
            [
                'title' => 'Years',
                'slug'  => 'years',
            ],
        ];
        $product_categories = ProductCategory::all();

        return view('livewire.auth.pages.products.create', compact('warranty_period_units', 'product_categories'));
    }

    public $form = [
        'profile_id'           => null,
        'product_category_id'  => null,
        'title'                => null,
        'description'          => null,
        'price'                => null,
        'image'                => null,
        'serial_number'        => null,
        'qr_code'              => null,
        'warranty_period'      => null,
        'warranty_period_unit' => null,
    ];

    protected $validationAttributes = [
        'form.profile_id'           => 'Manufacturer',
        'form.product_category_id'  => 'Product Category',
        'form.title'                => 'Product Title',
        'form.description'          => 'Product Description',
        'form.price'                => 'Product Price',
        'form.image'                => 'Product Image',
        'form.serial_number'        => 'Serial Number',
        'form.qr_code'              => 'QR Code',
        'form.warranty_period'      => 'Warranty Period',
        'form.warranty_period_unit' => 'Warranty Period Unit',
    ];

    protected function rules()
    {
        return [
            'form.product_category_id'  => ['required', 'integer', 'exists:product_categories,id'],
            'form.title'                => ['required', 'string', 'max:255'],
            'form.description'          => ['required', 'string'],
            'form.price'                => ['required', 'numeric'],
            'form.image'                => ['nullable', 'image'],
            'form.warranty_period'      => ['required', 'integer'],
            'form.warranty_period_unit' => ['required', 'string', Rule::in(['days', 'weeks', 'months', 'years'])],
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

    public function store()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            if (auth()->user()->profile) {
                $this->form['profile_id'] = auth()->user()->profile->id;
                $product                  = Product::create($this->form);

                ProductProfile::create([
                    'product_id' => $product->id,
                    'profile_id' => $product->profile_id,
                ]);

                DB::commit();
                $this->reset('form');
                $this->dispatchBrowserEvent('banner-message', [
                    'style'   => 'success',
                    'message' => 'Product created.',
                ]);
            } else {
                abort(404);
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
