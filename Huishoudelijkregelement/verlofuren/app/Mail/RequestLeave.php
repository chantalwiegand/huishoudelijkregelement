<?php

namespace App\Mail;

use App\Absence;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestLeave extends Mailable
{
    use Queueable, SerializesModels;

    protected $absence;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Absence $absence)
    {
        $this->absence = $absence;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.request-leave')
            ->with([
                'hours_of_leave' => $this->absence->hoursofleave,
                'start_date' => $this->absence->start_date,
                'end_date' => $this->absence->end_date,
                'user_id' => $this->absence->user_id,
                'firstname' => $this->absence->user->firstname,
                'prefix' => $this->absence->user->prefix,
                'lastname' => $this->absence->user->lastname,
            ]);
    }
}
