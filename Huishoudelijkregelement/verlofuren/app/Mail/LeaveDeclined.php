<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LeaveDeclined extends Mailable
{
    use Queueable, SerializesModels;

    public $reason_decline;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reason_decline)
    {
        $this->reason_decline = $reason_decline;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.request-declined');
    }
}
