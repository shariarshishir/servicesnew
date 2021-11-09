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


class NewOrderHasApprovedListener implements ShouldQueue
{

    public function handle($event)
    {
        //dd($event->order);
        //$order=VendorOrder::with('orderItems')->where('id',$event->order->id)->first();
        // Mail sending to wholesaler after approved the order from admin
       // $user=User::find($order->vendor->user_id);
        Mail::to($event->order->vendor->user->email)->send(new NewOrderPlaceMailToSeller($event->order));
        Notification::send($event->order->vendor->user,new NewOrderHasApprovedNotification($event->order));

        // Mail sending to buyer after approved the order from admin
        //$buyer = User::find($order->user_id);
        Mail::to($event->order->user->email)->send(new NewOrderPlaceMailToBuyer($event->order));
        Notification::send($event->order->user,new NewOrderHasApprovedNotification($event->order));
    }
}
