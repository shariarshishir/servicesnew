<?php

namespace App\Listeners;

use App\Providers\NewRfqHasAddedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewRfqInvitationListener
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
     * @param  NewRfqHasAddedEvent  $event
     * @return void
     */
    public function handle(NewRfqHasAddedEvent $event)
    {
        //
    }
}
