<?php

namespace App\Http\Livewire\Auth\Pages\Cities;

use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $cities = City::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('name', 'asc')
            ->withCount('profiles')
            ->paginate(100);
        $countries = Country::all();

        return view('livewire.auth.pages.cities.index', compact('cities', 'countries'));
    }

    public $search;

    public $modal = false;

    public $mode = 'create';

    public $submit = 'store';

    public $form = [
        'name'       => null,
        'country_id' => null,
    ];

    protected function rules()
    {
        return [
            'form.name'       => 'required',
            'form.country_id' => 'required',
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
        $this->form   = City::where('id', $id)->select('id', 'name', 'country_id')->first()->toArray();

        $this->modal = true;
    }

    public function store()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            City::create($this->form);

            DB::commit();
            $this->dispatch(
                'banner-message',
                style: 'success',
                message: 'City added.',
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
            City::where('id', $this->form['id'])->update($this->form);

            DB::commit();
            $this->dispatch(
                'banner-message',
                style: 'success',
                message: 'City updated.',
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
        City::where('id', $category_id)->delete();

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: 'City deleted.',
        );
    }
}
