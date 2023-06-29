<?php

namespace App\Http\Livewire\Auth\Pages;

use App\Models\Profile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode as FacadesQrCode;

class QrCode extends Component
{
    use AuthorizesRequests;

    public $qr_code = null;

    public function mount()
    {
        $profile = auth()->user()->profile;
        $this->authorize('qrCode', $profile);
        $this->qr_code = $profile->whereNotNull('username')->whereNotNull('qr_code')->value('qr_code');
    }

    public function render()
    {
        return view('livewire.auth.pages.qr-code');
    }
}
