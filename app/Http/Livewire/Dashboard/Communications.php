<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

use App\Models\BenuAnswer;
use App\Models\ContactMessage;
use App\Models\ItemOrder;
use App\Models\MaskOrder;

class Communications extends Component
{
    public $showForm;
    public $message_thread;
    public $message;
    public $unread_threads = [];

    public function mount()
    {
        $this->showForm = [];//[thread => 0/1]
        $this->markAnswersAsSeen();
    }

    public function closeThread($thread)
    {
        if (auth()->user()->openContactMessages()->where('thread', $thread)->count() > 0) {
            auth()->user()->openContactMessages()->where('thread', $thread)->update([
                'closed' => '1',
                'is_read' => '1',
                'is_answered' => '1',
            ]);
        }
    }

    public function showMessageForm($thread)
    {
        $this->showForm[$thread] = 1;
    }

    public function sendNewMessage(int $thread)
    {
        if (auth()->user()->openContactMessages()->where('thread', $thread)->count() > 0) {
            if (isset($this->message[$thread]) 
                && is_string($this->message[$thread]) 
                && strlen($this->message[$thread]) >= 1 
                && strlen($this->message[$thread]) <= 2000) {

                $new_message = new ContactMessage();
                if (isset(auth()->user()->gender)) {
                    $new_message->gender = auth()->user()->gender;
                } else {
                    $new_message->gender = "";
                }
                $new_message->first_name = auth()->user()->first_name;
                $new_message->last_name = auth()->user()->last_name;
                $new_message->email = auth()->user()->email;
                if (isset(auth()->user()->phone)) {
                    $new_message->phone = auth()->user()->phone;
                } else {
                    $new_message->phone = "";
                }
                $new_message->message = $this->message[$thread];
                $new_message->conditions_ok = 1;
                $new_message->thread = $thread;
                $new_message->closed = 0;
                $new_message->is_read = 0;
                $new_message->is_answered = 0;

                if ($new_message->save()) {
                    $this->render();
                    $this->showForm[$thread] = 2;
                }
            }
        }
    }

    public function markAnswersAsSeen()
    {
        foreach (auth()->user()->openContactMessages()->get() as $open_message) {
            foreach ($open_message->benuAnswers()->where('seen_by_user', '0')->get() as $benu_answer) {
                if (!in_array($open_message->thread, $this->unread_threads)) {
                    array_push($this->unread_threads, $open_message->thread);
                }
                $benu_answer->seen_by_user = 1;
                $benu_answer->save();
            }
        }
        // $this->emit('seenCommunicationsUpdated');
    }

    public function render()
    {
        return view('livewire.dashboard.communications', [
            'contact_messages' => auth()->user()->contactMessages()->orderBy('created_at', 'desc')->get(),
            'mask_requests' => MaskOrder::where('email', auth()->user()->email)->orderBy('created_at', 'desc')->get(),
            'item_requests' => ItemOrder::where('email', auth()->user()->email)->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
