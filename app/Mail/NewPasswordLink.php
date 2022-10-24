<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPasswordLink extends Mailable
{
    use Queueable, SerializesModels;

    public $locale;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
        $this->locale = session('locale');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.mailers.smtp_admin.sender'), 'BENU')
                    ->subject(trans('emails.reset-password-subject', [], $this->locale))
                    ->view('emails.password-reset-link');
    }
}
