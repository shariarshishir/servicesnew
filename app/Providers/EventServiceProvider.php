<?php

namespace App\Providers;

use App\Events\NewOrderHasApprovedEvent;
use App\Events\NewUserHasRegisteredEvent;
use App\Events\NewOrderHasPlacedEvent;
use App\Events\NewOrderModificationRequestEvent;
use App\Events\OrderQueryEvent;
use App\Events\OrderQueryFromAdminEvent;
use App\Events\PaymentSuccessEvent;
use App\Events\ProductAvailabilityEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\NewRfqHasAddedEvent;
use App\Events\NewRfqHasBidEvent;

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
        NewOrderHasPlacedEvent::class => [
            'App\Listeners\NewOrderHasPlacedListener',
        ],
        NewOrderHasApprovedEvent::class => [
            'App\Listeners\NewOrderHasApprovedListener',
        ],
        NewUserHasRegisteredEvent::class => [
            'App\Listeners\NewUserHasRegisteredListener',
        ],
        NewOrderModificationRequestEvent::class=>[
            'App\Listeners\NewOrderModificationRequestListener',
        ],
        ProductAvailabilityEvent::class=>[
            'App\Listeners\ProductAvailabilityListener',
        ],
        OrderQueryEvent::class=>[
            'App\Listeners\OrderQueryListener',
        ],
        OrderQueryFromAdminEvent::class=>[
            'App\Listeners\OrderQueryFromAdminListener',
        ],
        PaymentSuccessEvent::class=>[
            'App\Listeners\PaymentSuccessListener',
        ],
        NewRfqHasAddedEvent::class => [
            'App\Listeners\NewRfqInvitationListener',
        ],
        NewRfqHasBidEvent::class => [
            'App\Listeners\NewRfqHasBidListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
