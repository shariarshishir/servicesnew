<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderQueryFromAdminNotification;
use App\Mail\OrderQueryFromAdminMail;

use Illuminate\Support\Facades\Mail;

class OrderQueryFromAdminListener implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        Notification::send($event->query->orderModificationRequest->user,new OrderQueryFromAdminNotification($event->query));
        Mail::to($event->query->orderModificationRequest->user->email)->send(new OrderQueryFromAdminMail($event->query));


    }
}
