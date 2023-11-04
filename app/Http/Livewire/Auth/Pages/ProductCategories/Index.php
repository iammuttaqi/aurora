<?php

namespace App\Http\Livewire\Auth\Pages\ProductCategories;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $categories = ProductCategory::query()
            ->where('title', 'like', '%' . $this->search . '%')
            ->orWhere('slug', 'like', '%' . $this->search . '%')
            ->orderBy('title', 'asc')
            ->withCount('products')
            ->paginate(100);

        return view('livewire.auth.pages.product-categories.index', compact('categories'));
    }

    public $search;

    public $modal = false;

    public $mode = 'create';

    public $submit = 'store';

    public $form = [
        'title' => null,
        'slug'  => null,
    ];

    protected function rules()
    {
        return [
            'form.title' => 'required',
            'form.slug'  => 'nullable',
        ];
    }

    public function create()
    {
        $this->mode   = 'create';
        $this->submit = 'store';
        $this->reset('form');

        $this->modal = true;
    }

    public function edit($id)
    {
        $this->mode   = 'edit';
        $this->submit = 'update';
        $this->form   = ProductCategory::where('id', $id)->select('id', 'title', 'slug')->first()->toArray();

        $this->modal = true;
    }

    public function store()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            ProductCategory::create($this->form);

            DB::commit();
            $this->dispatch(
                'banner-message',
                style: 'success',
                message: 'Category added.',
            );
            $this->reset('form');
            $this->modal = false;
        } catch (\Throwable $th) {
            DB::rollBack();
            logger(__METHOD__, [$th]);
            $this->dispatch(
                'banner-message',
                style: 'success',
                message: 'Failed.',
            );
            throw $th;
        }
    }

    public function update()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            ProductCategory::where('id', $this->form['id'])->update($this->form);

            DB::commit();
            $this->dispatch(
                'banner-message',
                style: 'success',
                message: 'Category updated.',
            );
            $this->reset('form');
            $this->modal = false;
        } catch (\Throwable $th) {
            DB::rollBack();
            logger(__METHOD__, [$th]);
            $this->dispatch(
                'banner-message',
                style: 'success',
                message: 'Failed.',
            );
            throw $th;
        }
    }

    public function destroy($category_id)
    {
        ProductCategory::where('id', $category_id)->delete();

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: 'Category deleted.',
        );
    }
}
