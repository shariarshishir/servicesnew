<?php

namespace App\Listeners;

use App\Mail\NewOrderPlaceMail;
use App\Mail\NewOrderPlaceMailToAdmin;
use App\Mail\NewOrderPlaceMailToBuyer;
use App\Models\VendorOrder;
use App\Models\Admin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewOrderHasPlacedNotification;
use App\Http\Traits\PushNotificationTrait;

class NewOrderHasPlacedListener implements ShouldQueue
{
    use PushNotificationTrait;
    public function handle($event)
    {
        $admin=Admin::find(1);

        //send push notification to admin for new order
        $fcmToken = $admin->fcm_token;
        $message = "A new order is placed.Please review and forward the order to the supplier";
        $this->pushNotificationSend($fcmToken,$admin->name,$message);

        //send  notification and email to admin  and buyer for new order
        Mail::to('success@merchantbay.com')->send(new NewOrderPlaceMailToAdmin($event->order));
        Mail::to($event->order->user->email)->send(new NewOrderPlaceMailToBuyer($event->order));
        Notification::send($admin,new NewOrderHasPlacedNotification($event->order));
        
    }
}
