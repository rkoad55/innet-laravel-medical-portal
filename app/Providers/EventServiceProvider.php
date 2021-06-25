<?php

namespace App\Providers;


use App\Events\DoctorVerification;
use App\Events\PatientVerificationEvent;
use App\Listeners\SendDoctorConfirmationEmail;
use App\Listeners\SendPatientConfirmationEmail;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        DoctorVerification::class => [
            SendDoctorConfirmationEmail::class
        ],
        PatientVerificationEvent::class => [
            SendPatientConfirmationEmail::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
