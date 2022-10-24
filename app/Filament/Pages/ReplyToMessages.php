<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

use App\Models\ContactMessage;
use App\Models\BenuAnswer;

class ReplyToMessages extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-reply';

    protected static string $view = 'filament.pages.reply-to-messages';

    protected static ?string $title = 'Reply to contact messages';
 
    protected static ?string $navigationLabel = 'Reply to messages';
     
    protected static ?string $slug = 'reply-to-messages';

    protected static ?string $navigationGroup = 'Users';

    protected static ?int $navigationSort = 1;

    public $unread_messages;
    public $benu_answer;

    public function mount()
    {
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $unread_messages_threads = [];
        // Display all unclosed threads, even if already answered. To limit to non-answered messages, add where('is_answered', 0)
        foreach (ContactMessage::where('closed', '0')->get() as $unread_message) {
            if (!in_array($unread_message->thread, $unread_messages_threads)) {
                array_push($unread_messages_threads, $unread_message->thread);
            }
        }

        $this->unread_messages = collect([]);
        foreach ($unread_messages_threads as $open_thread) {
            $this->unread_messages = $this->unread_messages->merge(ContactMessage::where('thread', $open_thread)->orderBy('created_at', 'asc')->get());
        }
    }

    public function closeThread($thread)
    {
        ContactMessage::where('thread', $thread)->update([
            'closed' => '1',
        ]);
        $this->loadMessages();
    }

    public function sendReply($thread)
    {
        if (isset($this->benu_answer[$thread]) 
            && is_string($this->benu_answer[$thread]) 
            && strlen($this->benu_answer[$thread]) >= 2 
            && strlen($this->benu_answer[$thread]) <= 2000) {

            $benu_answer = new BenuAnswer();
            $benu_answer->message = $this->benu_answer[$thread];
            $benu_answer->contact_message_id = ContactMessage::where('thread', $thread)->orderBy('created_at', 'desc')->first()->id;

            if ($benu_answer->save()) {
                $this->benu_answer[$thread] = "";
                ContactMessage::where('thread', $thread)->update([
                    'is_read' => '1',
                    'is_answered' => '1',
                ]);
                $this->loadMessages();
            }
        }
    }
}
