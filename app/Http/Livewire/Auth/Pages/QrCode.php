<?php

namespace App\Http\Livewire\Auth\Pages;

use App\Models\Profile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class QrCode extends Component
{
    use AuthorizesRequests;

    public $qr_code = null;

    public function mount($username = null)
    {
        $profile = $username ? Profile::where('username', $username)->first() : auth()->user()->profile;
        $this->authorize('qrCode', $profile);
        $this->qr_code = $profile->whereNotNull('username')->whereNotNull('qr_code')->value('qr_code');
    }

    public function render()
    {
        return view('livewire.auth.pages.qr-code');
    }
}
