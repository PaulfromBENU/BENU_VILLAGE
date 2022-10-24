<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

use App\Models\BenuAnswer;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\User;

class ConfirmReturn extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-reply';

    protected static string $view = 'filament.pages.confirm-return';

    protected static ?string $title = 'Confirm returns to users';
 
    protected static ?string $navigationLabel = 'Confirm Returns';
     
    protected static ?string $slug = 'confirm-return';

    protected static ?string $navigationGroup = 'Users';

    protected static ?int $navigationSort = 6;

    public $orders;
    public $order_unique_id;
    public $locale = "";
    public $message;

    public function mount()
    {
        $this->orders = Order::where('delivery_date', '>', \Carbon\Carbon::now()->subDays(28))->get();
    }

    public function updatedOrderUniqueId()
    {
        $this->selectOrder($this->order_unique_id);
    }

    public function selectOrder($unique_id)
    {
        if (Order::where('unique_id', $unique_id)->count() > 0) {
            $order = Order::where('unique_id', $unique_id)->first();
            if ($order->user->role !== 'guest_client' && $order->user->favorite_language !== "") {
                $this->locale = $order->user->favorite_language;
            }
        } else {
            $this->locale = "";
        }
    }

    public function confirmReturn()
    {
        $order = Order::where('unique_id', $this->order_unique_id)->first();
        $gender = $order->user->gender;
        $first_name = $order->user->first_name;
        $last_name = $order->user->last_name;
        $email = $order->user->email;
        $phone = $order->user->phone;

        $new_contact_message = new ContactMessage();
        $new_contact_message->gender = $gender;
        $new_contact_message->first_name = $first_name;
        $new_contact_message->last_name = $last_name;
        $new_contact_message->email = $email;
        $new_contact_message->phone = $phone;
        $new_contact_message->message = __('dashboard.return-requested-message');
        $new_contact_message->origin = "return";
        $new_contact_message->conditions_ok = 1;
        $new_thread = rand(10000, 99999);
        while (ContactMessage::where('thread', $new_thread)->count() > 0) {
            $new_thread = rand(10000, 99999);
        }
        $new_contact_message->thread = $new_thread;
        $new_contact_message->closed = 0;
        $new_contact_message->is_read = 1;
        $new_contact_message->is_answered = 1;
        if ($new_contact_message->save()) {
            $new_benu_answer = new BenuAnswer();
            $new_benu_answer->contact_message_id = $new_contact_message->id;
            $new_benu_answer->message = $this->message;
            $new_benu_answer->seen_by_user = 0;
            if($new_benu_answer->save()) {
                $this->notify('success', 'Return for order #'.$this->order_unique_id.' has been confirmed, client is now notified in his/her dashboard!');
                $this->order_unique_id = 0;
                $this->locale = "";
                $this->message = "";
            }
        }
    }
}
