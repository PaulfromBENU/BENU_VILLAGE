<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;

use App\Mail\NewOrder;
use App\Mail\NewOrderForAdmin;

use App\Models\User;
use App\Models\Order;

class SendNewOrderEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $order;
    protected $pdf_invoice;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $email, Order $order, $pdf_invoice)
    {
        $this->email = $email;
        $this->order = $order;
        $this->pdf_invoice = $pdf_invoice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Mail::mailer('smtp_admin')->to($this->email)->send(new NewOrder($this->order, $this->pdf_invoice));
        if(app('env') == 'prod') {
            Mail::mailer('smtp_admin')->to($this->email)->bcc(config('mail.mailers.smtp_admin.sender'))->send(new NewOrder($this->order, $this->pdf_invoice));
            Mail::mailer('smtp_admin')->to(config('mail.mailers.smtp_admin.sender'))->send(new NewOrderForAdmin($this->order));
        }
    }
}
