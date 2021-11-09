<?php

namespace App\Notifications;
use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderHasApprovedNotification extends Notification
{
    use Queueable;
    public  $order;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order=$order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }



    public function toDatabase($notifiable)
    {
        return [
            'title' => "New Order has placed by merchant bay",
            'notification_data' => $this->order->id,
            'notification_type' => "OrderApproved",
            'url' => '/order'
        ];
    }


}
