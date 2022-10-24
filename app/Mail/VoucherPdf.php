<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use App\Models\Voucher;

class VoucherPdf extends Mailable
{
    use Queueable, SerializesModels;

    public $buyer;
    public $voucher;
    public $locale;
    public $pdf_voucher;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $buyer, Voucher $voucher, $pdf_voucher)
    {
        $this->buyer = $buyer;
        $this->voucher = $voucher;
        $this->pdf_voucher = $pdf_voucher;
        $this->locale = strtolower($this->buyer->favorite_language);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.mailers.smtp_admin.sender'), 'BENU')
                    ->subject(trans('emails.pdf-voucher-subject', [], $this->locale).' ('.$this->voucher->unique_code.')')
                    ->view('emails.voucher-pdf')
                    ->attachData($this->pdf_voucher->output(), 'BENU_Voucher_'.$this->voucher->unique_code.'.pdf', [
                    'mime' => 'application/pdf',
                ]);
    }
}
