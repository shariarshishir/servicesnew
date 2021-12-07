<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Rfq;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewRfqHasBidMail;

class NewRfqHasBidListener implements ShouldQueue
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
        ];
        if($supplier=="success@merchantbay.com"){
            Mail::to($supplier)->send(new NewRfqHasBidMail($data));
            // Notification::send($supplier,new NewRfqNotification($data));
        }
        else{
            // Notification::send($supplier,new NewRfqNotification($data));
            Mail::to($event->selectedUserToSendMail->user->email)->send(new NewRfqHasBidMail($data));
        }

    }
}
