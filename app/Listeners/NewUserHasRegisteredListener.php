<?php

namespace App\Listeners;


use App\Mail\NewUserRegistrationMail;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserRegistrationMailToUser;
use App\Http\Traits\PushNotificationTrait;

class NewUserHasRegisteredListener 
{
    use PushNotificationTrait;
    public function handle($event)
    {
        $admin=Admin::find(1);

        //send push notification to admin for new order
        $fcmToken = $admin->fcm_token;
        $message = "A new user is awating for review";
        $this->pushNotificationSend($fcmToken,$admin->name,$message);

        //mail to admin
        Mail::to('success@merchantbay.com')->send(new NewUserRegistrationMail($event->user));
        //mail to user
        Mail::to($event->user->email)->send(new NewUserRegistrationMailToUser($event->user, $event->token));

    }
}
