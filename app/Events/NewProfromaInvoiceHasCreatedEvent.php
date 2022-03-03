<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewProfromaInvoiceHasCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $proformaInvoice;

    public function __construct($proformaInvoice)
    {
        $this->proformaInvoice = $proformaInvoice;
    }

    
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
