<?php

namespace App\Http\Livewire\Auth\Pages\QrCode;

use App\Models\Profile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Index extends Component
{
    use AuthorizesRequests;

    public $username = null;

    public function mount($username = null)
    {
        $this->username = $username ?? auth()->user()->profile->username;
        $profile = Profile::where('username', $this->username)->first();
        $this->authorize('qrCode', $profile);
    }

    public function render()
    {
        $profile = Profile::where('username', $this->username)->whereNotNull('qr_code')->first();

        return view('livewire.auth.pages.qr-code.index', compact('profile'));
    }

    public function download($username)
    {
        $profile = Profile::where('username', $username)->first();

        return response()
            ->stream(function () use ($profile) {
                echo $profile->qr_code;
            }, 200, [
                'Content-Type' => 'image/svg+xml',
                'Content-Disposition' => 'attachment; filename="' . $profile->username . '.svg"'
            ]);
    }
}
