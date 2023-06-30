<?php

namespace App\Http\Livewire\Auth\Pages\Notifications;

use App\Traits\NotificationsTrait;
use Livewire\Component;

class Show extends Component
{
    use NotificationsTrait;

    public $notification_id;

    public function mount($notification_id)
    {
        $this->notification_id = $notification_id;
    }

    public function render()
    {
        $notification = request()->user()->notifications->where('id', $this->notification_id)->first();
        $notification->markAsRead();
        $notification->message = $this->getMessage($notification);

        return view('livewire.auth.pages.notifications.show', compact('notification'));
    }
}
