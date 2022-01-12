<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Mail\NewBusinessProfileHasCreatedEmailToAdmin;
use App\Mail\NewBusinessProfileHasCreatedEmailToUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewBusinessProfileHasCreatedListener implements ShouldQueue
{
   
    public function handle($event)
    {
        // //mail to admin after new business profile create
        Mail::to('success@merchantbay.com')->send(new NewBusinessProfileHasCreatedEmailToAdmin($event->business_profile));

        //mail to user after new business profile create
       
        Mail::to($event->business_profile->user->email)->send(new NewBusinessProfileHasCreatedEmailToUser($event->business_profile));
    }
}
