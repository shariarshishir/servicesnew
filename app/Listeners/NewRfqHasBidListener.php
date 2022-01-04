<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Rfq;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewRfqHasBidMail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RfqBidNotification;


class NewRfqHasBidListener  implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $supplier=$event->selectedUserToSendMail;
        $data=[
            'supplier'=>$supplier,
            'bidData'=>$event->bidData,
            'url'=>"/my-rfq"
        ];
        if($supplier=="success@merchantbay.com"){
           
            Mail::to($supplier)->send(new NewRfqHasBidMail($data));
           
        }else{
            
            Mail::to($supplier->user->email)->send(new NewRfqHasBidMail($data));
            Notification::send($supplier->user,new RfqBidNotification($data));

        }
        
        

    }
}
