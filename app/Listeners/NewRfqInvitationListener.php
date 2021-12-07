<?php

namespace App\Listeners;

use App\Providers\NewRfqHasAddedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Rfq;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewRfqInvitationMail;

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

        $supplier=$event->selectedUserToSendMail;
        $latestRfq=Rfq::with('category','images')->latest()->first();
        //$rfq=Rfq::with('category','images')->findOrFail($latestRfq->id);

        if($supplier=="success@merchantbay.com"){
            $data=[
                'supplier'=>$supplier,
                'rfq'=>$latestRfq,
                'url'=>"/manage-rfq"
            ];
            Mail::to($supplier)->send(new NewRfqInvitationMail($data));
            // Notification::send($supplier,new NewRfqNotification($data));
        }
        else{

            foreach($supplier as $userData){
                $data=[
                    'supplier'=>$userData->user->name,
                    'rfq'=>$latestRfq,
                    'url'=>"/manage-rfq"
                ];
                Mail::to($userData->user->email)->send(new NewRfqInvitationMail($data));
            }
            // Notification::send($supplier,new NewRfqNotification($data));
        }

    }
}
