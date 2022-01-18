<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Mail\NewBusinessProfileHasCreatedEmailToAdmin;
use App\Mail\NewBusinessProfileHasCreatedEmailToUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Traits\PushNotificationTrait;
use App\Models\Admin;

class NewBusinessProfileHasCreatedListener implements ShouldQueue
{
    use PushNotificationTrait;
    public function handle($event)
    {
        $admin=Admin::find(1);

        //send push notification to admin for new businessProfile
        $fcmToken = $admin->fcm_token;
        $message = "A new business profile has created .Please assign success manager to verify information";
        $this->pushNotificationSend($fcmToken,$admin->name,$message);

        // //mail to admin after new business profile create
        Mail::to('success@merchantbay.com')->send(new NewBusinessProfileHasCreatedEmailToAdmin($event->business_profile));

        //mail to user after new business profile create
       
        Mail::to($event->business_profile->user->email)->send(new NewBusinessProfileHasCreatedEmailToUser($event->business_profile));
    }
}
