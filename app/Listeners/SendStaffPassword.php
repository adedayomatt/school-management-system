<?php

namespace App\Listeners;

use Mail;
use App\Mail\MailStaffPassword;
use App\Events\StaffAuthorization;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendStaffPassword
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StaffAuthorization  $event
     * @return void
     */
    public function handle(StaffAuthorization $event)
    {
         Mail::to($event->staff->email)->send(new MailStaffPassword($event->staff,$event->password));
    //    return (new MailStaffPassword($event->staff));
    }
}
