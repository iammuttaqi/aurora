<?php

namespace App\Http\Livewire\Frontend\Components;

use Livewire\Component;

class NotificationsCount extends Component
{
    protected $listeners = ['notificationsUpdated' => 'updateNotificationsCount'];
    public $notifications_count = null;

    public function mount()
    {
        $this->updateNotificationsCount();
    }

    public function render()
    {
        return view('livewire.frontend.components.notifications-count');
    }

    public function updateNotificationsCount()
    {
        $this->notifications_count = auth()->user()->unreadNotifications->count();
    }
}
