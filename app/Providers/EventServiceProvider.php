<?php

namespace App\Providers;

use App\Events\PtoPointsHasBeenUpdatedEvent;
use App\Events\RequestPtoTickedHasBeenSubmittedEvent;
use App\Listeners\AddPtoPointsToActivity;
use App\Listeners\CreateRequestPToTicket;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        PtoPointsHasBeenUpdatedEvent::class => [
            AddPtoPointsToActivity::class,
        ],
        RequestPtoTickedHasBeenSubmittedEvent::class => [
            CreateRequestPToTicket::class,
        ],
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
