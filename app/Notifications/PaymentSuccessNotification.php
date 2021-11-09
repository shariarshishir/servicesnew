<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentSuccessNotification extends Notification
{
    use Queueable;

    public $order;
    public $user_type;

    public function __construct($order, $user_type)
    {
        $this->order=$order;
        $this->user_type=$user_type;
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
            'title' => "Payment Success",
            'notification_data'=> $this->order->id,
            'notification_type'=>"PaymentSuccess",
            'url' => $this->user_type== 'admin' ? route('vendor.order.show',['vendor' => $this->order->vendor_id, 'order' => $this->order->id]) : route('order.index'),
        ];
    }
}
