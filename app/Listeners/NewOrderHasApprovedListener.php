<?php

namespace App\Listeners;

use App\Models\VendorOrder;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewOrderHasApprovedNotification;
use App\Mail\NewOrderPlaceMailToBuyer;
use App\Mail\NewOrderPlaceMailToSeller;
use App\Http\Traits\PushNotificationTrait;


class NewOrderHasApprovedListener implements ShouldQueue
{
    use PushNotificationTrait;
    public function handle($event)
    {

        //send push notification to wholesaler after approved the order from admin
        $fcmToken = $event->order->businessProfile->user->fcm_token;
        $message = "You have a new order";
        $this->pushNotificationSend($fcmToken,$admin->name,$message);

        // Mail sending to wholesaler after approved the order from admin
        Mail::to($event->order->businessProfile->user->email)->send(new NewOrderPlaceMailToSeller($event->order));
        Notification::send($event->order->businessProfile->user,new NewOrderHasApprovedNotification($event->order,'wholesaler'));
        
        //send push notification to buyer after approved the order from admin
        $fcmToken = $event->order->user->fcm_token;
        $message = "Your order has been place to supplier";
        $this->pushNotificationSend($fcmToken,$admin->name,$message);

        // Mail sending to buyer after approved the order from admin
        Mail::to($event->order->user->email)->send(new NewOrderPlaceMailToBuyer($event->order));
        Notification::send($event->order->user,new NewOrderHasApprovedNotification($event->order,'buyer'));
    }
}
