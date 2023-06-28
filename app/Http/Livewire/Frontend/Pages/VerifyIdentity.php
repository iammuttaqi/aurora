<?php

namespace App\Http\Livewire\Frontend\Pages;

use App\Models\Profile;
use Livewire\Component;

class VerifyIdentity extends Component
{
    public $username = null;

    public function mount($username)
    {
        $this->$username = $username;
    }

    public function render()
    {
        $profile = Profile::where('username', $this->username)->where('approved', true)->first();

        return view('livewire.frontend.pages.verify-identity', compact('profile'));
    }
}
