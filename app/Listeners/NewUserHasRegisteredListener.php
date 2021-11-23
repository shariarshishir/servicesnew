<?php

namespace App\Listeners;


use App\Mail\NewUserRegistrationMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserRegistrationMailToUser;


class NewUserHasRegisteredListener implements ShouldQueue
{

    public function handle($event)
    {
        //$user=User::with('vendor')->where('id',$event->user->id)->first();
        //mail to admin
        Mail::to('success@merchantbay.com')->send(new NewUserRegistrationMail($event->user));
        //mail to user
        Mail::to($event->user->email)->send(new NewUserRegistrationMailToUser($event->user, $event->token));

    }
}
