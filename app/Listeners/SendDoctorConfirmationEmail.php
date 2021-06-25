<?php

namespace App\Listeners;

use App\Events\DoctorVerification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\emailVerfifyForDoctor;

class SendDoctorConfirmationEmail
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
     * @param  DoctorVerification  $event
     * @return void
     */
    public function handle(DoctorVerification $event)
    {
        // dd($event->doctor);  
        \Mail::to($event->doctor['email'])->send(
            new emailVerfifyForDoctor($event->doctor)
        );
    }
}
