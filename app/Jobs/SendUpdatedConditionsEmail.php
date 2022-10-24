<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;

use App\Mail\ConditionsUpdated;

use App\Models\User;

class SendUpdatedConditionsEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->users = User::where('last_conditions_agreed', '0')->get();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->users as $user) {
            Mail::mailer('smtp_admin')->to($user->email)->send(new ConditionsUpdated($user));
        }
        if(app('env') == 'prod') {
            Mail::mailer('smtp_admin')->to(config('mail.mailers.smtp_admin.sender'))->send(new ConditionsUpdated(User::find(1)));
        }
    }
}
