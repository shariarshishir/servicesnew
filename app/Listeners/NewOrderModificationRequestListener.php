<?php

namespace App\Listeners;
use App\Models\Vendor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewOrderModificationRequestNotification;
use App\Models\Admin;
use App\Mail\NewOrderModificationRequestMail;

class NewOrderModificationRequestListener implements ShouldQueue
{

    public function handle($event)
    {

        $admin=Admin::find(1);
        Notification::send($admin,new NewOrderModificationRequestNotification($event->orderModificationRequest->id));
        Mail::to('no-reply@merchantbay.com')->send(new NewOrderModificationRequestMail($event->orderModificationRequest));

    }
}
