<?php

namespace App\Listeners;

use App\Providers\NewRfqHasAddedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Rfq;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewRfqInvitationMail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewRfqNotification;

class NewRfqInvitationListener implements ShouldQueue
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
     * @param  NewRfqHasAddedEvent  $event
     * @return void
     */
    public function handle($event)
    {
        
        $user=$event->selectedUserToSendMail;
        $rfq=$event->rfq;
        if($user=="success@merchantbay.com"){
            $data=[
                'supplier'=>$user,
                'rfq'=>$rfq,
                'url'=>"/rfq"
            ];
            Mail::to($user)->send(new NewRfqInvitationMail($data));
        }
        else{
            $data=[
                'supplier'=>$user->name,
                'rfq'=>$rfq,
                'url'=>"/rfq"
            ];
            
            Mail::to($user->email)->send(new NewRfqInvitationMail($data));
            Notification::send($user,new NewRfqNotification($data));
    
        }

    }
}
