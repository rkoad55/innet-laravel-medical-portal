<?php

namespace App\Listeners;

use App\Events\PatientVerificationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\emailVerfifyForPatient;

class SendPatientConfirmationEmail
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
     * @param  PatientVerificationEvent  $event
     * @return void
     */
    public function handle(PatientVerificationEvent $event)
    {
        // dd($event->patient);  
        \Mail::to($event->patient['email'])->send(
            new emailVerfifyForPatient($event->patient)
        );
    }
}
