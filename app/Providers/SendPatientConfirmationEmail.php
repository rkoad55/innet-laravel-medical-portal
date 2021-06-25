<?php

namespace App\Providers;

use App\Providers\PatientVerificationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        //
    }
}
