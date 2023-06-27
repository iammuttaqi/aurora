<?php

namespace App\Http\Livewire\Auth\Pages;

use App\Models\Profile as ModelsProfile;
use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        // $profile = ModelsProfile::with('user.role')->first();
        return view('livewire.auth.pages.profile');
    }

    public $form = [
        'name'  => null,
        'email' => null,
    ];

    protected $validationAttributes = [
        'form.name'  => 'Name',
        'form.email' => 'Email',
    ];

    protected $rules = [
        'form.name'  => 'required',
        'form.email' => 'required',
    ];

    public function label($field)
    {
        return isset($this->validationAttributes[$field]) ? $this->validationAttributes[$field] : null;
    }

    public function required($field)
    {
        return isset($this->rules[$field]) && str()->contains($this->rules[$field], 'required');
    }

    public function store()
    {
        sleep(10);
        dd(1);
    }
}
