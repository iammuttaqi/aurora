<?php

namespace App\Http\Livewire\Auth\Pages\QrCode;

use App\Models\Profile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Index extends Component
{
    use AuthorizesRequests;

    public $qr_code = null;
    public $profile = null;

    public function mount($username = null)
    {
        $this->profile = $username ? Profile::where('username', $username)->first() : auth()->user()->profile;
        $this->authorize('qrCode', $this->profile);
        $this->qr_code = $this->profile->whereNotNull('username')->whereNotNull('qr_code')->value('qr_code');
    }

    public function render()
    {
        return view('livewire.auth.pages.qr-code.index');
    }

    public function download()
    {
        $svg = $this->qr_code;

        return response()
            ->stream(function () use ($svg) {
                echo $svg;
            }, 200, [
                'Content-Type' => 'image/svg+xml',
                'Content-Disposition' => 'attachment; filename="' . $this->profile->username . '.svg"'
            ]);
    }
}
