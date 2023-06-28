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
        $this->authorize('viewAny', Profile::class);

        $this->qr_code = Profile::where('user_id', auth()->user()->id)
            ->whereNotNull('username')
            ->whereNotNull('qr_code')
            ->value('qr_code');
    }

    public function render()
    {
        return view('livewire.auth.pages.qr-code');
    }

    public function update()
    {
        DB::beginTransaction();

        try {
            $profile = Profile::where('user_id', auth()->user()->id)->firstOrFail();

            if ($profile && $profile->username) {
                $profile->qr_code = FacadesQrCode::size(500)->generate(URL::signedRoute('verify_identity', $profile->username));
                $profile->save();

                DB::commit();
                $this->mount();
                $this->dispatchBrowserEvent('banner-message', [
                    'style'   => 'success',
                    'message' => 'New QR Code Generated!',
                ]);
            } else {
                DB::rollBack();
                $this->dispatchBrowserEvent('banner-message', [
                    'style'   => 'danger',
                    'message' => 'Profile or Username not found.',
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            logger(__METHOD__, [$th]);
            $this->dispatchBrowserEvent('banner-message', [
                'style'   => 'danger',
                'message' => 'Something went wrong.',
            ]);
            throw $th;
        }
    }
}
