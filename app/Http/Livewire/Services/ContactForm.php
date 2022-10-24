<?php

namespace App\Http\Livewire\Services;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

use App\Models\ContactMessage;

class ContactForm extends Component
{
    public $gender;
    public $first_name;
    public $last_name;
    public $company;
    public $contact_email;
    public $phone;
    public $message;
    public $conditions_ok;
    public $message_sent;
    public $message_valid;
    public $submit_feedback;

    public $safety_check;
    public $checksum_number_1;
    public $checksum_number_2;
    public $user_sum;

    protected $rules = [
        'gender' => 'nullable',
        'first_name' => 'required|min:2',
        'last_name' => 'required|min:2',
        'company' => 'nullable|max:100',
        'contact_email' => 'required|email',
        'phone'  => 'nullable|min:6|max:30',
        'message' => 'min:1|max:2000',
        'conditions_ok' => 'min:0|max:1|nullable',
    ];

    public function mount()
    {
        $this->safety_check = 0;
        $this->user_sum = "";
        $this->checksum_number_1 = rand(1, 10);
        $this->checksum_number_2 = rand(1, 10);
        $this->conditions_ok = 0;
        $this->message_sent = 0;
        $this->message_valid = 0;
        $this->submit_feedback = "";
        if (Auth::check()) {
            $this->gender = Auth::user()->gender;
            $this->first_name = Auth::user()->first_name;
            $this->last_name = Auth::user()->last_name;
            $this->company = Auth::user()->company;
            $this->phone = Auth::user()->phone;
            $this->contact_email = Auth::user()->email;
        }
    }

    public function checkSum()
    {
        if ($this->user_sum == $this->checksum_number_1 + $this->checksum_number_2) {
            $this->safety_check = 1;
        }
    }

    public function sendMessage()
    {
        $this->validate();

        if ($this->conditions_ok  == 1) {
            $new_message = new ContactMessage();
            $new_message->gender = $this->gender;
            $new_message->first_name = $this->first_name;
            $new_message->last_name = $this->last_name;
            $new_message->email = $this->contact_email;
            $new_message->phone = $this->phone;
            $new_message->message = $this->message;
            $new_message->conditions_ok = '1';
            $new_message->thread = rand(1, 100000);
            while (ContactMessage::where('thread', $new_message->thread)->count() > 0) {
                $new_message->thread = rand(1, 100000);
            }

            $this->message_sent = 1;
            $new_message->origin = 'COUTURE';
            if ($new_message->save()) {
                $this->message_valid = 1;
                $this->submit_feedback = __('forms.feedback-message-ok');
                $this->clearContent();
            } else {
                $this->message_valid = 0;
                $this->submit_feedback = __('forms.feedback-message-error');
            }
        } else {
            $this->message_sent = 1;
            $this->message_valid = 0;
            $this->submit_feedback = __('forms.feedback-message-warning');
        }
    }

    public function restoreButton()
    {
        $this->message_sent = 0;
    }

    public function clearContent()
    {
        $this->gender = "";
        $this->first_name = "";
        $this->last_name = "";
        $this->contact_email = "";
        $this->phone = "";
        $this->message = "";
        $this->company = "";
        $this->conditions_ok = "";
    }

    public function render()
    {
        return view('livewire.services.contact-form');
    }
}
