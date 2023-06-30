<?php

namespace App\Http\Livewire\Auth\Pages\Partners;

use App\Models\Profile;
use App\Models\Role;
use App\Notifications\User\ProfileApproveNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Index extends Component
{
    use AuthorizesRequests;

    public $search = null;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function render(Request $request)
    {
        $partners = Profile::where('name', 'like', '%' . $request->search . '%')
            ->with('user.role')
            ->paginate()
            ->withQueryString();

        return view('livewire.auth.pages.partners.index', compact('partners'));
    }

    public function approve($partner_id)
    {
        DB::beginTransaction();

        try {
            $profile = Profile::where('id', $partner_id)
                ->whereNotNull('username')
                ->where('approved', 0)
                ->where('qr_code', null)
                ->with('user')
                ->whereHas('user.role', function ($query) {
                    return $query->whereIn('slug', Role::slugsInArray('user'));
                })
                ->first();

            $this->authorize('approvable', $profile);

            $qr_code = $this->generateQrCode($profile);
            if ($profile && $qr_code) {
                $profile->approved = 1;
                $profile->qr_code  = $qr_code;
                $profile->save();
            }

            $profile->user->notify(new ProfileApproveNotification($profile));

            DB::commit();
            // $this->skipRender();
            $this->emit('notificationsUpdated');
            $this->dispatchBrowserEvent('banner-message', [
                'style'   => 'success',
                'message' => 'Partner Approved and QR Code Assigned.',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            logger(__METHOD__, [$th]);
            $this->dispatchBrowserEvent('banner-message', [
                'style'   => 'danger',
                'message' => 'Failed.',
            ]);
            throw $th;
        }
    }

    private function generateQrCode($profile)
    {
        try {
            if ($profile->username) {
                $url = URL::signedRoute('verify_identity', $profile->username);

                return QrCode::size(500)->generate($url);
            }
        } catch (\Throwable $th) {
            logger(__METHOD__, [$th]);

            return null;
            throw $th;
        }
    }
}
