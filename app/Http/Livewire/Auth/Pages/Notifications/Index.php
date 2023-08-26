<?php

namespace App\Http\Livewire\Auth\Pages\Notifications;

use App\Traits\NotificationsTrait;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use NotificationsTrait, WithPagination;

    public $search = '';

    public $check_all = false;

    public $checks = [];

    public function render()
    {
        $notifications = request()->user()->notifications()->latest()->paginate(50);

        foreach ($notifications as $key => $notification) {
            $notification->message = $this->getMessage($notification);
        }

        return view('livewire.auth.pages.notifications.index', compact('notifications'));
    }

    public function mark($type)
    {
        if ($type) {
            request()->user()->notifications->whereIn('id', $this->checks)->markAsRead();

            $this->check_all = false;
            $this->checks    = [];

            $this->dispatch(
                'banner-message',
                style: 'success',
                message: 'Marked As Read.',
            );
        } else {
            foreach (request()->user()->notifications->whereIn('id', $this->checks) as $key => $notification) {
                $notification->update(['read_at' => null]);
            }

            $this->check_all = false;
            $this->checks    = [];

            $this->dispatch(
                'banner-message',
                style: 'success',
                message: 'Marked As Unread.',
            );
        }

        $this->dispatch('notificationsUpdated');
    }
}
