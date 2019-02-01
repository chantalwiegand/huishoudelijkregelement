<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employee, $password)
    {
        $this->employee = $employee;
        $this->password = $password;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.password')
            ->with([
                'firstname' => $this->employee->firstname,
                'prefix' => $this->employee->prefix,
                'lastname' => $this->employee->lastname,
                'email' => $this->employee->email,
                'password' => $this->password,
            ]);
    }
}
