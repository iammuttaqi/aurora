<?php

namespace App\Http\Livewire\Auth\Pages\Partners;

use App\Models\Profile;
use App\Models\Role;
use App\Notifications\User\ProfileApproveNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Livewire\WithPagination;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Index extends Component
{
    use AuthorizesRequests, WithPagination;

    public $search = null;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function render()
    {
        $partners = Profile::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('username', 'like', '%' . $this->search . '%')
            ->has('user')
            ->with('user.role')
            ->latest()
            ->paginate(100);

        return view('livewire.auth.pages.partners.index', compact('partners'));
    }

    public function updating()
    {
        $this->resetPage();
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
                $profile->update([
                    'qr_code'  => $qr_code,
                    'approved' => 1,
                ]);
            }

            $profile->user->notify(new ProfileApproveNotification($profile));

            DB::commit();
            $this->dispatch('notificationsUpdated');
            $this->dispatch(
                'banner-message',
                style: 'success',
                message: 'Partner Approved and QR Code Assigned.',
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            logger(__METHOD__, [$th]);
            $this->dispatch(
                'banner-message',
                style: 'danger',
                message: 'Failed.',
            );
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
