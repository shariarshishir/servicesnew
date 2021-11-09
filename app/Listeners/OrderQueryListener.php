<?php

namespace App\Listeners;

use App\Mail\OrderQueryMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderQueryNotification;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;

class OrderQueryListener implements ShouldQueue
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
        $admin=Admin::find(1);
        Notification::send($admin,new OrderQueryNotification($event->query));
        Mail::to('success@merchantbay.com')->send(new OrderQueryMail($event->query));


    }
}
