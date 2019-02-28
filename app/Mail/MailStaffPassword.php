<?php

namespace App\Mail;

use App\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailStaffPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;
    public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Staff $staff, $password)
    {
        $this->staff = $staff;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->staff->surname.', Your portal password')
                    ->view('emails.staff-password');
    }
}
