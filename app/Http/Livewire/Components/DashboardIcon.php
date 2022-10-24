<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

use App\Models\ContactMessage;
use App\Models\ItemOrder;
use App\Models\MaskOrder;
use App\Models\User;

class DashboardIcon extends Component
{
    public $counter;

    protected $listeners = ['seenCommunicationsUpdated' => 'updateCommunicationsCount'];

    public function mount()
    {
        $this->updateCommunicationsCount();
    }

    public function updateCommunicationsCount()
    {
        $this->counter = 0;
        if (auth()->check()) {
            $email = auth()->user()->email;
            $unread_messages_count = 0;
            foreach (ContactMessage::where('email', $email)->where('closed', '0')->where('is_answered', '1')->get() as $message) {
                if ($message->benuAnswers()->where('seen_by_user', '0')->count() > 0) {
                    $unread_messages_count += $message->benuAnswers()->where('seen_by_user', '0')->count();
                }
            }
            $this->counter = $unread_messages_count;
        }
    }

    public function render()
    {
        return view('livewire.components.dashboard-icon');
    }
}
