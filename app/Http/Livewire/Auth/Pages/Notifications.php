<?php

namespace App\Http\Livewire\Auth\Pages;

use Livewire\Component;

class Notifications extends Component
{
    public $search = '';

    public $check_all = false;

    public $checks = [];

    public function render()
    {
        $notifications = request()->user()->notifications()->paginate(10);

        foreach ($notifications as $key => $notification) {
            $notification->message = match ($notification->type) {
                'App\Notifications\Admin\RegisterUserNotication' => 'New User: ' . $notification->data['name'],
                'App\Notifications\User\RegisterUserNotication'  => 'Welcome to ' . config('app.name') . ': ' . $notification->data['name'],
                default                                          => null,
            };
        }

        return view('livewire.auth.pages.notifications', compact('notifications'));
    }

    public function mark($type)
    {
        if ($type) {
            request()->user()->notifications->whereIn('id', $this->checks)->markAsRead();

            $this->check_all = false;
            $this->checks    = [];

            $this->dispatchBrowserEvent('banner-message', [
                'style'   => 'success',
                'message' => 'Marked As Read.',
            ]);
        } else {
            foreach (request()->user()->notifications->whereIn('id', $this->checks) as $key => $notification) {
                $notification->update(['read_at' => null]);
            }

            $this->check_all = false;
            $this->checks    = [];

            $this->dispatchBrowserEvent('banner-message', [
                'style'   => 'success',
                'message' => 'Marked As Unread.',
            ]);
        }
    }
}
