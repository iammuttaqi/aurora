<?php

namespace App\Http\Livewire\Auth\Pages\Products;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $products = Product::where('manufacturer_id', auth()->user()->profile->id)->latest()->paginate(10);

        return view('livewire.auth.pages.products.index', compact('products'));
    }

    public function destroy($serial_number)
    {
        Product::where('serial_number', $serial_number)->delete();
        $this->dispatchBrowserEvent('banner-message', [
            'style'   => 'success',
            'message' => 'Product Deleted.',
        ]);
    }

    public function duplicate($serial_number)
    {
        $product = Product::where('serial_number', $serial_number)->first();
        $new_product = $product->replicate();
        $new_product->image = null;
        $new_product->serial_number = null;
        $new_product->qr_code = null;
        $new_product->save();

        $this->dispatchBrowserEvent('banner-message', [
            'style'   => 'success',
            'message' => 'Product Deleted.',
        ]);
    }

    public $multi_duplicate_modal_open = false;
    public $multi_duplicate_count = 1;
    public $multi_duplicate_serial_number = null;

    public function duplicateMultiple()
    {
        DB::beginTransaction();
        try {
            if ($this->multi_duplicate_count && $this->multi_duplicate_serial_number) {
                foreach (range(1, $this->multi_duplicate_count) as $key => $range) {
                    $product = Product::where('serial_number', $this->multi_duplicate_serial_number)->first();
                    $new_product = $product->replicate();
                    $new_product->image = null;
                    $new_product->serial_number = null;
                    $new_product->qr_code = null;
                    $new_product->save();
                }

                DB::commit();
                $this->reset();
                $this->dispatchBrowserEvent('banner-message', [
                    'style'   => 'success',
                    'message' => 'Product Duplicated.',
                ]);
            } else {
                $this->dispatchBrowserEvent('banner-message', [
                    'style'   => 'danger',
                    'message' => 'No product selected to duplicate.',
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
