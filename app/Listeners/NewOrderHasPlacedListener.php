<?php

namespace App\Listeners;

use App\Mail\NewOrderPlaceMail;
use App\Mail\NewOrderPlaceMailToAdmin;
use App\Models\VendorOrder;
use App\Models\Admin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewOrderHasPlacedNotification;

class NewOrderHasPlacedListener 
{
    public function handle($event)
    {
        $admin=Admin::find(1);
        Mail::to('no-reply@merchantbay.com')->send(new NewOrderPlaceMailToAdmin($event->order));
        Notification::send($admin,new NewOrderHasPlacedNotification($event->order));
    }
}
