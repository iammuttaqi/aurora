<?php

namespace App\Http\Livewire\Auth\Pages\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

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

    public function render()
    {
        $product_categories = ProductCategory::all();

        return view('livewire.auth.pages.products.create', compact('product_categories'));
    }

    public $form = [
        'profile_id'           => null,
        'image'                => null,
        'product_category_id'  => null,
        'title'                => null,
        'description'          => null,
        'price'                => null,
        'serial_number'        => null,
        'qr_code'              => null,
        'warranty_period'      => 1,
        'warranty_period_unit' => 'years',
    ];

    public $product_count = 1;

    public $product_count_max = 50;

    public $product_count_min = 1;

    protected $validationAttributes = [
        'form.profile_id'           => 'Manufacturer',
        'form.image'                => 'Product Image',
        'form.product_category_id'  => 'Product Category',
        'form.title'                => 'Product Title',
        'form.description'          => 'Product Description',
        'form.price'                => 'Product Price',
        'form.serial_number'        => 'Serial Number',
        'form.qr_code'              => 'QR Code',
        'form.warranty_period'      => 'Warranty Period',
        'form.warranty_period_unit' => 'Warranty Period Unit',
        'product_count'             => 'Product Count',
    ];

    protected function rules()
    {
        $warranty_period_units = collect($this->warranty_period_units)->pluck('slug')->toArray();

        return [
            'form.image'                => ['nullable', 'image'],
            'form.product_category_id'  => ['required', 'integer', 'exists:product_categories,id'],
            'form.title'                => ['required', 'string', 'max:255'],
            'form.description'          => ['required', 'string'],
            'form.price'                => ['required', 'numeric'],
            'form.warranty_period'      => ['required', 'integer'],
            'form.warranty_period_unit' => ['required', 'string', Rule::in($warranty_period_units)],
            'product_count'             => ['required', 'integer', 'min:' . $this->product_count_min, 'max:' . $this->product_count_max],
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

                if ($this->form['image']) {
                    $filename = 'products/product-' . time() . rand() . '.webp';
                    $this->form['image']->storeAs('public', $filename);
                    $this->form['image'] = 'storage/' . $filename;
                }

                foreach (range(1, $this->product_count) as $key => $range) {
                    $product = Product::create($this->form);

                    ProductProfile::create([
                        'product_id' => $product->id,
                        'profile_id' => $product->profile_id,
                    ]);
                }

                DB::commit();
                $this->reset('form', 'product_count');
                $this->dispatch(
                    'banner-message',
                    style: 'success',
                    message: 'Product created.',
                );
                $this->redirect(Index::class, navigate: true);
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
