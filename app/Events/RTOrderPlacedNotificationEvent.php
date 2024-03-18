<?php

namespace App\Events;

use App\Models\Order;
use App\Models\OrderPlacedNotification;
use DateTime;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RTOrderPlacedNotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $orderId;
    public $userName;
    public $orderGrandTotal;
    public $orderPushMessage;
    public $date;
    /**
     * Create a new event instance.
     */
    public function __construct(Order $order)
    {
        $this->message = '#'.$order->invoice_id. ' Yeni siparişiniz var';
        $this->orderId = $order->id;
        $this->userName = $order->userAddress->first_name . ' ' . $order->userAddress->last_name;
        $this->orderGrandTotal = $order->grand_total;
        $this->orderPushMessage = '#'.$order->invoice_id. ' Yeni siparişiniz var.  '. $this->userName . ' ' . $this->orderGrandTotal .'₺ lik yeni sipariş verdi.';

        $createdAt = $order->created_at;
        $notificationDateTime = new DateTime($createdAt);
        $currentDateTime = new DateTime();

        $timeDifference = $currentDateTime->diff($notificationDateTime);
        if ($timeDifference->y > 0) {
            $formattedTime = $timeDifference->format('%y yıl önce');
        } elseif ($timeDifference->m > 0) {
            $formattedTime = $timeDifference->format('%m ay önce');
        } elseif ($timeDifference->d > 0) {
            $formattedTime = $timeDifference->format('%d gün önce');
        } elseif ($timeDifference->h > 0) {
            $formattedTime = $timeDifference->format('%h saat önce');
        } elseif ($timeDifference->i > 0) {
            $formattedTime = $timeDifference->format('%i dakika önce');
        } else {
            $formattedTime = 'Şimdi';
        }
        $this->date = $formattedTime;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('order-placed'),
        ];
    }
}
