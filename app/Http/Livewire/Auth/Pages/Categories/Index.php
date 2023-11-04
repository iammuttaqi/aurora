<?php

namespace App\Http\Livewire\Auth\Pages\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $categories = Category::query()
            ->where('title', 'like', '%' . $this->search . '%')
            ->orWhere('slug', 'like', '%' . $this->search . '%')
            ->orderBy('title', 'asc')
            ->paginate(100);

        return view('livewire.auth.pages.categories.index', compact('categories'));
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
        $this->form   = Category::where('id', $id)->select('id', 'title', 'slug')->first()->toArray();

        $this->modal = true;
    }

    public function store()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            Category::create($this->form);

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
            Category::where('id', $this->form['id'])->update($this->form);

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
        Category::where('id', $category_id)->delete();

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: 'Category deleted.',
        );
    }
}
